<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PedidoController extends Controller
{
    public function index()
    {
        // Devuelve todos los pedidos
        return Pedido::with('producto')->get();
    }

    public function show($id)
    {
        // Devuelve un pedido específico
        return Pedido::with('producto')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'carrito_id' => 'nullable|exists:carritos,id',
        ]);

        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'No autenticado.'], 401);
        }

        // Verifica si el usuario ya ha comprado el mismo producto
        $existingOrder = Pedido::where('user_id', $user->id)
            ->where('producto_id', $request->producto_id)
            ->exists();

        if ($existingOrder) {
            return response()->json(['message' => 'Ya has comprado este producto anteriormente.'], 400);
        }

        // Crea un nuevo pedido
        $pedido = Pedido::create([
            'producto_id' => $request->producto_id,
            'user_id' => $user->id,
            'carrito_id' => $request->carrito_id,
        ]);

        return response()->json(['message' => 'Pedido creado con éxito.', 'pedido' => $pedido], 201);
    }


}
