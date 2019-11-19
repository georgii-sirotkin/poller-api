<?php

Route::middleware('web')->group(function () {
    Route::post('auth/login', 'Auth\LoginController@login');

    Route::middleware('auth')->group(function () {
        Route::get('auth/me', 'Auth\GetCurrentUserController');
        Route::get('auth/logout', 'Auth\LoginController@logout');
    });
});



