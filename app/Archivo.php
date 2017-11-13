<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $fillable = ['nota_id', 'filename','nombre'];
 
    public function nota()
    {
        return $this->hasOne('App\Nota', 'id', 'nota_id');
    }
    
    public function articulo()
    {
        return $this->hasOne('App\articulo', 'id', 'articulo_id');
    }
}
