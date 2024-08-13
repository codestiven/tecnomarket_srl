<?php

namespace App\Http\Controllers;

use App\Models\Guardado;
use Illuminate\Http\Request;

class GuardadoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
        ]);

        $user = $request->user(); // Obtiene el usuario autenticado
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
        $user = auth()->user();

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
        $user = auth()->user();
        $guardados = $user->guardados()->with('producto')->get();

        return response()->json($guardados);
    }
}
