<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Archivo;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = DB::table('users')->count();
        $archivos = DB::table('archivos')->count();
        return view('admin.tablero',compact('usuarios','archivos'));
    }
}
