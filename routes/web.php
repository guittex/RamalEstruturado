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
    return redirect()->route('ramal');
});

//Rotas do Ramal
Route::get('/index', ['uses' => 'RamalController@index', 'as' => 'ramal']);
Route::get('/pesquisar', ['uses' => 'RamalController@show', 'as' => 'ramal.pesquisar']);
Route::post('/cadastrar', ['uses' => 'RamalController@store', 'as' => 'ramal.cadastrar']);
Route::get('/apagar/{id}', ['uses' => 'RamalController@destroy', 'as' => 'ramal.apagar']);
Route::post('/editar', ['uses' => 'RamalController@edit', 'as' => 'ramal.editar']);

