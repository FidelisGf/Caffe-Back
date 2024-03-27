<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'idPedido';
    protected $fillable = ['idMesa', 'Data', 'Valor_total', 'Forma_pagamento', 'Obs'];


    public $formasdePagamento = [
        0 => 'Dinheiro',
        1 => 'Cartão de Crédito',
        2 => 'Cartão de Débito',
        3 => 'Pix',
    ];


    public function mesa()
    {
        return $this->belongsTo('App\Mesa', 'idMesa', 'idMesa');
    }


    public function itensPedidos()
    {
        return $this->hasMany('App\Itens_pedidos', 'idPedido', 'idPedido');
    }
}
