<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; use App\Paradas;

class ControlController extends Controller
{
    public function index()
    {
    	$maquinas = DB::table('maquina')->pluck("nombre","idmaquina");
    	$graficas = DB::table('calculo_oee')->first();

    	$parada = DB::table('parada_maquinas')->where("maq_principal", "=", "1")->get();
    	$causas = DB::table('causas')->pluck("nombre","idcausa");

        $datos = ['Maquinas' => $maquinas, 'Paradas' => $parada, 'Causas' => $causas, 'Graficas' => $graficas
        ];

        return view('control.index',compact('datos'));
    
    }
    public function show(Request $request, $id)
    {
    	$parada = Paradas::where('id',$id)->first();
    	
    	$parada->comentario = $request->comentario;
    	$parada->id_maquina = $request->id_maquina;
    	$parada->id_causa = $request->id_causa;
    	$parada->save();  

    	return response()->json($parada);
    }
    public function update(Request $request, $id)
    {
    	$parada = Paradas::where('id',$id)->first();
    	
    	$parada->comentario = $request->comentario;
    	$parada->id_maquina = $request->id_maquina;
    	$parada->id_causa = $request->id_causa;
    	$parada->save();  

    	return response()->json($parada);
    }
}
