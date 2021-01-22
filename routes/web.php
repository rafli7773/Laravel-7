<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/search/player/', 'SearchController@player');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/teams', 'TeamController@index');
Route::prefix('teams')->middleware('auth')->group(function () {
    Route::get('/create', 'TeamController@create');
    Route::post('/create', 'TeamController@store');
    Route::get('/{team:slug}/edit', 'TeamController@edit');
    Route::patch('/{team:slug}/edit', 'TeamController@update');
    Route::delete('/{team:slug}', 'TeamController@destroy');
});
Route::get('/teams/{team:slug}', 'TeamController@show');

Route::get('/players', 'PlayerController@index');
Route::prefix('/players')->middleware('auth')->group(function () {
    Route::get('/create', 'PlayerController@create');
    Route::post('/create', 'PlayerController@store');
    Route::get('/{player:slug}/edit', 'PlayerController@edit');
    Route::patch('/{player:slug}/edit', 'PlayerController@update');
    Route::delete('/{player:slug}', 'PlayerController@destroy');
});
Route::get('/players/{player:slug}', 'PlayerController@show');

Route::get('/tags', 'TagController@index');
Route::prefix('tags')->middleware('auth')->group(function () {
    Route::get('/create', 'TagController@create');
    Route::post('/create', 'TagController@store');
    Route::get('/{tag:slug}/edit', 'TagController@edit');
    Route::patch('/{tag:slug}/edit', 'TagController@update');
    Route::delete('/{tag:slug}', 'TagController@destroy');
});
Route::get('tags/{tag:slug}/', 'TagController@show');
