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

require __DIR__.'/auth.php';
