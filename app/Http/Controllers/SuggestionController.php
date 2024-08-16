<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('query', '');
        $suggestions = Producto::where('nombre', 'like', "%{$query}%")
            ->select('nombre as value')
            ->get();
        return response()->json(['suggestions' => $suggestions]);
    }
}
