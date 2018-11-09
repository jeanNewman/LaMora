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
    return view('welcome');
});

Route::get('/admin/dashboard','AdminController@dashboard')->name('dashboard');
Route::get('/admin/categoria','CategoriaController@index')->name('categoria_index');
Route::get('/admin/categoria/secciones','CategoriaController@secciones')->name('categoria_secciones');
Route::put('/admin/categoria/actualizar','CategoriaController@update')->name('categoria_actualizar');
Route::put('/admin/categoria/desactivar','CategoriaController@desactivar')->name('categoria_desactivar');
Route::put('/admin/categoria/activar','CategoriaController@activar')->name('categoria_activar');
Route::get('/admin/categoria/listaFiltroRecetas','CategoriaController@listaFiltroRecetas')->name('categoria_listaFiltroRecetas');
Route::get('/admin/categoria/listarCards','CategoriaController@listarCards')->name('categoria_listarCards');


