<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade'); // Conexión con productos
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Conexión con usuarios
            $table->foreignId('carrito_id')->nullable()->constrained('carritos')->onDelete('cascade'); // Conexión opcional con carritos
            $table->enum('estado', ['en proceso', 'terminado', 'cancelado']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
