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
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'precio' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id',
            'marca_id' => 'required|exists:marcas,id',
            'es_oferta' => 'nullable|boolean',
            'precio_oferta' => 'nullable|numeric|required_if:es_oferta,1',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Añadir validaciones para detalles de producto
            'color' => 'nullable|string|max:50',
            'peso' => 'nullable|numeric',
            'pantalla' => 'nullable|string|max:50',
            'sistema_operativo' => 'nullable|string|max:50',
            'procesador' => 'nullable|string|max:50',
            'ram' => 'nullable|integer',
            'almacenamiento' => 'nullable|integer',
            'tipo_de_almacenamiento' => 'nullable|in:SSD,HDD',
            'tarjeta_grafica' => 'nullable|string|max:50',
            'consumo_energetico' => 'nullable|integer',
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
                'image' => $imagenPath,
                'es_oferta' => $request->es_oferta ? true : false,
            ]);

            // Crear oferta si es_oferta es verdadero
            if ($request->es_oferta) {
                $producto->oferta()->create([
                    'precio_oferta' => $request->precio_oferta,
                ]);
            }

            // Crear detalles del producto
            $producto->detallesProducto()->create([
                'color' => $request->color,
                'peso' => $request->peso,
                'pantalla' => $request->pantalla,
                'sistema_operativo' => $request->sistema_operativo,
                'procesador' => $request->procesador,
                'ram' => $request->ram,
                'almacenamiento' => $request->almacenamiento,
                'tipo_de_almacenamiento' => $request->tipo_de_almacenamiento,
                'tarjeta_grafica' => $request->tarjeta_grafica,
                'consumo_energetico' => $request->consumo_energetico,
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
public function update(Request $request, $id)
{
    $validated = $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'precio' => 'required|numeric|min:0',
        'categoria_id' => 'required|exists:categorias,id',
        'marca_id' => 'required|exists:marcas,id',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $producto = Producto::findOrFail($id);
    $producto->update($validated);

    // Manejo del archivo de imagen si se carga
    if ($request->hasFile('imagen')) {
        $path = $request->file('imagen')->store('productos');
        $producto->update(['image' => $path]);
    }

    return response()->json(['message' => 'Producto actualizado con éxito']);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);

        // Eliminar la imagen del almacenamiento
        if (Storage::exists($producto->image)) {
            Storage::delete($producto->image);
        }

        // Eliminar el producto
        $producto->delete();

        return response()->json(['message' => 'Producto eliminado correctamente'], 200);
    }

    /**
     * Display a listing of all products.
     */
    public function productosAll()
    {
        $productos = Producto::all();

        // Iterar sobre cada producto para obtener la URL completa de la imagen
        foreach ($productos as $producto) {
            $producto->image = Storage::url($producto->image);
        }

        return response()->json(['productos' => $productos]);
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

    // http://tecnomarket_srl.test/api/productos/filtrar?categoria_id=1&marca_id=1&en_oferta=sin_ofertas
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
                $productos->where('es_oferta', 1); // Solo productos en oferta
            } elseif ($en_oferta === 'sin_ofertas') {
                $productos->where('es_oferta', 0); // Solo productos que no están en oferta
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

    public function getProductsByIds(Request $request)
    {
        // Validar la solicitud para asegurarse de que se recibe una lista de IDs
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:productos,id',
        ]);

        // Obtener la lista de IDs desde la solicitud
        $ids = $request->input('ids');

        // Obtener los productos que coinciden con los IDs proporcionados y cargar las relaciones
        $productos = Producto::with(['categoria', 'marca', 'oferta', 'detallesProducto'])
            ->whereIn('id', $ids)
            ->get();

        // Añadir la URL completa de la imagen a cada producto
        foreach ($productos as $producto) {
            $producto->image = Storage::url($producto->image);
        }

        // Devolver los productos filtrados como JSON
        return response()->json(['productos' => $productos]);
    }

    public function obtenerProductosEnOferta()
    {

        // Obtener los productos en oferta, priorizándolos
        $productosEnOferta = Producto::with(['categoria', 'marca', 'oferta', 'detallesProducto'])
        ->where('es_oferta', 1)
        ->limit(10)
            ->get();

        // Si no hemos alcanzado los 10 productos, completar con productos que no están en oferta
        if ($productosEnOferta->count() < 10) {
            $restoProductos = Producto::with(['categoria', 'marca', 'oferta', 'detallesProducto'])
            ->where('es_oferta', 0)
            ->limit(10 - $productosEnOferta->count())
                ->get();

            // Combinar los productos en oferta con los productos no en oferta
            $productosEnOferta = $productosEnOferta->merge($restoProductos);
        }

        // Añadir la URL completa de la imagen a cada producto
        foreach ($productosEnOferta as $producto) {
            $producto->image = Storage::url($producto->image);
        }

        // Retornar los 10 productos como máximo, priorizando los que están en oferta
        return response()->json( $productosEnOferta);
    }



}
