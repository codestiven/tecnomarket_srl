<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10, 2);
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('marca_id');
            $table->string('image')->nullable();
            $table->integer('stock')->default(1);
            $table->boolean('es_oferta')->default(false);
            $table->timestamps();

            // Claves foráneas
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('marca_id')->references('id')->on('marcas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
