<?php

use Illuminate\Support\Facades\Route;

Route::get('/films/{id}','App\Http\Controllers\FilmController@show');
Route::get('/films','App\Http\Controllers\FilmController@index');
Route::delete('/films/{id}','App\Http\Controllers\FilmController@delete');
Route::post('/films','App\Http\Controllers\FilmController@store');

Route::get('/languages/{id}','App\Http\Controllers\LanguageController@show');
Route::get('/languages','App\Http\Controllers\LanguageController@index');

Route::get('languages/{id}/films','App\Http\Controllers\LanguageFilmController@index');
Route::get('languages/{id}/avg','App\Http\Controllers\LanguageFilmController@avg_rental_rate');