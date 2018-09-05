<?php

namespace App\Http\Controllers\Registro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Productos;
use App\Categorias;
use App\Subcategorias;

class ProductosController extends Controller
{
    public function index(Request $request){
    	$productos=productos::where('id','asc')->paginate(10);
    	$categorias=categorias::where('tipo','Productos')->get();
		return view('Registro.Productos.index')->with('categorias',$categorias)->with('productos',$productos);
	}
	public function store(Request $request){
		
	}
	public function show($id){
		return view('Registro.Productos.show');
	}
	public function update(Request $request,$id){
		return view('Registro.Productos.edit');
	}
	public function detalle($id){
		return view('Registro.Productos.detalle');
	}
	
	public function edit($id){
		
	}

}
