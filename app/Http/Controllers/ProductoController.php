<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Requests;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use App\Models\Categoria;
use App\Models\Marca;

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

    public function Filtro(Request $request)
    {

        //http://tecnomarket_srl.test/pp?categoria_id=1&marca_id=1
        // Obtener los parámetros de la URL
        $categoria_id = $request->query('categoria_id');
        $marca_id = $request->query('marca_id');

        // Iniciar la consulta de productos
        $productos = Producto::query();

        // Aplicar filtro por categoria_id si está presente
        if ($categoria_id !== null) {
            $productos->where('categoria_id', $categoria_id);
        }

        // Aplicar filtro por marca_id si está presente
        if ($marca_id !== null) {
            $productos->where('marca_id', $marca_id);
        }

        // Obtener todos los productos si no se especifican filtros
        if ($categoria_id === null && $marca_id === null) {
            $productos->get();
        }

        // Ejecutar la consulta y obtener los resultados
        $productos = $productos->get();

        // Retornar los productos como JSON
        return response()->json(['productos' => $productos]);
    }


    public function search($buscar = null)
    {
        if ($buscar != "*") {
            $resultados = Producto::with(['categoria', 'marca', 'oferta']) // Cargar relaciones
            ->where('nombre', 'like', '%' . $buscar . '%')
            ->orWhere('descripcion', 'like', '%' . $buscar . '%')
            ->get();
        } else {
            $resultados = Producto::with(['categoria', 'marca', 'oferta']) // Cargar relaciones
            ->inRandomOrder()
                ->get();
        }

        foreach ($resultados as $resultado) {
            $resultado->image = Storage::url($resultado->image);
        }

        return Inertia::render('Productos/Buscar', [
            'productos' => $resultados,
            'buscado' => $buscar
        ]);


        // return response()->json([
        //     'resultados' => $resultados
        // ]);
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
        // Cargar las relaciones asociadas con el producto
        $producto = Producto::with(['categoria', 'marca', 'oferta', 'detallesProducto'])->findOrFail($producto->id);

        // Obtener la URL de la imagen del producto
        $producto->image = Storage::url($producto->image);

        // Enviar tanto el producto como sus detalles a la vista
        return Inertia::render('Productos/producto', [
            'producto' => $producto,
            'detallesProducto' => $producto->detallesProducto
        ]);

        // return response()->json(['producto' => $producto]);
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

    public function ContadorProductos()
    {
        // Contar la cantidad de productos
        $cantidadProductos = Producto::count();

        // Retornar la cantidad en formato JSON
        return response()->json([
            'ProductosCount' => $cantidadProductos
        ]);
    }

    // http://tecnomarket_srl.test/productos/filtrar?categoria_id=1&marca_id=1&en_oferta=sin_ofertas
    public function filtrarProductos(Request $request)
    {
        // Obtener los parámetros de la URL
        $categoria_id = $request->query('categoria_id');
        $marca_id = $request->query('marca_id');
        $en_oferta = $request->query('en_oferta'); // Valores esperados: "todos", "solo_ofertas", "sin_ofertas"

        // Iniciar la consulta de productos con las relaciones cargadas
        $productos = Producto::with(['categoria', 'marca', 'oferta', 'detallesProducto']);

        // Aplicar filtro por categoria_id si está presente
        if ($categoria_id !== null) {
            $productos->where('categoria_id', $categoria_id);
        }

        // Aplicar filtro por marca_id si está presente
        if ($marca_id !== null) {
            $productos->where('marca_id', $marca_id);
        }

        // Aplicar filtro por oferta si está presente
        if ($en_oferta !== null) {
            if ($en_oferta === 'solo_ofertas') {
                $productos->whereNotNull('oferta_id');
            } elseif ($en_oferta === 'sin_ofertas') {
                $productos->whereNull('oferta_id');
            }
        }

        // Ejecutar la consulta con paginación
        $productos = $productos->paginate(30); 

        // Añadir la URL completa de la imagen a cada producto
        foreach ($productos as $producto) {
            $producto->image = Storage::url($producto->image);
        }

        // Retornar los productos filtrados con paginación como JSON
        return response()->json($productos);
    }

    public function Productos(Request $request)
    {
        // Obtener las categorías y marcas desde la base de datos
        $categorias = Categoria::all();
        $marcas = Marca::all();

        // Renderizar la vista de Inertia y pasar las categorías y marcas como props
        return Inertia::render('Productos/Index', [
            'categorias' => $categorias,
            'marcas' => $marcas,
        ]);
    }


}
