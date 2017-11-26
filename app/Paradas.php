<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paradas extends Model
{
    protected $table = 'parada_maquinas';
    protected $fillable = ['id', 'fecha_inicio','fecha_fin','comentario', 'id_maquina','id_causa', 'id_produccion', 'id_linea'];
}
