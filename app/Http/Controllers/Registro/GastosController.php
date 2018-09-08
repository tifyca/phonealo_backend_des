<?php

namespace App\Http\Controllers\Registro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categorias;
use App\Subcategorias;
use App\auditoria;
use App\User;
use App\Gastos;
use DB;
use File;
 @session_start();

class GastosController extends Controller
{
    public function index(Request $request){

    	$categorias=categorias::where('tipo','Gastos')->get();
        $gastos = gastos::orderby('fecha','desc')->paginate(10);
        $usuarios = User::orderby('id','asc')->get();
		return view('Registro.Gastos.index')->with('gastos',$gastos)->with('categorias',$categorias)->with('usuarios',$usuarios);
	}
	public function show(){
		return view('Registro.Gastos.show');
	}
	public function update(){
		return view('Registro.Gastos.edit');
	}
}
