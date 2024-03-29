<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Produto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Produto', function (Blueprint $table) {
            $table->id('idProduto');
            $table->string('Nome_produto');
            $table->double('Preco_compra');
            $table->double('Preco_venda');
            $table->double('Preco_lojista');
            $table->string('Descricao');
            $table->integer('idCategoria');
            $table->binary('Imagem')->nullable();
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
