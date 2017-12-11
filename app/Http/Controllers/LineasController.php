<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Linea;

class LineasController extends Controller
{
    public function index(Request $request)
    {
        $data = Linea::orderBy('idlinea','desc')->get();
       

        return view('lineas.index', ['lineas' => $data]);
    }
}
