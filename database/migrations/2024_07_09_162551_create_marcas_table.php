<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('marcas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        // Inserción de datos predeterminados
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

        foreach ($marcas as $marca) {
            DB::table('marcas')->insert([
                'nombre' => $marca,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marcas');
    }
};
