<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function index()
    {
        return Carousel::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image',
            'link' => 'nullable|string|max:255',
        ]);

        // Guardar la imagen en el almacenamiento
        $imagePath = $request->file('image')->store('carousels', 'public');

        $carousel = Carousel::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'link' => $request->link,
        ]);

        return response()->json($carousel, 201);
    }

    public function show($id)
    {
        return Carousel::findOrFail($id);
    }


}
