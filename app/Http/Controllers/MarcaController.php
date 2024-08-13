<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Producto;

use Illuminate\Http\Request;


class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las marcas
        $marcas = Marca::all();

        // Iterar sobre cada marca y agregar la cantidad de productos
        $marcasConCantidad = $marcas->map(function ($marca) {
            // Contar la cantidad de productos para la marca actual
            $cantidadProductos = Producto::where('marca_id', $marca->id)->count();

            // Agregar la cantidad de productos al objeto de la marca
            return [
                'id' => $marca->id,
                'nombre' => $marca->nombre,
                'created_at' => $marca->created_at,
                'updated_at' => $marca->updated_at,
                'cantidad_productos' => $cantidadProductos
            ];
        });

        // Retornar la lista de marcas con la cantidad de productos en formato JSON
        return response()->json([
            'marcas' => $marcasConCantidad
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
    public function show(Marca $marca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marca $marca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marca $marca)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marca $marca)
    {
        //
    }
}
