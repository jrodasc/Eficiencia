<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulo; 
use App\Nota; use Input;
use Response;
use View;
use Validator;

class ArticulosController extends Controller
{
	protected $rules =
    [
        'ref' => 'required|min:2|max:12|unique:articulos',
        'nombre' => 'required|min:2|max:32|',
        
    ];
    protected $rulesCategorias =
    [
        'ref' => 'required|min:2|max:12|unique:articulos',
        'nombre' => 'required|min:2|max:32|',
        'horamaquina' => 'required|min:2|max:12|',
        
    ];


    public function index(Request $request)
    {
        $data = Articulo::orderBy('id','desc')->get();

        return view('articulos.index', ['articulos' => $data]);
    }
    public function store(Request $request)

    {
    	$validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
        $articulo = new Articulo();
        $articulo->ref = $request->ref;
        $articulo->nombre = $request->nombre;
        
    
        $articulo->save();
        return response()->json($articulo);
       }
    }
    public function notasadd(Request $request)
    {
        if($request->categoria_id==4)
            $validator = Validator::make(Input::all(), $this->rules);
        else
            $validator = Validator::make(Input::all(), $this->rulesCategorias);
       if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            /*$nota = new Nota();
            $nota->ref = $request->ref;
            $nota->nombre = $request->nombre;

            $nota->save();
            $user = User::create($input);*/

            $input = $request->all();
            $nota = Nota::create($input);
            $articulo_id = $request->articulo_id;

            $nota->articulos()->attach($articulo_id);
            
            return response()->json($nota);
       }
    }
    public function notasedit(Request $request, $id)
    {
        $nota = Nota::findOrFail($id);
        $nota->ref = $request->ref;
        $nota->nombre = $request->nombre;
        
        $nota->save();
        return response()->json($nota);
    }

    public function changeStatus(Request $request, $id) 
    {
        //$id = Input::get('id');

        $nota = Nota::findOrFail($id);
        $nota->revision = !$nota->revision;
        $nota->save();

        return response()->json($nota);
    }
    public function update(Request $request, $id)
    {
//dd($id);
    	
    	$articulo = Articulo::findOrFail($id);
        $articulo->ref = $request->ref;
        $articulo->nombre = $request->nombre;
        $articulo->categoria_id = $request->categorias_id;
        $articulo->save();
        return response()->json($articulo);
    }
    public function destroy($id)
    {
        $articulo = Articulo::findOrFail($id);
        $articulo->delete();

        return response()->json($articulo);
    }
    public function notasdelete($id)
    { 
        $nota = Nota::findOrFail($id);
        $nota->delete();

        return response()->json($nota);
    }
    public function notas(Request $request, $id)
    { 
    	$articulos = Articulo::find($id);
           	
        $notas = Nota::select([
                'notas.id','notas.ref','notas.nombre','notas.categoria_id','notas.horamaquina','notas.revision','notas.created_at'])
                    ->join('articulo_nota','articulo_nota.nota_id','=','notas.id')
                    ->where('articulo_nota.articulo_id','=',$id)
                    ->where('notas.categoria_id','=','4')->orderBy('id','desc')->get();
        $notas_neumaticas = Nota::select([
                'notas.id','notas.ref','notas.nombre','notas.categoria_id','notas.horamaquina','notas.revision','notas.created_at'])
                    ->join('articulo_nota','articulo_nota.nota_id','=','notas.id')
                    ->where('articulo_nota.articulo_id','=',$id)
                    ->where('categoria_id','=','1')->orderBy('id','desc')->get();
        $notas_hidraulicas = Nota::select([
                'notas.id','notas.ref','notas.nombre','notas.categoria_id','notas.horamaquina','notas.revision','notas.created_at'])
                    ->join('articulo_nota','articulo_nota.nota_id','=','notas.id')
                    ->where('articulo_nota.articulo_id','=',$id)
                    ->where('categoria_id','=','2')->orderBy('id','desc')->get();                    
        $notas_otras = Nota::select([
                'notas.id','notas.ref','notas.nombre','notas.categoria_id','notas.horamaquina','notas.revision','notas.created_at'])
                    ->join('articulo_nota','articulo_nota.nota_id','=','notas.id')
                    ->where('articulo_nota.articulo_id','=',$id)
                    ->where('categoria_id','=','3')->orderBy('id','desc')->get();

         
        return view('articulos.notas',compact('articulos','notas','notas_neumaticas','notas_hidraulicas','notas_otras'));
    }
}
