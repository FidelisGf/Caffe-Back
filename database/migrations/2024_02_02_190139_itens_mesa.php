<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItensMesa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Itens_mesa', function (Blueprint $table) {
            $table->id('idItensMesa');
            $table->integer('idProduto');
            $table->integer('idMesa');
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
