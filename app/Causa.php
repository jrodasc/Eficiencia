<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Causa extends Model
{
    protected $table = 'causas';
    protected $fillable = ['idcausa', 'nombre','idmaquina'];

    public function paradas()
    {
        return $this->hasOne('App\Paradas', 'idcausa', 'id_causa');
    }
}
