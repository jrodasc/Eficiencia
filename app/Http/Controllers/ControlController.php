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
        
    	$parada = DB::table('parada_maquinas')->select('parada_maquinas.idparada','parada_maquinas.fecha_inicio','parada_maquinas.fecha_fin','parada_maquinas.comentario','parada_maquinas.id_maquina','parada_maquinas.id_causa','parada_maquinas.id_produccion','parada_maquinas.id_linea',DB::raw('TIMESTAMPDIFF(MINUTE, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin) as minutos'), DB::raw('MOD(TIMESTAMPDIFF(second, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin),3600) as segundos'), DB::raw('UNIX_TIMESTAMP() as FechaActual'))
            ->join('produccion','produccion.idproduccion','=','parada_maquinas.id_produccion')
            ->where("parada_maquinas.maq_principal", "=", "1")
            ->where("produccion.finalizado", "=", "0")
            ->where("parada_maquinas.id_linea", "=", $id)
            ->where("parada_maquinas.id_produccion","=", $produccion->idproduccion)
            ->orderBy('parada_maquinas.updated_at','desc')->get();
        
        
        $graficas = DB::table('calculo_oee')->where("produccion","=",$parada[0]->id_produccion)->first();

        $total_paradas = DB::table('parada_maquinas')->select(DB::raw('count(idparada) as TotalParadas'))->where("id_produccion","=",$parada[0]->id_produccion)->get();
        $suma_paradas = DB::table('calculo_oee')->select(DB::raw('MINUTE(SEC_TO_TIME(SUM(sumanet + sumatrue)*60)) as SumaParadas'))->where("produccion","=",$parada[0]->id_produccion)->get();

        $paradaupdated_at = Paradas::where("maq_principal", "=", "1")->orderBy('updated_at','desc')->first();
    	$causas = DB::table('causas')->where("idmaquina", "=", "1")->pluck("nombre","idcausa");

        $datos = ['Maquinas' => $maquinas, 'Paradas' => $parada, 'Causas' => $causas, 'fecha_bd' => $paradaupdated_at->updated_at,'Graficas' => $graficas, 'Recetas' => $recetas, 'TotalParadas' => $total_paradas, 'SumaParadas' => $suma_paradas, 'ProduccionFechaInicio' => $produccion->fecha_inicio
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
        
       // while( $fecha_bd <= $fecha_ac )
       // { 
        $parada = Paradas::where("maq_principal", "=", "1")->orderBy('updated_at','desc')->first();
        $fecha_ac = strtotime($parada->updated_at);
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
            return response()->json(array('updated_at' => strtotime($parada->updated_at), 'fecha_inicio' => $parada->fecha_inicio, 'fecha_inicio_reloj' => strtotime($parada->fecha_inicio), 'fecha_fin' => $parada->fecha_fin, 'id_maquina' => $parada->id_maquina, 'id_causa' => $parada->id_causa, 'id' => $parada->idparada, 'comentario' => $parada->comentario, 'fecha_actual' => $fecha->FechaActual, 'causas' => $causas, 'maquinas' => $maquinas ,'ultimo' => $request->ultimo, 'estatus' => $estatus, 'parada' => $parada ), 200);     
               
        }else{
            return response()->json(array('updated_at' => $request->timestamp, 'fecha_inicio' => $parada->fecha_inicio, 'fecha_fin' => $parada->fecha_fin, 'id_maquina' => $parada->id_maquina, 'id_causa' => $parada->id_causa, 'id' => $parada->id, 'comentario' => $parada->comentario   ), 200); 

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
        $produccion = Produccion::where("id_linea", "=", $request->id_linea)->orderBy('idproduccion','desc')->first();
        
        if($produccion->idproduccion!=$request->id_produccion)
        {    

            $parada = DB::table('parada_maquinas')->select('parada_maquinas.idparada','parada_maquinas.fecha_inicio','parada_maquinas.fecha_fin','parada_maquinas.comentario','parada_maquinas.id_maquina','parada_maquinas.id_causa','parada_maquinas.id_produccion','parada_maquinas.id_linea',DB::raw('TIMESTAMPDIFF(MINUTE, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin) as minutos'), DB::raw('MOD(TIMESTAMPDIFF(second, parada_maquinas.fecha_inicio, parada_maquinas.fecha_fin),3600) as segundos'), DB::raw('UNIX_TIMESTAMP() as FechaActual'))
        ->where("maq_principal", "=", "1")->where("parada_maquinas.id_linea", "=", $request->id_linea)->orderBy('updated_at','desc')->get();
        
            $fecha = DB::table('parada_maquinas')->select( DB::raw('UNIX_TIMESTAMP() as FechaActual'))
        ->orderBy('updated_at','desc')->first();
        $causas = DB::table("causas")
                        ->pluck("nombre","idcausa");
        
        $maquinas = DB::table("maquina")
                        ->pluck("nombre","idmaquina");
        $datos = ['Maquinas' => $maquinas, 'Paradas' => $parada, 'Causas' => $causas];

            return response()->json(array('datos' => $datos,'produccion' => $produccion->idproduccion ), 200);        
        }else{
            return response()->json(array('produccion' => null   ), 200); 

        } 


    }
}
