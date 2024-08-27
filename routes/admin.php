<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarouselController;
use Inertia\Inertia;

Route::post('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
Route::put('/api/productos/{producto}', [ProductoController::class, 'update']);
Route::delete('/api/productos/{id}', [ProductoController::class, 'destroy']);



Route::get('/carousels', [CarouselController::class, 'index']);
Route::post('/carousels', [CarouselController::class, 'store']);
Route::get('/carouselss/{id}', [CarouselController::class, 'show']);
Route::post('/carousels/{id}', [CarouselController::class, 'update']);
Route::delete('/carousels/{id}', [CarouselController::class, 'destroy']);




Route::get('/admin', function () {
    return Inertia::render('Admin/Index');
});
