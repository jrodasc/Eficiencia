<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $table = 'receta';
    protected $fillable = ['idReceta', 'codigo_ref','nombre','velocidad', 'volumen','formato', 'descripcion', 'linea','activa'];

    public function produccion()
    {
        return $this->hasOne('App\Receta', 'idReceta', 'id_receta');
    }
}

