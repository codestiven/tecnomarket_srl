<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use HasFactory;

    protected $table = 'ofertas';

    protected $fillable = [
        'nombre',
        'descuento',
        'fecha_inicio',
        'fecha_final',
        'precio_anterior',
    ];

    // No hay relaciones en este ejemplo
}