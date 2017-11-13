<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $fillable = ['id', 'ref','nombre'];

     public function archivo(){
        return $this->hasOne('App\Archivo','id', 'id');
    }
    
}
