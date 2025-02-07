<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'admin',
    'as'     => 'admin.'
], function () {
    Route::get('/', 'Admin\DashboardController@index')->name('dashboard');
    Route::resource('movies', 'Admin\MovieController')->only([
        'store', 'edit', 'update', 'destroy'
    ]);
});

Route::get('/', 'MoviesController@index')->name('movies.index');
Route::get('/movies/{movie}', 'MoviesController@show')->name('movies.show');

//Route::get('/tv', 'TvController@index')->name('tv.index');
//Route::get('/tv/{id}', 'TvController@show')->name('tv.show');
//
//Route::get('/actors', 'ActorsController@index')->name('actors.index');
//Route::get('/actors/page/{page?}', 'ActorsController@index');
//
//Route::get('/actors/{id}', 'ActorsController@show')->name('actors.show');
