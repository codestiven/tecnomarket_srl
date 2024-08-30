<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

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
}
