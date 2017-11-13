<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulo; use App\Archivo;
use App\Nota; use Input; use DB;
use Response;
use View;
use Validator;

class ArticulosController extends Controller
{
	protected $rules =
    [
        'nombre' => 'required|min:2|max:32|',
        
    ];
    protected $rulesCategorias =
    [
        
        'nombre' => 'required|min:2|max:32|',
        
        
    ];


    public function index(Request $request)
    {
        $data = Articulo::orderBy('id','desc')->get();
        $x = Articulo::find("1");
        $articulosarchivos = Articulo::pluck('nombre','id');
      // $archivo = $x->archivo()->pluck('id','articulo_id','filename')->toArray();
       $archivo = Articulo::select('archivos.articulo_id','archivos.id', 'archivos.nombre', 'archivos.filename')
                    ->join('archivos','archivos.articulo_id','=','articulos.id')->get();

                     
       //dd($x->archivo->articulo_id);
        //dd($data->archivo()->id);
       /* $archivo = Archivo::select(['filename'])
                    ->where('articulo_id','=',$data['id'])->orderBy('id','desc')->get();*/
//dd($archivo);
        return view('articulos.index', ['articulos' => $data, 'listaarticulos' => $articulosarchivos, 'archivos' => $archivo]);
    }
    public function store(Request $request)

    {
    	$validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {

        $articulo = new Articulo();
        $input = $request->all();
        if($request->ref==null)
            {
                $input['ref']="-";
            }
        $articulo->ref = $input['ref'];
        $articulo->nombre = $request->nombre;

       
        $articulo->save();
        
        if($request->archivo_id!=null)
        {
            $archivo = Archivo::findOrFail($articulo->id);
            $archivo->articulo_id = $articulo->id;
            $archivo->save();
        }
    
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
            $input = $request->all();
            
            $nota = new Nota();

            if($request->ref==null)
            {
                $input['ref']="-";
            }
            if($request->horamaquina==null)
            {
                $input['horamaquina']=0;
            }
            $nota->ref = $input['ref'];
            $nota->nombre = $input['nombre'];
            $nota->categoria_id = $input['categoria_id'];
            $nota->horamaquina = $input['horamaquina'];
            $nota->fecha= $input['fecha'];

            $nota->save();
            //$user = User::create($input);
//dd("asdasd");
            

          //$nota = Nota::create($input);
            
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

    	
    	$articulo = Articulo::findOrFail($id);
        $articulo->ref = $request->ref;
        $articulo->nombre = $request->nombre;
        //$articulo->categoria_id = 4;
        $articulo->save();
         if($request->archivo_id!=null)
        {   //$user->last()
            //$user= Users::all();

//var_dump($user->last())
            //$archivo = Archivo::select('id')
            //            ->where('articulo_id','=',$articulo->id);
          //  if($archivo==Null){
                $archivonuevo = Archivo::findOrFail($request->archivo_id);
                $archivonuevo->articulo_id = $articulo->id;
                $archivonuevo->save();
            //}else{
              //  $archivo->articulo_id = $articulo->id;
               // $archivo->save(); 

            //}

            //$archivo->articulo_id = $articulo->id;
            //$archivo->save();
        }


        return response()->json($articulo);
    }
    public function destroy($id)
    {

        DB::table('archivos')->where('articulo_id', $id)->delete();
        //    Personas::find($id)->delete();
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
                'notas.id','notas.ref','notas.nombre','notas.categoria_id','notas.horamaquina','notas.revision','notas.fecha','notas.created_at'])
                    ->join('articulo_nota','articulo_nota.nota_id','=','notas.id')
                    ->where('articulo_nota.articulo_id','=',$id)
                    ->where('notas.categoria_id','=','4')->orderBy('id','desc')->get();
        $notas_neumaticas = Nota::select([
                'notas.id','notas.ref','notas.nombre','notas.categoria_id','notas.horamaquina','notas.revision','notas.fecha','notas.created_at'])
                    ->join('articulo_nota','articulo_nota.nota_id','=','notas.id')
                    ->where('articulo_nota.articulo_id','=',$id)
                    ->where('categoria_id','=','1')->orderBy('id','desc')->get();
        $notas_hidraulicas = Nota::select([
                'notas.id','notas.ref','notas.nombre','notas.fecha','notas.categoria_id','notas.horamaquina','notas.revision','notas.created_at'])
                    ->join('articulo_nota','articulo_nota.nota_id','=','notas.id')
                    ->where('articulo_nota.articulo_id','=',$id)
                    ->where('categoria_id','=','2')->orderBy('id','desc')->get();                    
        $notas_otras = Nota::select([
                'notas.id','notas.ref','notas.nombre','notas.categoria_id','notas.horamaquina','notas.revision','notas.fecha','notas.created_at'])
                    ->join('articulo_nota','articulo_nota.nota_id','=','notas.id')
                    ->where('articulo_nota.articulo_id','=',$id)
                    ->where('categoria_id','=','3')->orderBy('id','desc')->get();

         
        return view('articulos.notas',compact('articulos','notas','notas_neumaticas','notas_hidraulicas','notas_otras'));
    }
}
