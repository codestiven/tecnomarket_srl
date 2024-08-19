<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Carousel;
use Illuminate\Support\Str;

class CarouselSeeder extends Seeder
{
    public function run()
    {
        // Definir imágenes de ejemplo y sus datos
        $items = [
            [
                'title' => 'Laptop para Desarrollo Web',
                'description' => 'Una laptop perfecta para programadores, equipada con lo último en hardware y software.',
                'image' => 'image.png', // Primera imagen
                'link' => '/laptops/web-development'
            ],
            [
                'title' => 'Laptop para Marketing Digital',
                'description' => 'Optimizada para manejar campañas de marketing digital con alta eficiencia.',
                'image' => 'images.jpg', // Segunda imagen
                'link' => '/laptops/digital-marketing'
            ],
        ];

        foreach ($items as $item) {
            // Construir la ruta correcta para las imágenes
            $imageFilePath = base_path('database/seeders/images/' . $item['image']);

            // Verificar si el archivo existe
            if (file_exists($imageFilePath)) {
                // Copiar la imagen al storage y obtener la ruta
                $imagePath = 'carousels/' . Str::random(10) . '_' . $item['image'];
                Storage::disk('public')->put($imagePath, file_get_contents($imageFilePath));

                // Crear el registro en la base de datos
                Carousel::create([
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'image' => $imagePath,
                    'link' => $item['link'],
                ]);
            } else {
                echo "Archivo no encontrado: " . $imageFilePath . "\n";
            }
        }
    }
}
