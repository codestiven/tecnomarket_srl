<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\MarcaController;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\GuardadoController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\SuggestionController;






// Rutas de Productos
Route::get('/ProductoCount', [ProductoController::class, 'ContadorProductos']);
Route::get('/productosAll', [ProductoController::class, 'index']);
Route::get('/productos/filtrar', [ProductoController::class, 'filtrarProductos']);
Route::get('productos/ofertas', [ProductoController::class, 'obtenerProductosEnOferta']);
Route::post('/productos/por-ids', [ProductoController::class, 'getProductsByIds']);

// Rutas de Productos Guardados (Liked)
Route::get('/Productoliked', [GuardadoController::class, 'getGuardados']);

// Rutas de Categorías
Route::prefix('Categorias')->group(function () {
    Route::get('/', [CategoriaController::class, 'index']);
    Route::post('/', [CategoriaController::class, 'store']);
    Route::get('/{categoria}', [CategoriaController::class, 'show']);
    Route::put('/{categoria}', [CategoriaController::class, 'update']);
    Route::delete('/{categoria}', [CategoriaController::class, 'destroy']);
});

// Rutas de Marcas
Route::prefix('Marcas')->group(function () {
    Route::get('/', [MarcaController::class, 'index']);
    Route::get('/create', [MarcaController::class, 'create']);
    Route::get('/{marca}', [MarcaController::class, 'show']);
    Route::get('/{marca}/edit', [MarcaController::class, 'edit']);
});

// Rutas de Sugerencias
Route::get('/suggestions', [SuggestionController::class, 'index']);

// Rutas de Carruseles
Route::get('/carousels', [CarouselController::class, 'index']);
Route::get('/carousels/{id}', [CarouselController::class, 'show']);

// Rutas de Provincias
Route::get('/province', [ProvinciaController::class, 'index']);
