<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\FreeResponseAnswer;
use App\Models\MultipleChoiceAnswer;
use App\Models\Poll;
use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreateResponseController extends Controller
{
    public function __invoke(Request $request)
    {
        $poll = Poll::with('questions')
                ->where('access_token', $request->input('poll_access_token'))
                ->firstOrFail();

        return DB::transaction(function () use ($request, $poll) {
            $response = $this->createResponse($poll);
            $questions = $poll->questions;

            foreach ($request->input('answers') as $answerData) {
                $question = $questions->firstWhere('id', $answerData['question_id']);
                $this->createAnswer($answerData, $question, $response);
            }

            return $poll->fresh();
        });
    }

    protected function createResponse(Poll $poll)
    {
        return $poll->responses()->create([]);
    }

    protected function createAnswer($answerData, Question $question, Response $response)
    {
        $specializedAnswer = $this->createSpecializedAnswer($answerData, $question);
        $answer = new Answer();
        $answer->specializedAnswer()->associate($specializedAnswer);
        $response->answers()->save($answer);
    }

    protected function createSpecializedAnswer($answerData, Question $question)
    {
        $questionType = $question->specialized_question_type;

        if ($questionType === 'multipleChoice') {
            return $this->createMultipleChoiceAnswer($answerData);
        }

        if ($questionType === 'freeResponse') {
            return $this->createFreeResponseAnswer($answerData);
        }
    }

    protected function createMultipleChoiceAnswer($answerData)
    {
        $answer = MultipleChoiceAnswer::create([
            'other' => array_key_exists('other', $answerData) ? $answerData['other'] : null,
        ]);

        $answer->selectedAnswerOptions()->attach($answerData['value']);
        return $answer;
    }

    protected function createFreeResponseAnswer($answerData)
    {
        return FreeResponseAnswer::create([
            'text' => $answerData['value'],
        ]);
    }
}
