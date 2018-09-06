<?php

namespace App\Http\Controllers\Registro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Proveedores;

class ProveedoresController extends Controller
{
    public function index(Request $request){

    	$proveedor= Proveedores::join('paises', 'proveedores.id_pais', '=', 'paises.id')
        				->select( 'paises.nombre as pais', 'proveedores.nombres as proveedor','ruc', 'proveedores.id_pais', 'direccion', 'email', 'telefono')->paginate(3);
      if($request->ajax()){
            return response()->json(view('Registro.Proveedores.lista',compact('proveedor'))->render());
        }
       
    	return view('Registro.Proveedores.index')->with('proveedor',$proveedor);
	
	}

	public function store(){
		
	}
	public function show(){
		return view('Registro.Proveedores.show');
	}
	public function update(){
		return view('Registro.Proveedores.edit');
	}
	public function edit(){
		
	}
}
