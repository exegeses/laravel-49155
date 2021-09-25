<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('adminMarcas', [ MarcaController::class, 'index' ])
                ->middleware(['auth'])
                ->name('adminMarcas');


require __DIR__.'/auth.php';
