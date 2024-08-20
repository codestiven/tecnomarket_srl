<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('productos')->insert([
            [
                'nombre' => 'MacBook Pro 16',
                'descripcion' => 'Laptop de alto rendimiento para profesionales.',
                'precio' => 2500.00,
                'categoria_id' => 1, // Laptops
                'marca_id' => 1, // Apple
                'image' => 'https://ssl-product-images.www8-hp.com/digmedialib/prodimg/lowres/c08523987.png',
                'stock' => rand(10, 100), // Stock aleatorio
                'es_oferta' => false,
            ],
            [
                'nombre' => 'Dell XPS 13',
                'descripcion' => 'Laptop ultradelgada con pantalla infinita.',
                'precio' => 1500.00,
                'categoria_id' => 1, // Laptops
                'marca_id' => 2, // Dell
                'image' => 'https://ssl-product-images.www8-hp.com/digmedialib/prodimg/lowres/c08523987.png',
                'stock' => rand(10, 100), // Stock aleatorio
                'es_oferta' => false,
            ],
            [
                'nombre' => 'HP Spectre x360',
                'descripcion' => 'Laptop convertible con pantalla táctil.',
                'precio' => 1400.00,
                'categoria_id' => 1, // Laptops
                'marca_id' => 3, // HP
                'image' => 'https://ssl-product-images.www8-hp.com/digmedialib/prodimg/lowres/c08523987.png',
                'stock' => rand(10, 100), // Stock aleatorio
                'es_oferta' => false,
            ],
            [
                'nombre' => 'Lenovo ThinkPad X1 Carbon',
                'descripcion' => 'Laptop empresarial con diseño duradero.',
                'precio' => 1700.00,
                'categoria_id' => 1, // Laptops
                'marca_id' => 4, // Lenovo
                'image' => 'https://ssl-product-images.www8-hp.com/digmedialib/prodimg/lowres/c08523987.png',
                'stock' => rand(10, 100), // Stock aleatorio
                'es_oferta' => false,
            ],
            [
                'nombre' => 'Acer Aspire 5',
                'descripcion' => 'Laptop asequible con buen rendimiento.',
                'precio' => 600.00,
                'categoria_id' => 1, // Laptops
                'marca_id' => 5, // Acer
                'image' => 'https://ssl-product-images.www8-hp.com/digmedialib/prodimg/lowres/c08523987.png',
                'stock' => rand(10, 100), // Stock aleatorio
                'es_oferta' => false,
            ],
            [
                'nombre' => 'Asus ROG Zephyrus',
                'descripcion' => 'Laptop gamer ultradelgada y potente.',
                'precio' => 1800.00,
                'categoria_id' => 1, // Laptops
                'marca_id' => 6, // Asus
                'image' => 'https://ssl-product-images.www8-hp.com/digmedialib/prodimg/lowres/c08523987.png',
                'stock' => rand(10, 100), // Stock aleatorio
                'es_oferta' => false,
            ],
            [
                'nombre' => 'Microsoft Surface Laptop 4',
                'descripcion' => 'Laptop con pantalla táctil y diseño elegante.',
                'precio' => 1300.00,
                'categoria_id' => 1, // Laptops
                'marca_id' => 7, // Microsoft
                'image' => 'https://ssl-product-images.www8-hp.com/digmedialib/prodimg/lowres/c08523987.png',
                'stock' => rand(10, 100), // Stock aleatorio
                'es_oferta' => false,
            ],
            [
                'nombre' => 'Samsung QLED TV 55"',
                'descripcion' => 'Televisor 4K UHD con tecnología QLED.',
                'precio' => 1000.00,
                'categoria_id' => 2, // TVS
                'marca_id' => 8, // Samsung
                'image' => 'https://ssl-product-images.www8-hp.com/digmedialib/prodimg/lowres/c08523987.png',
                'stock' => rand(10, 100), // Stock aleatorio
                'es_oferta' => false,
            ],
            [
                'nombre' => 'LG OLED TV 65"',
                'descripcion' => 'Televisor 4K con negros profundos y colores vibrantes.',
                'precio' => 2000.00,
                'categoria_id' => 2, // TVS
                'marca_id' => 9, // LG
                'image' => 'https://ssl-product-images.www8-hp.com/digmedialib/prodimg/lowres/c08523987.png',
                'stock' => rand(10, 100), // Stock aleatorio
                'es_oferta' => false,
            ],
            [
                'nombre' => 'Razer BlackWidow',
                'descripcion' => 'Teclado mecánico para gaming con retroiluminación.',
                'precio' => 120.00,
                'categoria_id' => 3, // Accesorios
                'marca_id' => 10, // Razer
                'image' => 'https://ssl-product-images.www8-hp.com/digmedialib/prodimg/lowres/c08523987.png',
                'stock' => rand(10, 100), // Stock aleatorio
                'es_oferta' => false,
            ],
            [
                'nombre' => 'Alienware Gaming Mouse',
                'descripcion' => 'Ratón de gaming con alta precisión.',
                'precio' => 80.00,
                'categoria_id' => 3, // Accesorios
                'marca_id' => 11, // Alienware
                'image' => 'https://ssl-product-images.www8-hp.com/digmedialib/prodimg/lowres/c08523987.png',
                'stock' => rand(10, 100), // Stock aleatorio
                'es_oferta' => false,
            ],
            [
                'nombre' => 'Samsung Wind-Free AC 1.5 Ton',
                'descripcion' => 'Aire acondicionado con tecnología Wind-Free.',
                'precio' => 500.00,
                'categoria_id' => 4, // Aire acondicionado
                'marca_id' => 8, // Samsung
                'image' => 'https://ssl-product-images.www8-hp.com/digmedialib/prodimg/lowres/c08523987.png',
                'stock' => rand(10, 100), // Stock aleatorio
                'es_oferta' => false,
            ],
            [
                'nombre' => 'LG Dual Inverter AC 1 Ton',
                'descripcion' => 'Aire acondicionado con bajo consumo de energía.',
                'precio' => 450.00,
                'categoria_id' => 4, // Aire acondicionado
                'marca_id' => 9, // LG
                'image' => 'https://ssl-product-images.www8-hp.com/digmedialib/prodimg/lowres/c08523987.png',
                'stock' => rand(10, 100), // Stock aleatorio
                'es_oferta' => false,
            ],
            [
                'nombre' => 'MSI Optix Curved Monitor',
                'descripcion' => 'Monitor curvo para gaming con alta tasa de refresco.',
                'precio' => 300.00,
                'categoria_id' => 2, // TVS
                'marca_id' => 9, // MSI
                'image' => 'https://ssl-product-images.www8-hp.com/digmedialib/prodimg/lowres/c08523987.png',
                'stock' => rand(10, 100), // Stock aleatorio
                'es_oferta' => false,
            ],
            [
                'nombre' => 'Acer Predator Monitor',
                'descripcion' => 'Monitor de gaming con resolución 4K.',
                'precio' => 400.00,
                'categoria_id' => 2, // TVS
                'marca_id' => 5, // Acer
                'image' => 'https://ssl-product-images.www8-hp.com/digmedialib/prodimg/lowres/c08523987.png',
                'stock' => rand(10, 100), // Stock aleatorio
                'es_oferta' => false,
            ],
        ]);
    }
}
