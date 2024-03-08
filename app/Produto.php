<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'Produto';
    protected $primaryKey = 'idProduto';
    protected $fillable = ['Nome_produto', 'Preco_compra', 'Preco_venda', 'Descricao', 'Imagem'];
    public $timestamps = true;

    public function entradaProduto()
    {
        return $this->hasMany('App\EntradaProduto', 'idProduto', 'idProduto');
    }

    public function itensMesa()
    {
        return $this->belongsToMany('App\ItensMesa', 'idProduto', 'idProduto');
    }

    public function setImagemAttribute($value)
    {
        $this->attributes['Imagem'] = json_encode($value);
    }

    public function getImagemAttribute($value)
    {
        return json_decode($value, true);
    }
}
