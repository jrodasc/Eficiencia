<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Archivo; use App\Nota;
use App\Articulo; use DB;
use Validator; use Input; use Storage;
class ArchivosController extends Controller
{
    protected $rules =
    [
        'nota_id' => 'required'
        
    ];
    public function index(Request $request)
    {
        $data = Archivo::orderBy('id','desc')->get();
        $articulos = Articulo::pluck('nombre','id');;
        //$articulo_id = $data->nota()->where('categoria_id', 4)->get();
        //$data->nota()->pluck('id')->toArray();        

        return view('archivos.index', ['archivos' => $data,'articulos' => $articulos]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
        $archivo = Archivo::findOrFail($request->archivo_id);
        $archivo->nota_id = $request->nota_id;
        $archivo->save();
        return response()->json($archivo);
    }
        
    }
    public function ajaxNota($id)
        {

            $Notas = DB::table("notas")
            			->join('articulo_nota','notas.id','=','articulo_nota.nota_id')
                        ->where('articulo_nota.articulo_id',$id)
                        ->pluck("nombre","id");
            return json_encode($Notas);
        }
    public function destroy($id)
    {
        $archivo = Archivo::findOrFail($id);
        $archivo->delete();

        return response()->json($archivo);
    }
    public function DescargaArchivo($file){
      
        $public_path = public_path();
        $url = $public_path.'/storage/';
        $path = Storage::url($file);
echo $path;
/*if (Storage::exists($file))
     {
       return response()->download($path);
     }

     //si no se encuentra lanzamos un error 404.
     abort(404);*/

      //$pathtoFile = public_path().'/storage'.$file;

      //return response()->download($pathtoFile);
    }
}
