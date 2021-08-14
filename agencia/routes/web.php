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
Route::post('/modificarRegion', function ()
{
    $regNombre = $_POST['regNombre'];
    $regID = $_POST['regID'];
    //modificamos
    /*DB::update('

                UPDATE regiones
                    SET regNombre = :regNombre
                  WHERE regID = :regID',
                    [ $regNombre, $regID ]
        );
    */
    DB::table('regiones')
            ->where('regID', $regID)
            ->update(
                [ 'regNombre'=>$regNombre ]
            );
    //redirección con mensaje ok (flashing)
    return redirect('/adminRegiones')
            ->with( [ 'mensaje'=>'Región: '.$regNombre.' modificada correctamente.' ] );
});
Route::get('/eliminarRegion/{id}', function ($id)
{
    /*
    $region = DB::select(
                    'SELECT regID, regNombre
                        FROM regiones
                        WHERE regID = :regID',
                            [ $regID ]
                );
    */
    $region = DB::table('regiones')
                    ->where('regID', $id)
                    ->first(); //fetch
    return view('eliminarRegion', [ 'region'=>$region ]);
});
Route::post('/eliminarRegion', function ()
{
    $regID = $_POST['regID'];
    $regNombre = $_POST['regNombre'];
    /*
      DB::delete('DELETE FROM regiones WHERE regID = :id', [ $regID ])
    */
    DB::table('regiones')
                ->where('regID', $regID)
                ->delete();
    return redirect('/adminRegiones')
        ->with( [ 'mensaje'=>'Región: '.$regNombre.' eliminada correctamente.' ] );
});

########################################
##### CRUD de destinos
Route::get('/adminDestinos', function ()
{
    //obtenemos listado de destinos
    /*$destinos = DB::select('
                        SELECT
                                destID, destNombre, destPrecio,
                                r.regNombre as region
                            FROM
                                destinos as d, regiones as r
                            WHERE d.regID = r.regID'
                    );*/
    /*
    $destinos = DB::select(
                    'SELECT destID, destNombre, destPrecio,
                                r.regNombre as region
                        FROM destinos as d
                        INNER JOIN regiones as r
                            ON d.regID = r.regID'
                    );
    */
    $destinos = DB::table('destinos as d')
                    ->join( 'regiones as r', 'd.regID', '=', 'r.regID' )
                    ->select( 'destID', 'destNombre', 'destPrecio', 'r.regNombre as region' )
                    ->get();
    return view('adminDestinos', [ 'destinos'=>$destinos ]);
});
