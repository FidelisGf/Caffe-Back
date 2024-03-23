<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table = 'Categorias';
    protected $primaryKey = 'idCategoria';
    protected $fillable = ['Nome_categoria', 'Descricao'];
    public $timestamps = true;

    public function produtos()
    {
        return $this->hasMany('App\Produto', 'idCategoria');
    }
}
