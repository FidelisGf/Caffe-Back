<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'Produto';
    protected $primaryKey = 'idProduto';
    protected $fillable = ['Nome_produto', 'Preco_compra', 'Preco_venda', 'Descricao'];
    public $timestamps = true;

    public function entradaProduto()
    {
        return $this->hasOne('App\EntradaProduto', 'idProduto', 'idProduto');
    }
    
    public function itensMesa()
    {
        return $this->belongsToMany('App\ItensMesa', 'idProduto', 'idProduto');
    }
}
