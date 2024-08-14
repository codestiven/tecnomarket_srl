<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetallesProductosSeeder extends Seeder
{
    public function run()
    {
        DB::table('detalles_productos')->insert([
            [
                'producto_id' => 1, // ID de MacBook Pro 16
                'color' => 'Plata',
                'peso' => 2.0, // Cambiado a decimal
                'pantalla' => '16 pulgadas',
                'sistema_operativo' => 'macOS',
                'procesador' => 'Intel Core i9',
                'ram' => 32, // Cambiado a integer
                'tarjeta_grafica' => 'AMD Radeon Pro 5500M',
                'consumo_energetico' => 100, // Cambiado a integer
            ],
            [
                'producto_id' => 2, // ID de Dell XPS 13
                'color' => 'Negro',
                'peso' => 1.2, // Cambiado a decimal
                'pantalla' => '13.3 pulgadas',
                'sistema_operativo' => 'Windows 10',
                'procesador' => 'Intel Core i7',
                'ram' => 16, // Cambiado a integer
                'tarjeta_grafica' => 'Intel Iris Plus',
                'consumo_energetico' => 65, // Cambiado a integer
            ],
            [
                'producto_id' => 3, // ID de HP Spectre x360
                'color' => 'Dorado',
                'peso' => 1.3, // Cambiado a decimal
                'pantalla' => '13.3 pulgadas táctil',
                'sistema_operativo' => 'Windows 10',
                'procesador' => 'Intel Core i7',
                'ram' => 16, // Cambiado a integer
                'tarjeta_grafica' => 'Intel Iris Plus',
                'consumo_energetico' => 65, // Cambiado a integer
            ],
            [
                'producto_id' => 4, // ID de Lenovo ThinkPad X1 Carbon
                'color' => 'Negro',
                'peso' => 1.1, // Cambiado a decimal
                'pantalla' => '14 pulgadas',
                'sistema_operativo' => 'Windows 10',
                'procesador' => 'Intel Core i7',
                'ram' => 16, // Cambiado a integer
                'tarjeta_grafica' => 'Intel UHD Graphics',
                'consumo_energetico' => 50, // Cambiado a integer
            ],
            [
                'producto_id' => 5, // ID de Acer Aspire 5
                'color' => 'Plata',
                'peso' => 1.8, // Cambiado a decimal
                'pantalla' => '15.6 pulgadas',
                'sistema_operativo' => 'Windows 10',
                'procesador' => 'AMD Ryzen 5',
                'ram' => 8, // Cambiado a integer
                'tarjeta_grafica' => 'NVIDIA GeForce MX350',
                'consumo_energetico' => 70, // Cambiado a integer
            ],
            [
                'producto_id' => 6, // ID de Asus ROG Zephyrus
                'color' => 'Negro',
                'peso' => 2.2, // Cambiado a decimal
                'pantalla' => '15.6 pulgadas',
                'sistema_operativo' => 'Windows 10',
                'procesador' => 'Intel Core i7',
                'ram' => 16, // Cambiado a integer
                'tarjeta_grafica' => 'NVIDIA GeForce GTX 1660 Ti',
                'consumo_energetico' => 120, // Cambiado a integer
            ],
            [
                'producto_id' => 7, // ID de Microsoft Surface Laptop 4
                'color' => 'Platino',
                'peso' => 1.3, // Cambiado a decimal
                'pantalla' => '13.5 pulgadas táctil',
                'sistema_operativo' => 'Windows 10',
                'procesador' => 'AMD Ryzen 7',
                'ram' => 16, // Cambiado a integer
                'tarjeta_grafica' => 'Radeon Vega 9',
                'consumo_energetico' => 65, // Cambiado a integer
            ],
            [
                'producto_id' => 8, // ID de Samsung QLED TV 55"
                'color' => 'Negro',
                'peso' => 17.5, // Cambiado a decimal
                'pantalla' => '55 pulgadas',
                'sistema_operativo' => 'Tizen OS',
                'procesador' => 'Quantum Processor 4K',
                'ram' => 2, // Cambiado a integer
                'tarjeta_grafica' => 'Mali-G71',
                'consumo_energetico' => 110, // Cambiado a integer
            ],
            [
                'producto_id' => 9, // ID de LG OLED TV 65"
                'color' => 'Negro',
                'peso' => 25, // Cambiado a decimal
                'pantalla' => '65 pulgadas',
                'sistema_operativo' => 'webOS',
                'procesador' => 'Alpha 9 Gen 3 AI Processor 4K',
                'ram' => 4, // Cambiado a integer
                'tarjeta_grafica' => 'Mali-G52',
                'consumo_energetico' => 140, // Cambiado a integer
            ],
            [
                'producto_id' => 10, // ID de Razer BlackWidow
                'color' => 'Negro',
                'peso' => 1.2, // Cambiado a decimal
                'pantalla' => null,
                'sistema_operativo' => null,
                'procesador' => null,
                'ram' => null,
                'tarjeta_grafica' => null,
                'consumo_energetico' => 5, // Cambiado a integer
            ],
            [
                'producto_id' => 11, // ID de Alienware Gaming Mouse
                'color' => 'Negro',
                'peso' => 0.2, // Cambiado a decimal
                'pantalla' => null,
                'sistema_operativo' => null,
                'procesador' => null,
                'ram' => null,
                'tarjeta_grafica' => null,
                'consumo_energetico' => 3, // Cambiado a integer
            ],
            [
                'producto_id' => 12, // ID de Samsung Wind-Free AC 1.5 Ton
                'color' => 'Blanco',
                'peso' => 15, // Cambiado a decimal
                'pantalla' => null,
                'sistema_operativo' => null,
                'procesador' => null,
                'ram' => null,
                'tarjeta_grafica' => null,
                'consumo_energetico' => 150, // Cambiado a integer
            ],
            [
                'producto_id' => 13, // ID de LG Dual Inverter AC 1 Ton
                'color' => 'Blanco',
                'peso' => 12, // Cambiado a decimal
                'pantalla' => null,
                'sistema_operativo' => null,
                'procesador' => null,
                'ram' => null,
                'tarjeta_grafica' => null,
                'consumo_energetico' => 130, // Cambiado a integer
            ],
            [
                'producto_id' => 14, // ID de MSI Optix Curved Monitor
                'color' => 'Negro',
                'peso' => 6.5, // Cambiado a decimal
                'pantalla' => '27 pulgadas curvo',
                'sistema_operativo' => null,
                'procesador' => null,
                'ram' => null,
                'tarjeta_grafica' => null,
                'consumo_energetico' => 45, // Cambiado a integer
            ],
            [
                'producto_id' => 15, // ID de Acer Predator Monitor
                'color' => 'Negro',
                'peso' => 8, // Cambiado a decimal
                'pantalla' => '32 pulgadas',
                'sistema_operativo' => null,
                'procesador' => null,
                'ram' => null,
                'tarjeta_grafica' => null,
                'consumo_energetico' => 50, // Cambiado a integer
            ],
        ]);
    }
}
