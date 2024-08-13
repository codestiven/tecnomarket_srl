<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Producto;

class CategoriaController extends Controller
{

    public function index()
    {
        // Obtener todas las categorías
        $categorias = Categoria::all();

        // Iterar sobre cada categoría y agregar la cantidad de productos
        $categoriasConCantidad = $categorias->map(function ($categoria) {
            // Contar la cantidad de productos para la categoría actual
            $cantidadProductos = Producto::where('categoria_id', $categoria->id)->count();

            // Agregar la cantidad de productos al objeto de la categoría
            return [
                'id' => $categoria->id,
                'nombre' => $categoria->nombre,
                'created_at' => $categoria->created_at,
                'updated_at' => $categoria->updated_at,
                'cantidad_productos' => $cantidadProductos
            ];
        });

        // Retornar la lista de categorías con la cantidad de productos en formato JSON
        return response()->json([
            'categorias' => $categoriasConCantidad
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
}
