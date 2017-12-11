<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Linea extends Model
{
    protected $table = 'linea';
    protected $fillable = ['idlinea', 'nombre','puesto','id_planta', 'tiempo_parada','eficiencia_objetiva'];
}
