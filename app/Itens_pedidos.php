<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itens_pedidos extends Model
{

    protected $table = 'Itens_pedidos';
    protected $primaryKey = 'idItensPedidos';
    protected $fillable = ['idPedido', 'idProduto', 'Quantidade', 'Total_soma'];
    public $timestamps = true;


    public function pedido()
    {
        return $this->belongsTo('App\Pedido', 'idPedido', 'idPedido');
    }
}
