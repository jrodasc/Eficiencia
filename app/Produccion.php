<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produccion extends Model
{
    protected $table = 'produccion';
    protected $fillable = ['idproduccion', 'contador','fecha_inicio','fecha_fin', 'finalizado','observacion', 'id_receta', 'produccion_planificada','id_linea','updated_at'];

    public function receta()
    {
        return $this->hasOne('App\Receta', 'idReceta', 'id_receta');
    }
    public function calculo()
    {
        return $this->hasOne('App\Calculo', 'produccion', 'idproduccion');

    }
}
