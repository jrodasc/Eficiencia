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
    
}
