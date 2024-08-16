<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function index()
    {
        // Redirige a la ruta 'Productos'
        return Redirect::route('Productos');
    }
}
