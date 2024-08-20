<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        // Inserción de datos predeterminados
        $categorias = [
            ['nombre' => 'Laptops'],
            ['nombre' => 'TVS'],
            ['nombre' => 'Accesorios'],
            ['nombre' => 'Impresoras'],
            ['nombre' => 'Celulares'],
            ['nombre' => 'Tablet'],
        ];

        foreach ($categorias as $categoria) {
            DB::table('categorias')->insert(array_merge($categoria, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
}
