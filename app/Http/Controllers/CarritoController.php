<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function index()
    {
        // Devuelve todos los carritos
        return Carrito::with('pedidos')->get();
    }

    public function show($id)
    {
        // Devuelve un carrito específico
        return Carrito::with('pedidos')->findOrFail($id);
    }

    public function store(Request $request)
    {
        // Validar que los IDs de los productos se pasen en la solicitud
        $request->validate([
            'producto_ids' => 'required|array',
            'producto_ids.*' => 'exists:productos,id',
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar si el usuario no está autenticado
        if (!$user) {
            return response()->json(['message' => 'No autenticado.'], 401);
        }

        // Crear un nuevo carrito para el usuario autenticado
        $carrito = Carrito::create([
            'user_id' => $user->id,
        ]);

        // Crear un pedido para cada producto en el carrito
        foreach ($request->producto_ids as $productoId) {
            Pedido::create([
                'producto_id' => $productoId,
                'user_id' => $user->id,
                'carrito_id' => $carrito->id, // Asociar el pedido al carrito recién creado
                // 'estado' no se establece aquí porque tiene un valor por defecto en la base de datos
            ]);
        }

        // Responder con el carrito creado y los pedidos asociados
        return response()->json([
            'message' => 'Carrito y pedidos creados con éxito',
            'carrito' => $carrito->load('pedidos'), // Carga los pedidos relacionados con el carrito
        ], 201);
    }


}
