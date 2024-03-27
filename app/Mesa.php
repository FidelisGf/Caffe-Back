<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    protected $table = 'mesas';
    protected $primaryKey = 'idMesa';
    protected $fillable = ['Status_mesa', 'Preco_total', 'Numero_mesa', 'Tipo_pagamento', 'Fechada'];
    public $timestamps = true;


    public function itensMesa()
    {
        return $this->hasMany('App\ItensMesa', 'idMesa', 'idMesa');
    }

   
}
