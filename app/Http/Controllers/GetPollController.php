<?php

namespace App\Http\Controllers;

use App\Models\Poll;

class GetPollController extends Controller
{
    public function __invoke($token)
    {
        return Poll::with('questions.specializedQuestion')->where('access_token', $token)->firstOrFail();
    }
}
