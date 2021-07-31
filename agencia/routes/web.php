<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('peticion', acción);
Route::get('/saludo', function ()
{
    return 'Hola Mundo desde Laravel!';
});
Route::get('/test.html', function ()
{
    $fruta = 'manzana';
    $nombre = 'marcos';
    return view('primera',
                    [
                        'fruta'=>$fruta,
                        'nombre'=>$nombre
                    ]
            );
});

########################################
##### BDD
Route::get('/regiones', function ()
{
    //obtenemos listado de regiones
    $regiones = DB::select('SELECT regID, regNombre FROM regiones');
    return view('regiones', [ 'regiones'=>$regiones ]);
});

Route::get('/inicio', function ()
{
    return view('inicio');
});

########################################
##### CRUD de regiones
Route::get('/adminRegiones', function()
{
    $regiones = DB::select('SELECT regID, regNombre FROM regiones');
    return view('adminRegiones', [ 'regiones'=>$regiones ]);
});

########################################
##### CRUD de destinos
