<?php


use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\GuardadoController;


// Controladores
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');







Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::get('/api/suggestions', [SuggestionController::class, 'index']);

Route::get('/MyCart', function () {
    return Inertia::render('Cart');
})->name('Cart');






Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');





Route::get('/Nosotros', function () {
    return Inertia::render('Sobre_Nosotros');
})->name('SobreNosotros');

Route::get('/Contacto', function () {
    return Inertia::render('Contacto');
})->name('Contacto');






Route::post('/contact', [MessageController::class, 'store']);

Route::get('/Ofertas', function () {
    // return Inertia::render('Ofertas');
    return redirect('/Productos?categoria_id=&en_oferta=solo_ofertas&marca_id=');
})->name('Ofertas');

Route::get('/Help', function () {
    return Inertia::render('Help');
})->name('Help');




// productos ----------------------------------------------------------
Route::get('/Productos', [ProductoController::class, 'Productos'])->name('Productos');



Route::get('/Productos/Crear', function () {
    return Inertia::render('Productos/Crear'); // Asegúrate de que el nombre coincida con el componente Vue creado
}) ;



Route::get('Productos/{producto}', [ProductoController::class, 'show']);



//seach

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






Route::middleware('auth')->group(function () {
    Route::get('/guardados', [GuardadoController::class, 'index'])->name('guardados.index');
    Route::get('/guardadosjson', [GuardadoController::class, 'indexjson'])->name('guardados.json');
    Route::post('/guardados', [GuardadoController::class, 'store'])->name('guardados.store');
    Route::delete('/guardados/{producto_id}', [GuardadoController::class, 'destroy'])->name('guardados.destroy');

    // Nueva ruta para ver los "me gustas" de un producto

    Route::get('/guardados/MyLikes', [GuardadoController::class, 'getGuardadosCount'])->name('guardados.MyLikes');
});

Route::get('/guardados/likes/{producto_id}', [GuardadoController::class, 'showLikes'])->name('guardados.likes');



// Ruta para mostrar el formulario de edición del perfil
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

// Ruta para actualizar el perfil
Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// Ruta para eliminar la cuenta del usuario
Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/updateother', [ProfileController::class, 'updateother'])->name('profile.updateother');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});








require __DIR__.'/auth.php';
require __DIR__ . '/admin.php';
