<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'categoria_id',
        'marca_id',
        'oferta_id',
        'image',
        'stock',
    ];

    // Relación con la tabla Categorias
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    // Relación con la tabla Marcas
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    // Relación con la tabla Ofertas
    public function oferta()
    {
        return $this->belongsTo(Oferta::class, 'oferta_id');
    }

    // Relación con la tabla DetallesProducto
    public function detallesProducto()
    {
        return $this->hasOne(DetallesProducto::class, 'producto_id');
    }
}

