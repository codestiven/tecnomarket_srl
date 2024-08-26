<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use Inertia\Inertia;

Route::post('/productos/create', [ProductoController::class, 'create'])->name('productos.create');

Route::get('/admin', function () {
    return Inertia::render('Admin/Index');
});
