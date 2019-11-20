<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreeResponseQuestion extends Model
{
    protected $guarded = [];

    public function generalQuestion()
    {
        return $this->morphOne(Question::class, 'specialized_question');
    }
}
