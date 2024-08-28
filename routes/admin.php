<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CategoriaController;
use Inertia\Inertia;

Route::post('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
Route::put('/api/productos/{producto}', [ProductoController::class, 'update']);
Route::delete('/api/productos/{id}', [ProductoController::class, 'destroy']);



Route::get('/carousels', [CarouselController::class, 'index']);
Route::post('/carousels', [CarouselController::class, 'store']);
Route::get('/carouselss/{id}', [CarouselController::class, 'show']);
Route::post('/carousels/{id}', [CarouselController::class, 'update']);
Route::delete('/carousels/{id}', [CarouselController::class, 'destroy']);

Route::get('/users', [RegisteredUserController::class, 'index']);
Route::get('/users/{id}', [RegisteredUserController::class, 'show']);

Route::get('/Message', [MessageController::class, 'index']);
Route::delete('/Message/{id}', [MessageController::class, 'destroy']);

// Route::prefix('Marcas')->group(function () {
//     Route::get('/', [MarcaController::class, 'index']);
//     Route::post('/', [MarcaController::class, 'store']);
//     Route::get('/create', [MarcaController::class, 'create']);
//     Route::get('/{marca}', [MarcaController::class, 'show']);
//     Route::get('/{marca}/edit', [MarcaController::class, 'edit']);
//     Route::put('/{marca}', [MarcaController::class, 'update']);
//     Route::delete('/{marca}', [MarcaController::class, 'destroy']);
// });

Route::resource('marcas', MarcaController::class);

// Rutas para las categorías
Route::get('/categorias', [CategoriaController::class, 'index']);
Route::post('/categorias', [CategoriaController::class, 'store']);
Route::get('/categorias/{categoria}', [CategoriaController::class, 'show']);
Route::put('/categorias/{categoria}', [CategoriaController::class, 'update']);
Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy']);


Route::get('/admin', function () {
    return Inertia::render('Admin/Index');
});
