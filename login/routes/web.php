<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

##################################
### CRUD de marcas
Route::get('/adminMarcas', [ MarcaController::class, 'index' ])
                ->middleware(['auth'])
                ->name('adminMarcas');
Route::get('/marca/create', [ MarcaController::class, 'create' ])
                ->middleware(['auth'])
                ->name('agregarMarca');
Route::post('/marca/store', [ MarcaController::class, 'store' ])
                ->middleware(['auth']);
Route::get('/marca/edit/{id}', [ MarcaController::class, 'edit' ])
                ->middleware(['auth'])
                ->name('modificarMarca');
Route::put('/marca/update', [ MarcaController::class, 'update' ])
                ->middleware(['auth']);
##################################
### CRUD de categorías
Route::get('/adminCategorias', [ CategoriaController::class, 'index' ])
                ->middleware(['auth'])
                ->name('adminCategorias');

##################################
### CRUD de productos
Route::get('/adminProductos', [ ProductoController::class, 'index' ])
                ->middleware(['auth'])
                ->name('adminProductos');
Route::get('/producto/create', [ ProductoController::class, 'create' ])
                ->middleware(['auth'])
                ->name('agregarProducto');


require __DIR__.'/auth.php';
