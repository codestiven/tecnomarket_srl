<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\CategoriaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/ProductoCount', [ProductoController::class, 'ContadorProductos']);

Route::get('/Categorias', [CategoriaController::class, 'index']);





Route::get('/Marcas', [MarcaController::class, 'index']);
