<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\GuardadoController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\ProvinciaController;








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




Route::get('/productos/filtrar', [ProductoController::class, 'filtrarProductos']);
Route::get('/productosAll', [ProductoController::class, 'index']);
Route::post('/productos/por-ids', [ProductoController::class, 'getProductsByIds']);


Route::get('productos/ofertas', [ProductoController::class, 'obtenerProductosEnOferta']);



Route::get('/carousels', [CarouselController::class, 'index']);
Route::get('/carousels/{id}', [CarouselController::class, 'show']);

Route::get('/province', [ProvinciaController::class, 'index']);


