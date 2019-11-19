<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetCurrentUserController extends Controller
{
    public function __invoke(Request $request)
    {
        return $request->user();
    }
}