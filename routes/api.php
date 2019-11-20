<?php

Route::middleware('web')->group(function () {
    Route::post('auth/login', 'Auth\LoginController@login');
    Route::get('polls/{token}', 'GetPollController');
    Route::post('responses', 'CreateResponseController');

    Route::middleware('auth')->group(function () {
        Route::get('auth/me', 'Auth\GetCurrentUserController');
        Route::get('auth/logout', 'Auth\LoginController@logout');

        Route::post('admin/polls', 'CreatePollController');
        Route::get('admin/polls', 'PollsController@index');
        Route::get('admin/polls/{id}', 'PollsController@show');
    });

});



