<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $fillable = ['id', 'ref','nombre','categoria_id','horamaquina','revision','fecha'];

    public function articulos(){
        return $this->belongsToMany('App\Articulo');

        
    }
    public function archivo(){
        return $this->hasOne('App\Archivo','id', 'id');
    }

   
}
