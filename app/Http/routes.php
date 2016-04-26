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

Route::get("/create", 'MainController@create');
Route::post("/save", 'MainController@save');
Route::delete("/delete", 'MainController@delete');

Route::group(['prefix' => 'busca'], function(){
    Route::get('/', 'FrontEndController@pesquisas');
    Route::get('/{key}', 'FrontEndController@busca');
});

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', function(){
    Auth::logout();
});

Route::post('/pesquisa/create', 'FrontEndController@createPesquisa');
Route::get('/pesquisa/create', function(){
    return view('pesquisa.create');
});

Route::get('/', function(){
    return view('home');
}) ;