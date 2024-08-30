<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llama a los seeders que quieres ejecutar
        $this->call([
            // CategoriasSeeder::class,
            // MarcasSeeder::class,
            ProductosSeeder::class,
            DetallesProductosSeeder::class,
            CarouselSeeder::class,
            PedidoCarritoSeeder::class,
        ]);

        // Crear un usuario de prueba
        User::factory()->create([
            'name' => 'Stiven',
            'lastname' => 'De la rosa',
            'email' => 'codestiven@gmail.com',
            'password' => Hash::make('password123'),
            'address' => 'Some Address', // Correct column name
            'province_id' => 13,
            'phone' => '8296536510',
        ]);

    }
}