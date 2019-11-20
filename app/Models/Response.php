<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $guarded = [];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}