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

Route::group(['middleware' => 'auth'], function() {
	Route::get('/classes', 'ClasseController@index');
	Route::get('/classes/incluir', 'ClasseController@create');
	Route::post('classes/armazenar', 'ClasseController@store');
	Route::get('/classes/{id}/alterar', 'ClasseController@edit');
	Route::put('classes/{id}', 'ClasseController@update');
	Route::delete('classes/{id}', 'ClasseController@destroy');

	Route::get('/especialidades', 'EspecialidadeController@index');
	Route::get('especialidades/incluir', 'EspecialidadeController@create');
	Route::post('especialidades/armazenar', 'EspecialidadeController@store');
	Route::get('especialidades/{id}/alterar', 'EspecialidadeController@edit');
	Route::put('especialidades/{id}', 'EspecialidadeController@update');
	Route::delete('especialidades/{id}', 'EspecialidadeController@destroy');

	Route::get('/personagens', 'PersonagemController@index');
	Route::get('/personagens/incluir', 'PersonagemController@create');
	Route::post('/personagens/armazenar', 'PersonagemController@store');
	Route::get('/personagens/{id}', 'PersonagemController@show');
	Route::get('/personagens/{id}/alterar', 'PersonagemController@edit');
	Route::put('/personagens/{id}', 'PersonagemController@update');
	Route::delete('personagens/{id}', 'PersonagemController@destroy');

	Route::get('/raids', 'RaidController@index');
	Route::get('/raids/incluir', 'RaidController@create');
	Route::post('raids/armazenar', 'RaidController@store');
	Route::get('raids/{id}', 'RaidController@show');
	Route::get('raids/{id}/alterar', 'RaidController@edit');
	Route::put('raids/{id}', 'RaidController@update');
	Route::delete('raids/{id}', 'RaidController@destroy');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
