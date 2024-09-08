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

        $productos = Producto::orderBy('created_at', 'desc')->get();


        foreach ($productos as $producto) {
            $producto->image = Storage::url($producto->image);
        }


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


    public function create(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255|unique:productos,nombre',
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

            // Establecer valor predeterminado para es_oferta
            $esOferta = $request->has('es_oferta') ? (bool)$request->es_oferta : false;

            // Crear producto en base de datos
            $producto = Producto::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'categoria_id' => $request->categoria_id,
                'marca_id' => $request->marca_id,
                'image' => $imagenPath,
                'es_oferta' => $esOferta,
            ]);

            // Crear oferta si es_oferta es verdadero
            if ($esOferta) {
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









    public function show($nombre)
    {
        // Reemplazar los guiones por espacios para hacer coincidir con el nombre en la base de datos
        $nombre = str_replace('-', ' ', $nombre);

        // Buscar el producto por su nombre
        $producto = Producto::with(['categoria', 'marca', 'oferta', 'detallesProducto'])
        ->where('nombre', $nombre)
            ->firstOrFail();

        // Obtener la URL de la imagen del producto
        $producto->image = Storage::url($producto->image);

        // Enviar tanto el producto como sus detalles a la vista
        return Inertia::render('Productos/producto', [
            'producto' => $producto,
            'detallesProducto' => $producto->detallesProducto
        ]);
    }




  
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


        $productos = Producto::with(['categoria', 'marca', 'oferta', 'detallesProducto']);


        if ($categoria_id !== null) {
            $productos->where('categoria_id', $categoria_id);
        }


        if ($marca_id !== null) {
            $productos->where('marca_id', $marca_id);
        }


        if ($en_oferta !== null) {
            if ($en_oferta === 'solo_ofertas') {
                $productos->where('es_oferta', 1);
            } elseif ($en_oferta === 'sin_ofertas') {
                $productos->where('es_oferta', 0);
            }
        }


        $productos->orderBy('created_at', 'desc');


        $productos = $productos->paginate(30);


        foreach ($productos as $producto) {
            $producto->image = Storage::url($producto->image);
        }


        return response()->json($productos);
    }

    public function redirigirPorCategoria($slugCategoria)
    {
        // Buscar la categoría por su nombre (o slug)
        $categoria = Categoria::where('nombre', $slugCategoria)->first();

        // Si la categoría existe, redirigir a la página de productos con el filtro de la categoría
        if ($categoria) {
            return redirect()->route('Productos', [
                'categoria_id' => $categoria->id,
                'en_oferta' => '',
                'marca_id' => ''
            ]);
        }

        // Si no se encuentra la categoría, buscar la marca por su nombre
        $marca = Marca::where('nombre', $slugCategoria)->first();

        // Si la marca existe, redirigir a la página de productos con el filtro de la marca
        if ($marca) {
            return redirect()->route('Productos', [
                'categoria_id' => '',
                'en_oferta' => '',
                'marca_id' => $marca->id
            ]);
        }

        // Si no se encuentra ni la categoría ni la marca, redirigir a la página de productos sin filtros
        return redirect()->route('Productos')->with('error', 'No se encontró ninguna categoría o marca con ese nombre.');
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
            'ids.*' => 'integer',
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
