<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $fillable = ['id', 'ref','nombre','categoria_id','horamaquina','revision'];

    public function articulos(){
        return $this->belongsToMany('App\Articulo');

        
    }
}
