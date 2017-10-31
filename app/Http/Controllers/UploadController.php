<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nota;
use App\Archivo; use Storage;
class UploadController extends Controller
{
    public function uploadForm()
	{
	    return view('archivos.upload_form');
	}
	 
	public function uploadSubmit(Request $request)
	{
	    $archivos = [];
	    foreach ($request->archivos as $archivo) {

	        $filename = $archivo->store('archivos');
	        $nota_archivo = Archivo::create([
	            'filename' => $filename
	        ]);
	 
	        $archivo_object = new \stdClass();
	        $archivo_object->name = str_replace('archivos/', '',$archivo->getClientOriginalName());
	        $archivo_object->size = round(Storage::size($filename) / 1024, 2);
	        $archivo_object->fileID = $nota_archivo->id;
	        $archivos[] = $archivo_object;
	    }
	 
	    return response()->json(array('files' => $archivos), 200);
	}
	 
	public function postProduct(Request $request)
	{
	    $nota = Nota::create([
	    	'nombre' => "con archivo",
	    	'horamaquina' => "12",
	    	'revision' => "0",
	    	'ref' => "123456",
	    	'categoria_id' => "1"
	    ]);
	    
    	Archivo::whereIn('id', explode(",", $request->file_ids))
        ->update(['nota_id' => $nota->id]);
    return 'Nota saved successfully';
	}
}
