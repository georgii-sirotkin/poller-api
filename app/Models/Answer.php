<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $appends = ['text'];

    public function specializedAnswer()
    {
        return $this->morphTo();
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    
    public function getTextAttribute()
    {
        return $this->specializedAnswer->text;
    }
}
