<?php

namespace App\Http\Controllers;

use App\Models\Poll;

class PollsController extends Controller
{
    public function index()
    {
        return Poll::withCount('responses')->get();
    }

    public function show($id)
    {
        return Poll::with('responses.answers.question')->findOrFail($id);
    }
}
