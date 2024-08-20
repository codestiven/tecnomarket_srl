<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Oferta; // Asegúrate de importar correctamente la clase Oferta

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
        'image',
        'stock',
        'es_oferta',  // Añadimos es_oferta a los fillable
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
        return $this->hasOne(Oferta::class, 'producto_id');
    }

    // Relación con la tabla DetallesProducto
    public function detallesProducto()
    {
        return $this->hasOne(DetallesProducto::class, 'producto_id');
    }
}
