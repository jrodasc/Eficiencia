<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Archivo;
use App\Articulo; use DB;
class ArchivosController extends Controller
{
    public function index(Request $request)
    {
        $data = Archivo::orderBy('id','desc')->get();
        $articulos = Articulo::pluck('nombre','id');;

        return view('archivos.index', ['archivos' => $data,'articulos' => $articulos]);
    }
    public function ajaxNota($id)
        {

            $Notas = DB::table("notas")
            			->join('articulo_nota','notas.id','=','articulo_nota.nota_id')
                        ->where('articulo_nota.articulo_id',$id)
                        ->pluck("nombre","id");
            return json_encode($Notas);
        }
}
