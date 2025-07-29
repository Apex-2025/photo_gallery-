<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'web'], function () {

    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::get('/photos', 'PhotoController@index');

    Route::get('/photos/create', 'PhotoController@create');

    Route::post('/photos', 'PhotoController@store');

    Route::get('/photos/{id}', 'PhotoController@show');

    Route::get('/photos/{id}/edit', 'PhotoController@edit');

    Route::put('/photos/{id}', 'PhotoController@update');

    Route::delete('/photos/{id}', 'PhotoController@destroy');
});




