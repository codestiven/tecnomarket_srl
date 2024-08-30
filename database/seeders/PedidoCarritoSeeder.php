<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carrito;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\User;

class PedidoCarritoSeeder extends Seeder
{
    public function run()
    {
        // Obtiene el usuario con id 1
        $user = User::find(1);

        if ($user) {
            // Crea un carrito para el usuario
            $carrito = Carrito::create(['user_id' => $user->id]);

            // Crea algunos productos
            $productos = Producto::factory(3)->create();

            // Crea pedidos para los productos y los asocia al carrito
            foreach ($productos as $producto) {
                Pedido::create([
                    'producto_id' => $producto->id,
                    'user_id' => $user->id,
                    'carrito_id' => $carrito->id,
                    'estado' => 'en proceso',
                ]);
            }
        } else {
            echo "Usuario con ID 1 no encontrado. Asegúrate de que el usuario existe en la base de datos.";
        }
    }
}
