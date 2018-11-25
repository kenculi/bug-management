<?php

Route::group(['middleware' => 'web', 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
    Route::get('/', 'UserController@index');

    Route::post('/user-edit', 'UserController@edit');

    Route::post('/update', 'UserController@update');
});
