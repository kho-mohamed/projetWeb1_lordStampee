<?php
use App\Routes\Route;
use App\Controllers\HomeController;
// use App\Controllers\ClientController;
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

Route::get('/enchere/index', 'EnchereController@index');
Route::get('/enchere/show', 'EnchereController@show');

// Route::get('/clients', 'ClientController@index');
// Route::get('/client/show', 'ClientController@show');
// Route::get('/client/create', 'ClientController@create');
// Route::post('/client/store', 'ClientController@store');
// Route::get('/client/edit', 'ClientController@edit');
// Route::post('/client/edit', 'ClientController@update');
// Route::post('/client/delete', 'ClientController@delete');





Route::dispatch();