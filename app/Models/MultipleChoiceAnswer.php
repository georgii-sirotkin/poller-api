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
        $optionValues = [];

        foreach ($this->selectedAnswerOptions as $selectedOption) {
            if ($selectedOption->is_other) {
                $optionValue = $selectedOption->text . ': ' . $this->other;
            } else {
                $optionValue = $selectedOption->text;
            }

            $optionValues[] = $optionValue;
        }

        return implode(', ', $optionValues);
    }
}
