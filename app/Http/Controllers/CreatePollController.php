<?php

namespace App\Http\Controllers;

use App\Models\FreeResponseQuestion;
use App\Models\MultipleChoiceQuestion;
use App\Models\Poll;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreatePollController extends Controller
{
    public function __invoke(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $poll = $this->createPoll($request);

            foreach ($request->input('questions') as $questionData) {
                $this->createQuestion($questionData, $poll);
            }

            return $poll->fresh();
        });

    }

    protected function createPoll(Request $request)
    {
        return Poll::create([
            'name' => $request->input('name'),
            'access_token' => Str::random(20),
        ]);
    }

    protected function createQuestion($questionData, Poll $poll)
    {
        $specializedQuestion = $this->createSpecializedQuestion($questionData);
        $question = new Question([
            'text' => $questionData['text'],
        ]);

        $question->specializedQuestion()->associate($specializedQuestion);
        $poll->questions()->save($question);
    }

    protected function createSpecializedQuestion($questionData)
    {
        $questionType = $questionData['type'];

        if ($questionType === 'radio' || $questionType === 'checkbox') {
            return $this->createMultipleChoiceQuestion($questionData);
        }

        return FreeResponseQuestion::create([
            'input_type' => $questionType,
        ]);
    }

    protected function createMultipleChoiceQuestion($questionData)
    {
        $question = MultipleChoiceQuestion::create([
            'only_one_answer_allowed' => $questionData['type'] === 'radio',
        ]);

        foreach ($questionData['data']['options'] as $option) {
            $question->answerOptions()->create([
                'text' => $option['text'],
                'is_other' => array_key_exists('is_other', $option) && $option['is_other'],
            ]);
        }

        return $question;
    }
}
