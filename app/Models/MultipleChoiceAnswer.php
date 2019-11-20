<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MultipleChoiceAnswer extends Model
{
    protected $guarded = [];

    protected $with = ['selectedAnswerOptions'];

    public function selectedAnswerOptions()
    {
        return $this->belongsToMany(AnswerOption::class, 'selected_answer_options')->withTimestamps();
    }

    public function getTextAttribute()
    {
        return $this->selectedAnswerOptions->pluck('text')->join(', ');
    }
}
