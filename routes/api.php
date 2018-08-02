<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function() {
	Route::get('/classes', 'ClasseController@index');
	Route::post('/classes', 'ClasseController@store');
	Route::get('/classes/{id}', 'ClasseController@show');
	Route::put('/classes/{id}', 'ClasseController@update');
	Route::delete('/classes/{id}', 'ClasseController@destroy');

	Route::get('/especialidades', 'EspecialidadeController@index');
	Route::post('/especialidades', 'EspecialidadeController@store');
	Route::get('/especialidades/{id}', 'EspecialidadeController@show');
	Route::put('/especialidades/{id}', 'EspecialidadeController@update');
	Route::delete('/especialidades/{id}', 'EspecialidadeController@destroy');

	Route::get('/personagens', 'PersonagemController@index');
	Route::post('/personagens', 'PersonagemController@store');
	Route::get('/personagens/{id}', 'PersonagemController@show');
	Route::put('/personagens/{id}', 'PersonagemController@update');
	Route::patch('/personagens/{id}', 'PersonagemController@update');
	Route::delete('/personagens/{id}', 'PersonagemController@destroy');

	Route::get('/raids', 'RaidController@index');
	Route::post('/raids', 'RaidController@store');
	Route::get('/raids/{id}', 'RaidController@show');
	Route::put('/raids/{id}', 'RaidController@update');
	Route::patch('/raids/{id}', 'RaidController@update');
	Route::delete('/raids/{id}', 'RaidController@destroy');
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


