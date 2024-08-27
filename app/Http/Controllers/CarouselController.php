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
        return Carousel::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|url',
            'image' => 'required|image|max:2048',
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
            'link' => 'nullable|url','image' => 'nullable|image|max:10240', // Permite cualquier imagen de hasta 10 MB
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
