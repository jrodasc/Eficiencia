<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paradas extends Model
{
    protected $table = 'parada_maquinas';
    protected $fillable = ['idparada', 'fecha_inicio','fecha_fin','comentario', 'id_maquina','id_causa', 'id_produccion', 'id_linea'];
    protected $primary_key = 'idparada';

  
}
