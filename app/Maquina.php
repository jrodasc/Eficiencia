<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maquina extends Model
{
    protected $table = 'maquina';
    protected $fillable = ['idmaquina', 'nombre','net','id_linea'];

    public function paradas()
    {
        return $this->hasOne('App\Paradas', 'idmaquina', 'id_maquina');
    }
}
