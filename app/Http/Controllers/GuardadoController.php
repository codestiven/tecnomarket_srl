<?php

namespace App\Http\Controllers;

use App\Models\Guardado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class GuardadoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
        ]);

        $user = Auth::user(); // Obtiene el usuario autenticado
        $producto_id = $request->input('producto_id');

        // Verifica si el producto ya está guardado por el usuario
        $guardado = Guardado::where('user_id', $user->id)
            ->where('producto_id', $producto_id)
            ->first();

        if ($guardado) {
            return response()->json(['message' => 'Producto ya guardado'], 400);
        }

        Guardado::create([
            'user_id' => $user->id,
            'producto_id' => $producto_id,
        ]);

        return response()->json(['message' => 'Producto guardado correctamente'], 201);
    }

    public function destroy($producto_id)
    {
        $user = Auth::user();

        $guardado = Guardado::where('user_id', $user->id)
            ->where('producto_id', $producto_id)
            ->first();

        if (!$guardado) {
            return response()->json(['message' => 'No se encontró el producto guardado'], 404);
        }

        $guardado->delete();

        return response()->json(['message' => 'Producto eliminado de guardados'], 200);
    }





    public function index()
    {
        $user = Auth::user();

        // Verifica si el usuario está autenticado
        if (!$user) {
            return redirect()->route('login'); // Redirige al login si no está autenticado
        }

        // Obtener todos los productos guardados por el usuario autenticado
        $guardados = Guardado::with('producto')
            ->where('user_id', $user->id)
            ->get();

        // Verifica si el usuario no tiene productos guardados
        if ($guardados->isEmpty()) {
            // Puedes decidir si quieres manejar esto de alguna manera en la vista
        }

        // Modificar las URLs de las imágenes para usar el almacenamiento
        foreach ($guardados as $guardado) {
            if ($guardado->producto->image) {
                $guardado->producto->image = Storage::url($guardado->producto->image);
            }
        }

        // Pasar los datos a Inertia
        return Inertia::render('Guardados', [
            'guardados' => $guardados
        ]);
    }



}
