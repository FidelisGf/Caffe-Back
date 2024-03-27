<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItensPedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Itens_pedidos', function (Blueprint $table) {
            $table->id('idItensPedidos');
            $table->integer('idPedido');
            $table->integer('idProduto');
            $table->integer('Quantidade');
            $table->double('Total_soma');
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
        //
    }
}
