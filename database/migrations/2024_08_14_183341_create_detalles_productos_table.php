<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesProductosTable extends Migration
{
    public function up()
    {
        Schema::create('detalles_productos', function (Blueprint $table) {
            $table->unsignedBigInteger('producto_id')->primary(); // Llave primaria que referencia a producto
            $table->string('color')->nullable();
            $table->decimal('peso', 8, 2)->nullable();
            $table->string('pantalla')->nullable();
            $table->string('sistema_operativo')->nullable();
            $table->string('procesador')->nullable();
            $table->integer('ram')->nullable();
            $table->integer('almacenamiento')->nullable(); // Nuevo campo de almacenamiento
            $table->enum('tipo_de_almacenamiento', ['SSD', 'HDD'])->nullable(); // Campo tipo_de_almacenamiento con valores 'HDD' y 'SSD'
            $table->integer('consumo_energetico')->nullable();
            $table->string('tarjeta_grafica')->nullable();

            // Relación con la tabla productos con cascada de eliminación
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalles_productos');
    }
}
