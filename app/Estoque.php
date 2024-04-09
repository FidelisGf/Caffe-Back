<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $fillable = ['idProduto', 'quantidade', 'data'];
    protected $table = 'estoque';
    protected $primaryKey = 'idEstoque';
    public $timestamps = true;
    protected $guarded = [];


    public function produto()
    {
        return $this->hasOne('App\Produto', 'idProduto', 'idProduto');
    }
}
