<?php

// app/Http/Controllers/ProvinciaController.php

namespace App\Http\Controllers;

use App\Models\Provincia;
use Illuminate\Http\Request;

class ProvinciaController extends Controller
{
    public function index()
    {
        $provincias = Provincia::all();
        return response()->json($provincias);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $provincia = Provincia::create($request->all());
        return response()->json($provincia, 201);
    }

    public function show($id)
    {
        $provincia = Provincia::findOrFail($id);
        return response()->json($provincia);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $provincia = Provincia::findOrFail($id);
        $provincia->update($request->all());
        return response()->json($provincia);
    }

    public function destroy($id)
    {
        Provincia::destroy($id);
        return response()->json(null, 204);
    }
}
