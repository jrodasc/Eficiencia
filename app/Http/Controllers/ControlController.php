<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; use App\Paradas; use App\Calculo; use App\Produccion;
use Session; use DateTime;

class ControlController extends Controller
{
    public function index($id)
    {
    	$maquinas = DB::table('maquina')->pluck("nombre","idmaquina");

    	
        $recetas = DB::table('receta')->where("linea", "=", $id)->pluck("nombre","idReceta");
        $produccion = Produccion::orderBy("fecha_inicio","desc")->first();
        
    	$parada = DB::table('parada_maquinas')->select('parada_maquinas.idparada','parada_maquinas.fecha_inicio','parada_maquinas.fecha_fin','parada_maquinas.comentario','parada_maquinas.id_maquina','parada_maquinas.id_causa','parada_maquinas.id_produccion','parada_maquinas.id_linea',DB::raw('SEC_TO_TIME(TIMESTAMPDIFF(SECOND, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin)) as minutos'), DB::raw('MOD(TIMESTAMPDIFF(second, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin),3600) as segundos'), DB::raw('UNIX_TIMESTAMP() as FechaActual'), DB::raw('UNIX_TIMESTAMP(parada_maquinas.fecha_inicio) as fecha_inicio_reloj'))
            ->join('produccion','produccion.idproduccion','=','parada_maquinas.id_produccion')
            ->where("parada_maquinas.maq_principal", "=", "1")
            ->where("produccion.finalizado", "=", "0")
            ->where("parada_maquinas.id_linea", "=", $id)
            ->where("parada_maquinas.id_produccion","=", $produccion->idproduccion)
            ->orderBy('parada_maquinas.updated_at','desc')->get();
        
       // $idproduccion = $produccion->idproduccion;

        //dd($idproduccion);
        $graficas = DB::table('calculo_oee')->where("produccion","=",$produccion->idproduccion)->first();
        
        
        $total_paradas = DB::table('parada_maquinas')->select(DB::raw('count(idparada) as TotalParadas'))
        ->where("id_produccion","=",$produccion->idproduccion)
        ->where("maq_principal","=","1")->get();
        $suma_paradas = DB::table('calculo_oee')->select(DB::raw('SEC_TO_TIME(SUM(sumanet + sumatrue)) as SumaParadas'))->where("produccion","=",$produccion->idproduccion)->get();

        $paradaupdated_at = Paradas::where("maq_principal", "=", "1")->orderBy('updated_at','desc')->first();
    	$causas = DB::table('causas')->where("idmaquina", "=", "1")->pluck("nombre","idcausa");

        $datos = ['Maquinas' => $maquinas, 'Paradas' => $parada, 'Causas' => $causas, 'fecha_bd' => $paradaupdated_at->updated_at,'Graficas' => $graficas, 'Recetas' => $recetas, 'TotalParadas' => $total_paradas, 'SumaParadas' => $suma_paradas, 'ProduccionFechaInicio' => $produccion->fecha_inicio, 'Produccion' => $produccion->idproduccion, 'OEE' => $produccion->contador,  'id_linea' => $id
        ];

        return view('control.index',compact('datos'));
    
    }
     public function ajaxCausa($id)
        {

            $causas = DB::table("causas")
                        ->where('idmaquina',$id)
                        ->pluck("nombre","idcausa");

                     
            return json_encode($causas);
        }

   
    public function ajaxReceta(Request $request, $id)
    {
        
         $actualizacion=DB::table('receta')
            ->where('linea', $request->id_linea)
            ->update(['activa' => 0]);
        
        $receta= DB::table('receta')
            ->where('idReceta', $id)
            ->update(['activa' => 1]);
        $produccion= DB::table('produccion')
            ->where('idproduccion', $request->id_produccion)
            ->update(['id_receta' => $id]);


        return response()->json($actualizacion);
    }
    public function update(Request $request, $id)
    {
 $input = $request->all();
    	//$parada = Paradas::where('idparada','=',$id)->first();
        /*$parada =  DB::table('parada_maquinas')->select('comentario','id_maquina','id_causa')->where('idparada','=',$id)->first();
    	       

        //dd($parada->id_produccion);
      //  dd($request->id_maquina);
        $parada->comentario = $input['comentario'];
        $parada->id_maquina = $input['id_maquina'];
        $parada->id_causa = $input['id_causa'];

    	$parada->update();  */
        $parada= DB::table('parada_maquinas')
            ->where('idparada', $id)
            ->update([
                'comentario' => $input['comentario'],
                'id_maquina' => $input['id_maquina'],
                'id_causa' => $input['id_causa']]);

    	return response()->json($parada);
    }
    public function httpush(Request $request)
    {   set_time_limit(0); 
        //dd($request->timestamp);
        $fecha_ac = isset($request->timestamp) ? $request->timestamp:0;
        //$fecha_bd = isset($request->fecha_bd) ? $request->fecha_bd:0;

        $fecha_bd = $request->fecha_bd;
        
       
        $parada = Paradas::select('parada_maquinas.idparada','parada_maquinas.fecha_inicio','parada_maquinas.fecha_fin','parada_maquinas.comentario','parada_maquinas.id_maquina','parada_maquinas.id_causa','parada_maquinas.id_produccion','parada_maquinas.id_linea','parada_maquinas.updated_at', DB::raw('UNIX_TIMESTAMP(fecha_inicio) as FechaInicioReloj'),DB::raw('SEC_TO_TIME(TIMESTAMPDIFF(MINUTE, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin)) as minutos'), DB::raw('MOD(TIMESTAMPDIFF(second, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin),3600) as segundos'))->where("maq_principal", "=", "1")
            ->where("id_produccion", "=", $request->idproduccion)
            ->orderBy('updated_at','desc')->first();


        $produccion = Produccion::orderBy("fecha_inicio","desc")->where("idproduccion", "=", $request->idproduccion)->first();

            if (!empty($parada))
            {
               $fecha_ac = strtotime($parada->updated_at); 
               $fecha_inicio = $parada->fecha_inicio;
                $fecha_fin = $parada->fecha_fin;
                $id_maquina = $parada->id_maquina;
                $id_causa = $parada->id_causa;
                $comentario = $parada->comentario;
                $id = $parada->id;
           }else
           {
                $fecha_ac = 0;
                $fecha_inicio = 0;
                $fecha_fin = 0;
                $id_maquina = 0;
                $id_causa = 0;
                $comentario = 0;
                $id = 0;

                 

           }
        
        if($fecha_bd<$fecha_ac)
        {    
            if($parada->fecha_fin==null)
            {
                $fecha = DB::table('parada_maquinas')->select( DB::raw('UNIX_TIMESTAMP() as FechaActual'))
                        ->orderBy('updated_at','desc')->first();
                $causas = DB::table("causas")
                        ->pluck("nombre","idcausa");
        
                $maquinas = DB::table("maquina")
                        ->pluck("nombre","idmaquina");

                $paradaupdated_at = Paradas::where("maq_principal", "=", "1")->orderBy('updated_at','desc')->first();
                $causas = DB::table('causas')->where("idmaquina", "=", "1")->pluck("nombre","idcausa");
                $estatus = "nuevo";

                

            }else
            {
                $fecha = DB::table('parada_maquinas')->select( DB::raw('UNIX_TIMESTAMP() as FechaActual'))
                        ->orderBy('updated_at','desc')->first();
                $causas = DB::table("causas")
                        ->pluck("nombre","idcausa");
        
                $maquinas = DB::table("maquina")
                        ->pluck("nombre","idmaquina");

                $paradaupdated_at = Paradas::where("maq_principal", "=", "1")->orderBy('updated_at','desc')->first();
                $causas = DB::table('causas')->where("idmaquina", "=", "1")->pluck("nombre","idcausa");
                $estatus = "actualizar";

            } 
            $graficas = DB::table('calculo_oee')->where("produccion","=",$request->idproduccion)->first();
            
            
            return response()->json(array('updated_at' => strtotime($parada->updated_at), 'fecha_inicio' => $parada->fecha_inicio, 'fecha_inicio_reloj' => $parada->FechaInicioReloj, 'fecha_fin' => $parada->fecha_fin, 'id_maquina' => $parada->id_maquina, 'id_causa' => $parada->id_causa, 'id' => $parada->idparada, 'comentario' => $parada->comentario, 'fecha_actual' => $fecha->FechaActual, 'causas' => $causas, 'maquinas' => $maquinas ,'ultimo' => $request->ultimo, 'estatus' => $estatus, 'parada' => $parada,'minutos' => $parada->minutos, 'segundos' => $parada->segundos, 'Disponibilidad' => $graficas->oeeDISPONIBILIDAD, 'Rendimiento' => $graficas->rendimiento, 'oeeCALIDAD' => $graficas->oeeCALIDAD, 'OEE' => $produccion->contador, 'cantidadnominalpiezas' => $graficas->cantidadnominalpiezas, 'rechazomermas' => $graficas->rechazomermas ), 200);     
               
        }else{
            return response()->json(array('updated_at' => $request->timestamp, 'fecha_inicio' => $fecha_inicio, 'fecha_fin' => $fecha_fin, 'id_maquina' => $id_maquina, 'id_causa' => $id_causa, 'id' => $id, 'comentario' => $comentario   ), 200); 

        } 
            }


    
    public function httpushproduccion(Request $request)
    {   set_time_limit(0); 
        //dd($request->timestamp);
       
        $fecha_ac = isset($request->timestamp) ? $request->timestamp:0;
        //$fecha_bd = isset($request->fecha_bd) ? $request->fecha_bd:0;

        $fecha_bd = $request->fecha_bd;
        
       // while( $fecha_bd <= $fecha_ac )
       // { 
        $produccion = Produccion::select("idproduccion","fecha_inicio","contador")->where("id_linea", "=", $request->id_linea)->orderBy('fecha_inicio','desc')->first();

        if (!empty($produccion))
            {

                $idproduccion = $produccion->idproduccion;
            }else
            {
                $idproduccion = $request->id_produccion;
            }
        if($idproduccion!=$request->id_produccion)
        {    

            $parada = DB::table('parada_maquinas')->select('parada_maquinas.idparada','parada_maquinas.fecha_inicio','parada_maquinas.fecha_fin','parada_maquinas.comentario','parada_maquinas.id_maquina','parada_maquinas.id_causa','parada_maquinas.id_produccion','parada_maquinas.id_linea','parada_maquinas.updated_at',DB::raw('SEC_TO_TIME(TIMESTAMPDIFF(MINUTE, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin)) as minutos'), DB::raw('MOD(TIMESTAMPDIFF(second, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin),3600) as segundos'), DB::raw('UNIX_TIMESTAMP() as FechaActual'))
        ->where("maq_principal", "=", "1")->where("parada_maquinas.id_produccion","=", $idproduccion)->where("parada_maquinas.id_linea", "=", $request->id_linea)->orderBy('updated_at','desc')->get();
        
            $fecha = DB::table('parada_maquinas')->select( DB::raw('UNIX_TIMESTAMP() as FechaActual'))
        ->orderBy('updated_at','desc')->first();
        $causas = DB::table("causas")
                        ->pluck("nombre","idcausa");
        
        $maquinas = DB::table("maquina")
                        ->pluck("nombre","idmaquina");

        $graficas = DB::table('calculo_oee')->where("produccion","=",$idproduccion)->first();

        $total_paradas = DB::table('parada_maquinas')->select(DB::raw('count(idparada) as TotalParadas'))
        ->where("id_produccion","=",$idproduccion)
        ->where("maq_principal","=","1")->get();
        if (!empty($total_paradas))
        {
            $NumTotalParada = $total_paradas;
        }else
        {
            $NumTotalParada = 0;
        }
        $suma_paradas = DB::table('calculo_oee')->select(DB::raw('SEC_TO_TIME(SUM(sumanet + sumatrue)) as SumaParadas'))->where("produccion","=",$idproduccion)->get();

         if (!empty($suma_paradas))
        {
            $SumParada = $suma_paradas;
        }else
        {
            $SumParada = 0;
        }

        $paradaupdated_at = Paradas::where("maq_principal", "=", "1")->orderBy('updated_at','desc')->first();
        $datos = ['Maquinas' => $maquinas, 'Paradas' => $parada, 'Causas' => $causas];

            return response()->json(array('datos' => $datos,'produccion' => $produccion->idproduccion,'Paradas' => $parada, 'updated_at' => strtotime($paradaupdated_at->updated_at), 'Disponibilidad' => $graficas->oeeDISPONIBILIDAD, 'Rendimiento' => $graficas->rendimiento, 'oeeCALIDAD' => $graficas->oeeCALIDAD, 'OEE' => $produccion->contador, 'cantidadnominalpiezas' => $graficas->cantidadnominalpiezas, 'rechazomermas' => $graficas->rechazomermas, 'totalparada' => $NumTotalParada, 'SumaParadas' => $SumParada, 'ProduccionFechaInicio' => $produccion->fecha_inicio  ), 200);        
        }else{
            return response()->json(array('produccion' => null   ), 200); 

        } 


    }
}
