<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EntradaProduto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Entrada_produto', function (Blueprint $table) {
            $table->id('idEntrada_Produto');
            $table->string('Fornecedor');
            $table->date('Data');
            $table->integer('Quantidade');
            $table->date('Validade');
            $table->string('Informacoes_adicionais');
            $table->integer('idProduto');
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
