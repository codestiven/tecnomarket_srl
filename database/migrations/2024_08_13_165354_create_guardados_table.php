<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuardadosTable extends Migration
{
    public function up()
    {
        Schema::create('guardados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('producto_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['user_id', 'producto_id']); // Asegura que un producto solo pueda ser guardado una vez por un usuario
        });
    }

    public function down()
    {
        Schema::dropIfExists('guardados');
    }
}
