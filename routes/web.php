<?php


use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Controladores
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\ProductoController;





Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::get('/Nosotros', function () {
    return Inertia::render('Sobre_Nosotros');
})->name('SobreNosotros');

Route::get('/Contacto', function () {
    return Inertia::render('Contacto');
})->name('Contacto');










// productos ----------------------------------------------------------
Route::get('/Productos', function () {
    return Inertia::render('Productos/Index');
})->name('Productos');

Route::get('/Ofertas', function () {
    return Inertia::render('Ofertas');
})->name('Ofertas');



Route::get('/Productos/Crear', function () {
    return Inertia::render('Productos/Crear'); // Asegúrate de que el nombre coincida con el componente Vue creado
}) ;

Route::post('/productos/create', [ProductoController::class, 'create'])->name('productos.create');

Route::get('Productos/{producto}', [ProductoController::class, 'show']);

Route::get('/Productos/search/{buscar?}', [ProductoController::class, 'search'])->name('productos.search');
Route::get('/Productos/search', [ProductoController::class, 'search'])->name('productos.search');

Route::get('pp', [ProductoController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test', function () {
    return Inertia::render('Sobre_Nosotros');
});

require __DIR__.'/auth.php';
