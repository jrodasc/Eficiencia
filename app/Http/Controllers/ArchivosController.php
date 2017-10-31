<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Archivo;
class ArchivosController extends Controller
{
    public function index(Request $request)
    {
        $data = Archivo::orderBy('id','desc')->get();

        return view('archivos.index', ['archivos' => $data]);
    }
}
