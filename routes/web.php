<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::get('/Nosotros', function () {
    return Inertia::render('Productos');
})->name('SobreNosotros');

Route::get('/Contacto', function () {
    return Inertia::render('Productos');
})->name('Contacto');










// productos ----------------------------------------------------------
Route::get('/Productos', function () {
    return Inertia::render('Productos');
})->name('Productos');

Route::get('/Ofertas', function () {
    return Inertia::render('Productos');
})->name('Ofertas');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test', function () {
    return Inertia::render('Sobre_Nosotros');
});

require __DIR__.'/auth.php';
