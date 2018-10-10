<?php

Route::group(['middleware' => 'web', 'prefix' => 'board', 'namespace' => 'Modules\Board\Http\Controllers'], function()
{
    Route::get('/', 'BoardController@index');
});
