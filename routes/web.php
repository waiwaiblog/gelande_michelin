<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::get('/', function () {
        return redirect()->route('login');
    });

    Auth::routes();

    Route::get('/home', function()
    {
    return redirect('review/');
    });


    Route::group(['prefix' => 'review', 'middleware' => 'auth'], function() {
        Route::get('/', 'ReviewController@index')->name('review.index');
        Route::get('/create', 'ReviewController@create')->name('review.create');
        Route::post('/create', 'ReviewController@store')->name('review.store');
        Route::get('/{id}/edit', 'ReviewController@edit')->name('review.edit');
        Route::post('/{id}/update', 'ReviewController@update')->name('review.update');
        Route::post('/{id}/destroy', 'ReviewController@destroy')->name('review.destroy');
    });


    Route::group(['prefix' => 'user', 'middleware' => 'auth'], function() {
       Route::get('/edit', 'UserController@edit')->name('user.edit');
       Route::post('/update', 'UserController@update')->name('user.update');

       Route::post('/edit', 'UserController@sendChangeEmailLink')->name('user.sendChangeEmailLink');
       Route::get('/reset/{token}', 'UserController@sendChangeEmailReset')->name('user.sendChangeEmailReset');

       Route::post('/password', 'UserController@changePassword')->name('user.changePassword');
    });


