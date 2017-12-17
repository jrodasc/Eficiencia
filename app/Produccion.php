<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produccion extends Model
{
    protected $table = 'produccion';
    protected $fillable = ['id', 'contador','fecha_inicio','fecha_fin', 'finalizado','observacion', 'id_receta', 'produccion_planificada','id_linea','updated_at'];
}
