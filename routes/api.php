<?php

use Illuminate\Support\Facades\Route;

//films
Route::get('/films/{id}','App\Http\Controllers\FilmController@show');
Route::get('/films','App\Http\Controllers\FilmController@index');
Route::delete('/films/{id}','App\Http\Controllers\FilmController@delete');
Route::post('/films','App\Http\Controllers\FilmController@store');
Route::get('/films/{id}/critics','App\Http\Controllers\FilmCriticController@index');
Route::get('/films/{id}/avg','App\Http\Controllers\FilmCriticController@avg_score');
//Recevoir l’information de films suite à une recherche
Route::get('/films/search','App\Http\Controllers/FilmController@search');

//languages
Route::get('/languages/{id}','App\Http\Controllers\LanguageController@show');
Route::get('/languages','App\Http\Controllers\LanguageController@index');
Route::get('languages/{id}/films','App\Http\Controllers\LanguageFilmController@index');
Route::get('languages/{id}/avg','App\Http\Controllers\LanguageFilmController@avg_rental_rate');

//user
Route::post('/users','App\Http\Controllers\UserController@store');
Route::put('/users/{id}','App\Http\Controllers\UserController@update');
//Recevoir l’information du langage préféré d’un utilisateur
Route::get('/users/{id}/fav_language','App\Http\Controllers\UserController@fav_language');


//critiques
Route::delete('/critics/{id}','App\Http\Controllers\CriticController@delete');