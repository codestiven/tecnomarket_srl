<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// Asegúrate de importar tu modelo Carousel

class CarouselController extends Controller
{
    public function index()
    {
        // Obtener todos los elementos del carrusel
        $carousels = Carousel::all();

        // Iterar sobre cada elemento para agregar la URL completa de la imagen
        foreach ($carousels as $carousel) {
            if ($carousel->image) {
                // Generar la URL completa usando el disco público
                $carousel->image = Storage::url($carousel->image);
            }
        }

        return response()->json($carousels);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|url',
            'image' => 'nullable|image',
        ]);

        $path = $request->file('image')->store('images', 'public');

        $carousel = Carousel::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'link' => $validated['link'],
            'image' => $path,
        ]);

        return response()->json($carousel, 201);
    }

    public function show($id)
    {
        return Carousel::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $carousel = Carousel::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|url',
            'image' => 'nullable|image', // Permite cualquier tipo de imagen sin restricciones de formato ni tamaño
        ]);


        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $carousel->image = $path;
        }

        $carousel->title = $validated['title'];
        $carousel->description = $validated['description'];
        $carousel->link = $validated['link'];
        $carousel->save();

        return response()->json($carousel, 200);
    }

    public function destroy($id)
    {
        $carousel = Carousel::findOrFail($id);
        $carousel->delete();

        return response()->json(null, 204);
    }
}
