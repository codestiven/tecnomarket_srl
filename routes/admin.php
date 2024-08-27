<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use Inertia\Inertia;

Route::post('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
Route::put('/api/productos/{producto}', [ProductoController::class, 'update']);
Route::delete('/api/productos/{id}', [ProductoController::class, 'destroy']);



Route::get('/admin', function () {
    return Inertia::render('Admin/Index');
});
