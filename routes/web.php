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



Auth::routes();
Route::get('/',"Auth\LoginController@showLoginForm")->name("login");
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/alumnos/getAlumnos', "AlumnoController@getAlumnos" )->name("users");
Route::get('/computadores/getComputadores', "ComputadorController@getComputadores" )->name("computadores");
Route::get('/computadores/getComputadoresDisp', "ComputadorController@getComputadoresDisp" )->name("computadoresDisp");
Route::get('/computadores', "ComputadorController@index" )->name("computadores");
Route::post('/alumnos/crearAlumnos', 'AlumnoController@create');
Route::post('/alumnos/asignarPC', 'AlumnoController@asignarPc');
Route::post('/computadores/crearPC', 'ComputadorController@create');
Route::post('/computadores/asignar', 'ComputadorController@asignar');
Route::post("/aulas/crearAula","AulasController@create");
Route::post("/aulas/computadoras","AulasController@getComputadoras");
Route::get("/aulas","AulasController@index")->name("aulas");
Route::get("/aulas/getAulas","AulasController@getAulas");
Route::post("/alumnos/getPcAsignadas","AlumnoController@pcAsignadas");
Route::post("/aulas/agregarPC","AulasController@agregarComputadora");
Route::get("/reporte","ComputadorController@generarReporte")->name("reporte");
