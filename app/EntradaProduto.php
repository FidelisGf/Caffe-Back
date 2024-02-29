<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntradaProduto extends Model
{

    protected $table = 'entrada_produto';
    protected $primaryKey = 'idEntrada_Produto';
    protected $fillable = ['idProduto', 'Quantidade', 'Preco', 'Data', 'Validade', 'Informacoes_adicionais'];
    public $timestamps = true;

    public function produto()
    {
        return $this->belongsTo('App\Produto', 'idProduto', 'idProduto');
    }
}
