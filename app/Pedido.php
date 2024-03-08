<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'idPedido';
    protected $fillable = ['idMesa', 'Data', 'Valor_total', 'Forma_pagamento', 'Obs'];


    public function mesa()
    {
        return $this->belongsTo('App\Mesa', 'idMesa', 'idMesa');
    }
}
