<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItensMesa extends Model
{
    protected $table = 'Itens_mesa';
    protected $primaryKey = 'idItensMesa';
    protected $fillable = ['idMesa', 'Quantidade', 'Total_soma', 'idProduto'];
    public $timestamps = true;

    public function produto()
    {
        return $this->belongsTo('App\Produto', 'idProduto');
    }


}
