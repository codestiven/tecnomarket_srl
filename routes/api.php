<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\GuardadoController;
use App\Http\Controllers\CarouselController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/ProductoCount', [ProductoController::class, 'ContadorProductos']);


Route::get('/Productoliked', [GuardadoController::class, 'getGuardados']);


// Route::get('/Marcas', [MarcaController::class, 'index']);


Route::prefix('Categorias')->group(function () {
    Route::get('/', [CategoriaController::class, 'index']);
    Route::post('/', [CategoriaController::class, 'store']);
    Route::get('/{categoria}', [CategoriaController::class, 'show']);
    Route::put('/{categoria}', [CategoriaController::class, 'update']);
    Route::delete('/{categoria}', [CategoriaController::class, 'destroy']);
});

Route::prefix('Marcas')->group(function () {
    Route::get('/', [CategoriaController::class, 'index']);
    Route::post('/', [MarcaController::class, 'store']);
    Route::get('/create', [MarcaController::class, 'create']);
    Route::get('/{marca}', [MarcaController::class, 'show']);
    Route::get('/{marca}/edit', [MarcaController::class, 'edit']);
    Route::put('/{marca}', [MarcaController::class, 'update']);
    Route::delete('/{marca}', [MarcaController::class, 'destroy']);
});


Route::get('/productos/filtrar', [ProductoController::class, 'filtrarProductos']);




Route::get('/carousels', [CarouselController::class, 'index']);
Route::post('/carousels', [CarouselController::class, 'store']);
Route::get('/carousels/{id}', [CarouselController::class, 'show']);

