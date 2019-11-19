<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * {@inheritdoc}
     */
    protected function authenticated(Request $request, $user)
    {
        return ['message' => 'success'];
    }

    /**
     * {@inheritdoc}
     */
    protected function loggedOut(Request $request)
    {
        return ['message' => 'success'];
    }
}
