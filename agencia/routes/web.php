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
Route::get('/agregarRegion', function ()
{
    return view('agregarRegion');
});
Route::post('/agregarRegion', function ()
{
    //capturamos dato enviado
    $regNombre = $_POST['regNombre'];
    //guardamos en tabla regiones
    DB::insert(
                'INSERT INTO regiones
                            ( regNombre )
                          VALUE
                            ( :regNombre )',
                            [ $regNombre ]
        );
    //redirección con mensaje ok (flashing)
    return redirect('/adminRegiones')
                ->with( [ 'mensaje'=>'Región: '.$regNombre.' agregada correctamente.' ] );
});
Route::get('/modificarRegion/{id}', function ($id)
{
    /*
    $region = DB::select(
                        'SELECT regID, regNombre
                            FROM regiones
                            WHERE regID = :id',
                                        [ $id ]
                    );
    */
    $region = DB::table('regiones')
                    ->select('regID', 'regNombre')
                    ->where('regID', $id)
                    ->first();
    return view('modificarRegion', [ 'region' => $region ]);
});

########################################
##### CRUD de destinos
