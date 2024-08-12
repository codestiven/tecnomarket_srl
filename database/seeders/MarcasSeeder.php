<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Marca;

class MarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */    public function run()
    {
        // Marcas aleatorias de laptops
        $marcas = [
            'Apple',
            'Dell',
            'HP',
            'Lenovo',
            'Acer',
            'Asus',
            'Microsoft',
            'Samsung',
            'MSI',
            'Razer',
            'Alienware',
        ];

        // Preparar los datos para la inserción
        $data = [];
        foreach ($marcas as $marca) {
            $data[] = [
                'nombre' => $marca,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insertar datos en la tabla 'categorias' usando SQL
        Marca::insert($data);
    }
}