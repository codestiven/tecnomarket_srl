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
        'nuevo_precio',
    ];

    // No hay relaciones en este ejemplo
}