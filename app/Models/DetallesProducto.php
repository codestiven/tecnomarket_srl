<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesProducto extends Model
{
    use HasFactory;

    protected $table = 'detalles_productos';

    public $timestamps = false; // No hay timestamps en esta tabla

    protected $fillable = [
        'producto_id',
        'color',
        'peso',
        'pantalla',
        'sistema_operativo',
        'procesador',
        'ram',
        'almacenamiento',
        'tipo_de_almacenamiento',
        'tarjeta_grafica',
        'consumo_energetico',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
