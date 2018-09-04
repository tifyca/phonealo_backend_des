<?php

namespace App\Http\Controllers\Registro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Clientes;

class ClientesController extends Controller
{
	public function index(Request $request){
		$clientes= Clientes::join('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
        				->select('clientes.id', 'nombres','telefono','direccion', 'barrio', 'clientes.id_ciudad', 'ciudades.ciudad')->paginate(10);
      if($request->ajax()){
            return response()->json(view('Registro.Clientes.lista',compact('clientes'))->render());
        }
       
    	return view('Registro.Clientes.index')->with('clientes',$clientes);
	
	}
	/*public function store(Request $request){

		$rules = array( 'nombre'=>'required|unique:clientes,nombre', 
						'email'=>'required|unique:clientes,email',
                        'telefono'=>'required|unique:clientes,telefono',
                        'status'=>'required'); 
        $messages = array( 'nombre.required'=>'Nombre del cargo es requerido', 
                      'nombre.unique' => 'El cargo ya existe', 
                      'status.required'=>'El estatus es requerido' );

        $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 

      $errors = $validator->errors(); 
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 
      $cargo= new Cargos; 
      $cargo->cargo = $request->nombre; 
      $cargo->status =$request->status; 
      $cargo->id_usuario=$request->id_usuario;
      $cargo->save(); 
      return response()->json($cargo);

      }  
        
    }

		
	}*/
	public function show(){
		return view('Registro.Clientes.show');
	}
	public function update(){
		return view('Registro.Clientes.edit');
	}
	public function edit(){
		
	}
    
}
