<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definir los datos que quieres insertar
        $categorias = [
            ['nombre' => 'Laptops'],
            ['nombre' => 'TVS'],
            ['nombre' => 'Accesorios'],
            ['nombre' => 'Impresoras'],
            ['nombre' => 'Celulares'],
            ['nombre' => 'Tablet'],
        ];

        // Insertar los datos en la tabla 'categorias'
        Categoria::insert($categorias);
    }
}