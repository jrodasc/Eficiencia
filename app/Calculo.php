<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calculo extends Model
{
    protected $table = 'calculo_oee';
    protected $fillable = ['idoee', 'produccion','sumanet','sumatrue', 'TPO','TO', 'tiempocicloideal', 'cantidadnominapiezas', 'rendimiento', 'conformescalidad', 'rechazomermas', 'oeeDISPONIBILIDAD', 'oeeRENDIMIENTO', 'oeeCALIDAD', 'OOE'];
}
