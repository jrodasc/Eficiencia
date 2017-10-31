<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $fillable = ['nota_id', 'filename'];
 
    public function nota()
    {
        return $this->belongsTo('App\Nota');
    }
}
