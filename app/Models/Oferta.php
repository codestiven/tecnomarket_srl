<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    protected $fillable = ['producto_id', 'precio_oferta'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
