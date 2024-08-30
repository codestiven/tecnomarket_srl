<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\Http\Request;

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
}
