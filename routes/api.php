<?php

use Illuminate\Http\Request;

Route::middleware('web')->group(function () {
    Route::post('auth/login', 'Auth\LoginController@login');
});

