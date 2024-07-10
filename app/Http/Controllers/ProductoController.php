<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Requests;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();

        // Iterar sobre cada producto para obtener la URL completa de la imagen
        foreach ($productos as $producto) {
            $producto->image = Storage::url($producto->image);
        }

        // Devolver la respuesta JSON con todos los productos actualizados
        return response()->json(['productos' => $productos]);
        
    }


    public function search(Request $request, $buscar = null)
    {
        if ($buscar != "*") {
            $resultados = Producto::where('nombre', 'like', '%' . $buscar . '%')->get();
        } else {
            $resultados = Producto::inRandomOrder()->get();
        }

        foreach ($resultados as $resultado) {
            $resultado->image = Storage::url($resultado->image);
        }

        return Inertia::render('Productos/Buscar', [
            'productos' => $resultados
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Validación de campos
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id',
            'marca_id' => 'required|exists:marcas,id',
            'oferta_id' => 'nullable|exists:ofertas,id',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // Almacenar imagen
            $imagenPath = $request->file('imagen')->store('public/productos');

            // Crear producto en base de datos
            $producto = Producto::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'categoria_id' => $request->categoria_id,
                'marca_id' => $request->marca_id,
                'oferta_id' => $request->oferta_id,
                'image' => $imagenPath,
            ]);

            return response()->json(['message' => 'Producto creado correctamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al guardar el producto: ' . $e->getMessage()], 500);
        }
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
    public function show(Producto $producto)
    {
        $producto->image = Storage::url($producto->image);

        // return response()->json(['producto' => $producto]);


        return Inertia::render('Productos/producto', [
            'producto' => $producto
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
