<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; use App\Paradas; use App\Calculo; use App\Produccion; use App\Maquina;
use Session; use DateTime;

class ControlController extends Controller
{
    public function index($id)
    {
        $produccion = Produccion::orderBy("fecha_inicio","desc")->first();
    	$maquinasgraficas = DB::table("maquina")->select('idmaquina','maquina.nombre',DB::raw('count(parada_maquinas.idparada) AS totalparadas'),DB::raw('TIMESTAMPDIFF(SECOND, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin) as minutos'))
        ->join("parada_maquinas","parada_maquinas.id_maquina","=","maquina.idmaquina")
        ->where("parada_maquinas.id_produccion","=", $produccion->idproduccion)
        ->groupBy("maquina.idmaquina")->take(7)->get();


        $maquinas = DB::table('maquina')->pluck("nombre","idmaquina");
    	
        $recetas = DB::table('receta')->where("linea", "=", $id)->pluck("nombre","idReceta");
        
        
    	$parada = DB::table('parada_maquinas')->select('parada_maquinas.idparada','parada_maquinas.fecha_inicio','parada_maquinas.fecha_fin','parada_maquinas.comentario','parada_maquinas.id_maquina','parada_maquinas.id_causa','parada_maquinas.id_produccion','parada_maquinas.id_linea',DB::raw('SEC_TO_TIME(TIMESTAMPDIFF(SECOND, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin)) as minutos'), DB::raw('MOD(TIMESTAMPDIFF(second, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin),3600) as segundos'), DB::raw('UNIX_TIMESTAMP() as FechaActual'), DB::raw('UNIX_TIMESTAMP(parada_maquinas.fecha_inicio) as fecha_inicio_reloj'))
            ->join('produccion','produccion.idproduccion','=','parada_maquinas.id_produccion')
            ->where("parada_maquinas.maq_principal", "=", "1")
            ->where("produccion.finalizado", "=", "0")
            ->where("parada_maquinas.id_linea", "=", $id)
            ->where("parada_maquinas.id_produccion","=", $produccion->idproduccion)
            ->orderBy('parada_maquinas.fecha_inicio','desc')->get();
        
       // $idproduccion = $produccion->idproduccion;

        //dd($idproduccion);
        $graficas = DB::table('calculo_oee')->where("produccion","=",$produccion->idproduccion)->first();
        
        
        $total_paradas = DB::table('parada_maquinas')->select(DB::raw('count(idparada) as TotalParadas'))
        ->where("id_produccion","=",$produccion->idproduccion)
        ->where("maq_principal","=","1")->get();
        //$suma_paradas = DB::table('calculo_oee')->select(DB::raw('SEC_TO_TIME(SUM(sumanet + sumatrue)) as SumaParadas'))->where("produccion","=",$produccion->idproduccion)->get();

        $suma_paradas = DB::table('parada_maquinas')->select(DB::raw("SEC_TO_TIME(SUM(MOD(TIMESTAMPDIFF(second, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin),3600))) as SumaParadas"))->where("id_produccion","=",$produccion->idproduccion)->whereNotNull('fecha_fin')->get();


        $paradaupdated_at_ = Paradas::where("maq_principal", "=", "1")->orderBy('updated_at_','desc')->first();
    	$causas = DB::table('causas')->where("idmaquina", "=", "1")->pluck("nombre","idcausa");

        $datos = ['Maquinas' => $maquinas,'MaquinasGraficas' => $maquinasgraficas, 'Paradas' => $parada, 'Causas' => $causas, 'fecha_bd' => $paradaupdated_at_->updated_at_,'Graficas' => $graficas, 'Recetas' => $recetas, 'TotalParadas' => $total_paradas, 'SumaParadas' => $suma_paradas, 'ProduccionFechaInicio' => $produccion->fecha_inicio, 'Produccion' => $produccion->idproduccion, 'OEE' => $produccion->contador,  'id_linea' => $id
        ];

        return view('control.index',compact('datos'));
    
    }
     public function ajaxCausa(Request $request,$id)
        {
            
            $causas = DB::table("causas")
                        ->where('idmaquina',$id)
                        ->pluck("nombre","idcausa","idmaquina");
            $this->updatemaquina($request->id_maquina, $request->idparada);
                 
            return json_encode($causas);
        }
    public function updatemaquina($idmaquina,$id)
    {
 
   $timestamp = DB::table('parada_maquinas')->select('updated_at_')
        ->where("idparada","=",$id)->first();
        
        $parada= DB::table('parada_maquinas')
            ->where('idparada', $id)
            ->update([
                'id_maquina' => $idmaquina
                 
                
                ]);
            

        return json_encode($id);
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
        
       
        $parada = Paradas::select('parada_maquinas.idparada','parada_maquinas.fecha_inicio','parada_maquinas.fecha_fin','parada_maquinas.comentario','parada_maquinas.id_maquina','parada_maquinas.id_causa','parada_maquinas.id_produccion','parada_maquinas.id_linea','parada_maquinas.updated_at_', DB::raw('UNIX_TIMESTAMP(fecha_inicio) as FechaInicioReloj'),DB::raw('SEC_TO_TIME(TIMESTAMPDIFF(SECOND, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin)) as minutos'), DB::raw('MOD(TIMESTAMPDIFF(second, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin),3600) as segundos'))->where("maq_principal", "=", "1")
            ->where("id_produccion", "=", $request->idproduccion)
            ->orderBy('updated_at_','desc')->first();


        $produccion = Produccion::orderBy("fecha_inicio","desc")->where("idproduccion", "=", $request->idproduccion)->first();

            if (!empty($parada))
            {
               $fecha_ac = strtotime($parada->updated_at_); 
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
        $total_paradas = DB::table('parada_maquinas')->select(DB::raw('count(idparada) as TotalParadas'))
        ->where("id_produccion","=",$request->idproduccion)
        ->where("maq_principal","=","1")->first();
      //  $suma_paradas = DB::table('calculo_oee')->select(DB::raw('SEC_TO_TIME(SUM(sumanet + sumatrue)) as SumaParadas'))->where("produccion","=",$request->idproduccion)->first();
        $suma_paradas = DB::table('parada_maquinas')->select(DB::raw("SEC_TO_TIME(SUM(MOD(TIMESTAMPDIFF(second, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin),3600))) as SumaParadas"))->where("id_produccion","=",$request->idproduccion)->whereNotNull('fecha_fin')->first();
        if($fecha_bd<$fecha_ac)
        {    
            if($parada->fecha_fin==null)
            {
                $fecha = DB::table('parada_maquinas')->select( DB::raw('UNIX_TIMESTAMP() as FechaActual'))
                        ->orderBy('updated_at_','desc')->first();
                $causas = DB::table("causas")
                        ->pluck("nombre","idcausa");
        
                $maquinas = DB::table("maquina")
                        ->pluck("nombre","idmaquina");

                $paradaupdated_at_ = Paradas::where("maq_principal", "=", "1")->orderBy('updated_at_','desc')->first();
                $causas = DB::table('causas')->where("idmaquina", "=", "1")->pluck("nombre","idcausa");
                $estatus = "nuevo";

                

            }else
            {
                $fecha = DB::table('parada_maquinas')->select( DB::raw('UNIX_TIMESTAMP() as FechaActual'))
                        ->orderBy('updated_at_','desc')->first();
                $causas = DB::table("causas")
                        ->pluck("nombre","idcausa");
        
                $maquinas = DB::table("maquina")
                        ->pluck("nombre","idmaquina");

                $paradaupdated_at_ = Paradas::where("maq_principal", "=", "1")->orderBy('updated_at_','desc')->first();
                $causas = DB::table('causas')->where("idmaquina", "=", "1")->pluck("nombre","idcausa");
                $estatus = "actualizar";

            } 
            $graficas = DB::table('calculo_oee')->where("produccion","=",$request->idproduccion)->first();
            
            
            return response()->json(array('updated_at_' => strtotime($parada->updated_at_), 'fecha_inicio' => $parada->fecha_inicio, 'fecha_inicio_reloj' => $parada->FechaInicioReloj, 'fecha_fin' => $parada->fecha_fin, 'id_maquina' => $parada->id_maquina, 'id_causa' => $parada->id_causa, 'id' => $parada->idparada, 'comentario' => $parada->comentario, 'fecha_actual' => $fecha->FechaActual, 'causas' => $causas, 'maquinas' => $maquinas ,'ultimo' => $request->ultimo, 'estatus' => $estatus, 'parada' => $parada,'minutos' => $parada->minutos, 'segundos' => $parada->segundos, 'Disponibilidad' => $graficas->oeeDISPONIBILIDAD, 'Rendimiento' => $graficas->oeeRENDIMIENTO, 'oeeCALIDAD' => $graficas->oeeCALIDAD, 'OEE' => $graficas->OEE, 'totalparada' => $total_paradas->TotalParadas, 'SumaParadas' => $suma_paradas->SumaParadas,'cantidadnominalpiezas' => $produccion->contador, 'rechazomermas' => $graficas->rechazomermas ), 200);     
               
        }else{
            $graficas = DB::table('calculo_oee')->where("produccion","=",$request->idproduccion)->first();
            return response()->json(array('updated_at_' => $request->timestamp, 'fecha_inicio' => $fecha_inicio, 'fecha_fin' => $fecha_fin, 'id_maquina' => $id_maquina, 'id_causa' => $id_causa, 'id' => $id, 'comentario' => $comentario, 'Disponibilidad' => $graficas->oeeDISPONIBILIDAD, 'Rendimiento' => $graficas->oeeRENDIMIENTO, 'oeeCALIDAD' => $graficas->oeeCALIDAD, 'OEE' => $graficas->OEE, 'totalparada' => $total_paradas->TotalParadas, 'SumaParadas' => $suma_paradas->SumaParadas,'cantidadnominalpiezas' => $produccion->contador, 'rechazomermas' => $graficas->rechazomermas   ), 200); 

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

            $parada = DB::table('parada_maquinas')->select('parada_maquinas.idparada','parada_maquinas.fecha_inicio','parada_maquinas.fecha_fin','parada_maquinas.comentario','parada_maquinas.id_maquina','parada_maquinas.id_causa','parada_maquinas.id_produccion','parada_maquinas.id_linea','parada_maquinas.updated_at_',DB::raw('SEC_TO_TIME(TIMESTAMPDIFF(SECOND, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin)) as minutos'), DB::raw('MOD(TIMESTAMPDIFF(second, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin),3600) as segundos'), DB::raw('UNIX_TIMESTAMP() as FechaActual'))
        ->where("maq_principal", "=", "1")->where("parada_maquinas.id_produccion","=", $idproduccion)->where("parada_maquinas.id_linea", "=", $request->id_linea)->orderBy('updated_at_','desc')->get();
        
            $fecha = DB::table('parada_maquinas')->select( DB::raw('UNIX_TIMESTAMP() as FechaActual'))
        ->orderBy('updated_at_','desc')->first();
        $causas = DB::table("causas")
                        ->pluck("nombre","idcausa");
        
        $maquinas = DB::table("maquina")
                        ->pluck("nombre","idmaquina");

        $graficas = DB::table('calculo_oee')->where("produccion","=",$idproduccion)->first();

        $total_paradas = DB::table('parada_maquinas')->select(DB::raw('count(idparada) as TotalParadas'))
        ->where("id_produccion","=",$idproduccion)
        ->where("maq_principal","=","1")->first();

        if (!empty($total_paradas))
        {
            $NumTotalParada = $total_paradas;
        }else
        {
            $NumTotalParada = 0;
        }
       // $suma_paradas = DB::table('calculo_oee')->select(DB::raw('SEC_TO_TIME(SUM(sumanet + sumatrue)) as SumaParadas'))->where("produccion","=",$idproduccion)->first();

        $suma_paradas = DB::table('parada_maquinas')->select(DB::raw("SEC_TO_TIME(SUM(MOD(TIMESTAMPDIFF(second, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin),3600))) as SumaParadas"))->where("id_produccion","=",$idproduccion)->whereNotNull('fecha_fin')->first();


      
        $paradaupdated_at_ = Paradas::where("maq_principal", "=", "1")->orderBy('updated_at_','desc')->first();
        $datos = ['Maquinas' => $maquinas, 'Paradas' => $parada, 'Causas' => $causas];

            return response()->json(array('datos' => $datos,'produccion' => $produccion->idproduccion, 'Paradas' => $parada, 'updated_at_' => strtotime($paradaupdated_at_->updated_at_), 'Disponibilidad' => $graficas->oeeDISPONIBILIDAD, 'Rendimiento' => $graficas->oeeRENDIMIENTO, 'oeeCALIDAD' => $graficas->oeeCALIDAD, 'OEE' => $graficas->OEE, 'cantidadnominalpiezas' => $produccion->contador, 'rechazomermas' => $graficas->rechazomermas, 'totalparada' => $total_paradas->TotalParadas, 'SumaParadas' => $suma_paradas->SumaParadas, 'ProduccionFechaInicio' => $produccion->fecha_inicio  ), 200);    

        }else{
            return response()->json(array('produccion' => null   ), 200); 

        } 


    }
}
