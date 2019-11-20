<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MultipleChoiceQuestion extends Model
{
    protected $guarded = [];

    public function generalQuestion()
    {
        return $this->morphOne(Question::class, 'specialized_question');
    }

    public function answerOptions()
    {
        return $this->hasMany(AnswerOption::class);
    }
}
