<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; use App\Paradas;

class ControlController extends Controller
{
    public function index()
    {
    	$maquinas = DB::table('maquina')->pluck("nombre","idmaquina");

    	$parada = DB::table('parada_maquinas')->get();
    	$causas = DB::table('causas')->get();
        $datos = ['Maquinas' => $maquinas, 'Paradas' => $parada, 'Causas' => $causas
        ];

        return view('control.index',compact('datos'));
    
    }
    public function show(Request $request, $id)
    {
    	$parada = Paradas::where('id',$id)->first();
    	
    	$parada->comentario = $request->comentario;
    	$parada->save();  

    	return response()->json($parada);
    }
    public function update(Request $request, $id)
    {
    	$parada = Paradas::where('id',$id)->first();
    	
    	$parada->comentario = $request->comentario;
    	$parada->save();  

    	return response()->json($parada);
    }
}
