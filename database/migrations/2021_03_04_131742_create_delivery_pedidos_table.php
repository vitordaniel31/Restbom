<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_delivery');
            $table->foreign('id_delivery')->references('id')->on('delivery'); 
            $table->unsignedBigInteger('id_pedido')->unique();
            $table->foreign('id_pedido')->references('id')->on('pedidos'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_pedidos');
    }
}
