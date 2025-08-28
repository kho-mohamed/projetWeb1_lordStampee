<?php
use App\Routes\Route;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Controllers\AuthController;

Route::get('', 'HomeController@index');
Route::get('/index', 'HomeController@index');

Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@store');
Route::get('/logout', 'AuthController@delete');

Route::get('/user/create', 'UserController@create');
Route::post('/user/store', 'UserController@store');
Route::get('/user/index', 'UserController@index');
Route::get('/user/edit', 'UserController@edit');
Route::post('/user/update', 'UserController@update');
Route::get('/user/delete', 'UserController@delete');

Route::get('/timbres/create', 'TimbreController@create');
Route::post('/timbres/store', 'TimbreController@store');
Route::get('/timbres/index', 'TimbreController@index');
Route::get('/timbres/edit', 'TimbreController@edit');
Route::post('/timbres/update', 'TimbreController@update');
Route::get('/timbres/delete', 'TimbreController@delete');

Route::get('/enchere/index', 'EnchereController@index');
Route::get('/enchere/show', 'EnchereController@show');
Route::get('/enchere/search', 'EnchereController@search');

Route::post('/mise/insert', 'MiseController@insert');
Route::get('/mise/index', 'MiseController@index');

Route::post('/favoris/insert', 'FavorisController@insert');
Route::post('/favoris/delete', 'FavorisController@delete');
Route::get('/favoris/index', 'FavorisController@index');

Route::dispatch();