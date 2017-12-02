<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; use App\Paradas; use App\Calculo;
use Session; use DateTime;

class ControlController extends Controller
{
    public function index()
    {
    	$maquinas = DB::table('maquina')->pluck("nombre","idmaquina");
    	$graficas = DB::table('calculo_oee')->first();

    	$parada = DB::table('parada_maquinas')->where("maq_principal", "=", "1")->orderBy('updated_at','desc')->get();
        $paradaupdated_at = Paradas::where("maq_principal", "=", "1")->orderBy('updated_at','desc')->first();
    	$causas = DB::table('causas')->where("idmaquina", "=", "1")->pluck("nombre","idcausa");

        $datos = ['Maquinas' => $maquinas, 'Paradas' => $parada, 'Causas' => $causas, 'fecha_bd' => $paradaupdated_at->updated_at,'Graficas' => $graficas
        ];

        return view('control.index',compact('datos'));
    
    }
    public function calculo_oee($id)
    {
        $calculo = calculo::where('produccion',$id)->first();
        $totalnet = 0; $i=1; $total = 0;
        //dd($calculo);
        if(isset($calculo))
        {
            $producciones = DB::table('parada_maquinas')->join('maquina', 'maquina.idmaquina','=', 'parada_maquinas.id_maquina')->where("parada_maquinas.id_produccion", "=", $id)->where("maq_principal", "=", "1")->orderBy('updated_at','desc')->get();

            foreach ($producciones as $produccion) {
                //dd($produccion->fecha_inicio);
                //dd($produccion->net);
                if($produccion->net == 1 )
                {
                    $from = new DateTime($produccion->fecha_inicio);
                    $to = new DateTime();
                    echo "<pre>";
                    $interval = $to->diff($from, true);
                   // dd($producciones[$i]->net);
                    $totalnet = $totalnet + $interval->format('%i%a');      
                }else
                {
                    $from = new DateTime($produccion->fecha_inicio);
                    $to = new DateTime();
                    echo "<pre>";
                    $interval = $to->diff($from, true);
                   // dd($producciones[$i]->net);
                    $total = $total + $interval->format('%i%a');      
                }
                
                $i++;
            }
          //  dd($totalnet);
            $calculo->sumanet = $totalnet;
            $calculo->sumatrue = $total;
            $calculo->save();     
        }
       // dd($calculo);
       
        

    }
    public function show(Request $request, $id)
    {
    	$parada = Paradas::where('id',$id)->first();
    	
    	$parada->comentario = $request->comentario;
    	$parada->id_maquina = $request->id_maquina;
    	$parada->id_causa = $request->id_causa;
//dd($request->id_produccion);
        $this->calculo_oee($request->id_produccion);
    	$parada->save();  

    	return response()->json($parada);
    }
    public function update(Request $request, $id)
    {
    	$parada = Paradas::where('id',$id)->first();
    	
    	$parada->comentario = $request->comentario;
    	$parada->id_maquina = $request->id_maquina;
    	$parada->id_causa = $request->id_causa;
      //  dd($request->id_produccion);
        $this->calculo_oee($request->id_produccion);
    	$parada->save();  

    	return response()->json($parada);
    }
    public function httpush(Request $request)
    {   // dd("asdas");
        set_time_limit(0); 
        //dd($request->timestamp);
        $fecha_ac = isset($request->timestamp) ? $request->timestamp:0;
        //$fecha_bd = isset($request->fecha_bd) ? $request->fecha_bd:0;

        $fecha_bd = 0;
        
       // while( $fecha_bd <= $fecha_ac )
       // { 

        while( $fecha_bd <= $fecha_ac )
        {    
            //$query3    = "SELECT timestamp FROM mensajes ORDER BY timestamp DESC LIMIT 1";
            $parada = Paradas::where("maq_principal", "=", "1")->orderBy('updated_at','desc')->first();
            usleep(100000);//anteriormente 10000
            clearstatcache();
            //Session::put('fecha_bd',strtotime($parada->updated_at));
           
            //Session::put('impresora',$impresora);
            $fecha_bd  = strtotime($parada->updated_at);
          //dd("------".$fecha_bd."********".$fecha_ac);
          //  return response($parada);   
        } 
        $parada = Paradas::where("maq_principal", "=", "1")->orderBy('updated_at','desc')->first();
        //Session::put('fecha_bd',strtotime($parada->updated_at));
        //Session::put('fecha_ac',strtotime($request->timestamp));
//        return response($parada);
        return response()->json(array('updated_at' => strtotime($parada->updated_at), 'fecha_inicio' => $parada->fecha_inicio, 'fecha_fin' => $parada->fecha_fin, 'id_maquina' => $parada->id_maquina, 'id_causa' => $parada->id_causa, 'id' => $parada->id, 'comentario' => $parada->comentario   ), 200); 
         //return response("hola");      
            //return response($parada);
       // }

      //  $parada = DB::table('parada_maquinas')->where("maq_principal", "=", "1")->get();
       // $parada = Paradas::where("maq_principal", "=", "1")->orderBy('updated_at','desc')->first();
        //ORDER BY timestamp DESC LIMIT 1
        /*$datos = ['id' => $parada->id, 'fecha_inicio' => $parada->fecha_inicio, 'fecha_fin' => $parada->fecha_fin, 'comentario' => $parada->comentario, 'id_maquina' => $parada->id_maquina, 'id_causa' => $parada->id_causa
        ];
        
        $dato_json   = json_encode($datos);*/
        //$parada->updated_at=strtotime($parada->updated_at);
        //Session::put('impresora',$impresora);
        


    }
}
