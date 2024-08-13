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
        // Aquí puedes devolver una vista o datos necesarios para crear una nueva Marca
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Crea una nueva Marca en la base de datos
        $marca = Marca::create([
            'nombre' => $request->input('nombre'),
        ]);

        // Retorna la respuesta con los datos de la Marca creada
        return response()->json($marca, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Marca $marca)
    {
        // Devuelve los datos de la Marca solicitada
        return response()->json($marca);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marca $marca)
    {
        // Aquí puedes devolver una vista o datos necesarios para editar una Marca
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marca $marca)
    {
        // Valida los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Actualiza los datos de la Marca en la base de datos
        $marca->update([
            'nombre' => $request->input('nombre'),
        ]);

        // Retorna la respuesta con los datos de la Marca actualizada
        return response()->json($marca);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marca $marca)
    {
        // Elimina la Marca de la base de datos
        $marca->delete();

        // Retorna una respuesta indicando que la Marca ha sido eliminada
        return response()->json(['message' => 'Marca eliminada correctamente']);
    }
}
