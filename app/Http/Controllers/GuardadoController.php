<?php

namespace App\Http\Controllers;

use App\Models\Guardado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class GuardadoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
        ]);

        $user = Auth::user(); // Obtiene el usuario autenticado
        $producto_id = $request->input('producto_id');

        // Verifica si el producto ya está guardado por el usuario
        $guardado = Guardado::where('user_id', $user->id)
            ->where('producto_id', $producto_id)
            ->first();

        if ($guardado) {
            return response()->json(['message' => 'Producto ya guardado'], 400);
        }

        Guardado::create([
            'user_id' => $user->id,
            'producto_id' => $producto_id,
        ]);

        return response()->json([
            'success' => true,
        ]);
    }

    public function destroy($producto_id)
    {
        $user = Auth::user();

        $guardado = Guardado::where('user_id', $user->id)
            ->where('producto_id', $producto_id)
            ->first();

        if (!$guardado) {
            return response()->json(['message' => 'No se encontró el producto guardado'], 404);
        }

        $guardado->delete();

        return response()->json(['message' => 'Producto eliminado de guardados'], 200);
    }





    public function index(Request $request)
    {
        $user = Auth::user();

        // Verifica si el usuario está autenticado
        if (!$user) {
            return redirect()->route('login'); // Redirige al login si no está autenticado
        }

        // Obtener el término de búsqueda del request
        $buscar = $request->input('buscar', '');

        // Obtener todos los productos guardados por el usuario autenticado
        $guardados = Guardado::with(['producto.categoria', 'producto.marca', 'producto.oferta'])
        ->where('user_id', $user->id)
            ->get();

        // Filtrar los productos guardados según el término de búsqueda
        $resultados = $guardados->filter(function ($guardado) use ($buscar) {
            $producto = $guardado->producto;
            return stripos($producto->nombre, $buscar) !== false || stripos($producto->descripcion, $buscar) !== false;
        });

        // Modificar las URLs de las imágenes para usar el almacenamiento
        foreach ($resultados as $guardado) {
            if ($guardado->producto->image) {
                $guardado->producto->image = Storage::url($guardado->producto->image);
            }
        }

        // Pasar los datos a Inertia
        return Inertia::render('Guardados', [
            'guardados' => $resultados
        ]);
    }

    public function indexjson()
    {
        $user = Auth::user();

        // Verifica si el usuario está autenticado
        if (!$user) {
            return redirect()->route('login'); // Redirige al login si no está autenticado
        }

        // Obtener todos los productos guardados por el usuario autenticado
        $guardados = Guardado::with('producto')
        ->where('user_id', $user->id)
            ->get();

        // Verifica si el usuario no tiene productos guardados
        if ($guardados->isEmpty()) {
            // Puedes decidir si quieres manejar esto de alguna manera en la vista
        }

        // Modificar las URLs de las imágenes para usar el almacenamiento
        foreach ($guardados as $guardado) {
            if ($guardado->producto->image) {
                $guardado->producto->image = Storage::url($guardado->producto->image);
            }
        }

        // Pasar los datos a Inertia
        return response()->json($guardados);
    }

    public function showLikes($producto_id)
    {
        // Verifica si el producto existe
        $producto = Producto::find($producto_id);
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        // Cuenta la cantidad de usuarios que han guardado el producto
        $likesCount = Guardado::where('producto_id', $producto_id)->count();

        // Devuelve la cantidad en formato JSON
        return response()->json(['likes_count' => $likesCount]);
    }


    public function getGuardadosCount()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Si el usuario no está autenticado
        if (!$user) {
            return response()->json(['message' => 'Usuario no autenticado'], 401);
        }

        // Contar la cantidad de elementos guardados por el usuario
        $guardadosCount = Guardado::where('user_id', $user->id)->count();

        // Devuelve la cantidad en formato JSON
        return response()->json(['guardados_count' => $guardadosCount]);
    }

    public function getGuardados()
    {
        $guardados = Guardado::select('producto_id', DB::raw('count(distinct user_id) as cantidad'))
            ->groupBy('producto_id')
            ->orderBy('cantidad', 'desc')
            ->get();

        $productos = $guardados->map(function ($guardado) {
            $producto = Producto::with(['categoria', 'marca', 'oferta'])->find($guardado->producto_id);
            return [
                'producto' => $producto ? $producto : null,
                'cantidad' => $guardado->cantidad,
            ];
        });

        return response()->json($productos);
    }

}
