<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produccion;
use DB; use App\Paradas; use App\Calculo;  use App\Maquina;
use Session; use DateTime;
class ProduccionesController extends Controller
{
    public function index(Request $request)
    {
        $produccion = Produccion::select('produccion.idproduccion','produccion.contador','produccion.fecha_inicio','produccion.fecha_fin','finalizado','produccion.observacion','produccion.id_receta','produccion.id_linea')
        ->orderBy('produccion.fecha_inicio','desc')->get();
        //'calculo_oee.OEE','calculo_oee.rendimiento','calculo_oee.oeeDISPONIBILIDAD','calculo_oee.oeeCALIDAD'
        $total = count($produccion);
       
        $datos=['Producciones' => $produccion,'Total' => $total];

        return view('producciones.index', compact('datos'));
    }

    public function informe($id)
    { 
    	$produccion = Produccion::orderBy("fecha_inicio","desc")->where("produccion.idproduccion","=",$id)->first();
        $maquinasgraficas = $this->LabelsGraficas($id);
        

        $maquinas = DB::table('maquina')->pluck("nombre","idmaquina");
        
        $recetas = DB::table('receta')->where("linea", "=", $id)->pluck("nombre","idReceta");
        
        
        $parada = Paradas::select('parada_maquinas.idparada','parada_maquinas.fecha_inicio','parada_maquinas.fecha_fin','parada_maquinas.comentario','parada_maquinas.id_maquina','parada_maquinas.id_causa','parada_maquinas.id_produccion','parada_maquinas.id_linea',DB::raw('SEC_TO_TIME(TIMESTAMPDIFF(SECOND, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin)) as minutos'), DB::raw('MOD(TIMESTAMPDIFF(second, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin),3600) as segundos'), DB::raw('UNIX_TIMESTAMP() as FechaActual'), DB::raw('UNIX_TIMESTAMP(parada_maquinas.fecha_inicio) as fecha_inicio_reloj'))
            ->join('produccion','produccion.idproduccion','=','parada_maquinas.id_produccion')
            ->where("parada_maquinas.maq_principal", "=", "1")
            ->where("parada_maquinas.id_produccion","=", $id)
            ->orderBy('parada_maquinas.fecha_inicio','desc')->get();
     
        $graficas = DB::table('calculo_oee')->where("produccion","=",$produccion->idproduccion)->first();
        
        
        $total_paradas = DB::table('parada_maquinas')->select(DB::raw('count(idparada) as TotalParadas'))
        ->where("id_produccion","=",$produccion->idproduccion)
        ->where("maq_principal","=","1")->get();
     
        $suma_paradas = DB::table('parada_maquinas')->select(DB::raw("SEC_TO_TIME(SUM(MOD(TIMESTAMPDIFF(second, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin),3600))) as SumaParadas"))->where("id_produccion","=",$produccion->idproduccion)->whereNotNull('fecha_fin')->get();


        $paradaupdated_at_ = Paradas::where("maq_principal", "=", "1")->orderBy('updated_at_','desc')->first();
        $causas = DB::table('causas')->where("idmaquina", "=", "1")->pluck("nombre","idcausa");

        $datos = ['Maquinas' => $maquinas,'MaquinasGraficas' => $maquinasgraficas, 'Paradas' => $parada, 'Causas' => $causas, 'fecha_bd' => $paradaupdated_at_->updated_at_,'Graficas' => $graficas, 'Recetas' => $recetas, 'TotalParadas' => $total_paradas, 'SumaParadas' => $suma_paradas, 'ProduccionFechaInicio' => $produccion->fecha_inicio, 'Produccion' => $produccion->idproduccion, 'OEE' => $produccion->contador,  'id_linea' => $id
        ];
    	return view('producciones.informedia',compact('datos'));
    }
    public function LabelsGraficas($IdProduccion)
    {
        $maquinasgraficas = DB::table("maquina")->select('idmaquina','maquina.nombre',DB::raw('count(parada_maquinas.idparada) AS totalparadas'),DB::raw('TIMESTAMPDIFF(SECOND, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin) as minutos'))
        ->join("parada_maquinas","parada_maquinas.id_maquina","=","maquina.idmaquina")
        ->where("parada_maquinas.id_produccion","=", $IdProduccion)
        ->orderBy("minutos","desc")
        ->groupBy("maquina.idmaquina")->take(7)->get();
        
        
        
        return ($maquinasgraficas->toJson());
    }
}
