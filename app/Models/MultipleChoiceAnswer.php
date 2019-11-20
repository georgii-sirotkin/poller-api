<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MultipleChoiceAnswer extends Model
{
    protected $guarded = [];

    public function selectedAnswerOptions()
    {
        return $this->belongsToMany(AnswerOption::class, 'selected_answer_options')->withTimestamps();
    }
}
