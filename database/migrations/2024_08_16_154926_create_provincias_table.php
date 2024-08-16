<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_provincias_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateProvinciasTable extends Migration
{
    public function up()
    {
        Schema::create('provincias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        // Insertar las provincias y el Distrito Nacional
        $provincias = [
            'Distrito Nacional',
            'Azua',
            'Baoruco',
            'Barahona',
            'Dajabón',
            'Distrito Nacional',
            'Duarte',
            'El Seibo',
            'Elías Piña',
            'Elias Piña',
            'Espaillat',
            'Hato Mayor',
            'La Altagracia',
            'La Romana',
            'La Vega',
            'María Trinidad Sánchez',
            'Monseñor Nouel',
            'Monte Cristi',
            'Monte Plata',
            'Pedernales',
            'Peravia',
            'Puerto Plata',
            'Samaná',
            'San Cristóbal',
            'San José de Ocoa',
            'San Juan',
            'San Pedro de Macorís',
            'Sánchez Ramírez',
            'Santiago',
            'Santiago Rodríguez',
            'Valverde',
        ];

        foreach ($provincias as $provincia) {
            DB::table('provincias')->insert([
                'nombre' => $provincia,
            ]);
        }
    }

    public function down()
    {
        Schema::dropIfExists('provincias');
    }
}
