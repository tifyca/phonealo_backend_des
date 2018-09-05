<?php

namespace App\Http\Controllers\Registro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Clientes;
use Mapper;

class ClientesController extends Controller
{
	public function index(Request $request){
		$clientes= Clientes::join('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
        				->select('clientes.id', 'nombres','telefono','direccion', 'barrio', 'clientes.id_ciudad', 'ciudades.ciudad', 'ubicacion')->paginate(10);
      if($request->ajax()){
            return response()->json(view('Registro.Clientes.lista',compact('clientes'))->render());
        }
       
    	return view('Registro.Clientes.index')->with('clientes',$clientes);
	
	}
	
	public function show(){
		return view('Registro.Clientes.show');
	}

  public function create_cliente(Request $request){

    $data=$request->all();

    $rules = array( 'nombre_cliente'=>'required|unique:clientes,nombres', 
                    'email_cliente'=>'required|unique:clientes,email',
                    'telefono_cliente'=>'required|unique:clientes,telefono',
                    'departamento_cliente'=>'required|not_in:0',
                    'ciudad_cliente'=>'required|not_in:0',
                    'barrio_cliente'=>'required|not_in:0',
                    'direccion_cliente'=>'required',
                    'ubicacion_cliente'=>'required');

    $messages = array( 'nombre_cliente.required'=>'Nombre del cliente es requerido', 
                       'nombre_cliente.unique' => 'El cliente ya existe', 
                       'email_cliente.required'=>'El email del cliente es requerido', 
                       'email_cliente.unique' => 'El email del cliente ya existe',
                       'telefono_cliente.required'=>'El teléfono del cliente es requerido', 
                       'telefono_cliente.unique' => 'El teléfono del cliente ya existe',
                       'departamento_cliente.required'=>'El departamento del cliente es requerido',
                       'departamento_cliente.not_in'=> 'El departamento del cliente es requerido',
                       'ciudad_cliente.required'=> 'La ciudad del cliente es requerida',
                       'ciudad_cliente.not_in'=> 'La ciudad del cliente es requerida',
                       'barrio_cliente.required'=> 'El barrio del cliente es requerido',
                       'barrio_cliente.not_in'=> 'El barrio del cliente es requerido',
                       'direccion_cliente.required'=>'La dirección del cliente es requerida',
                       'direccion_cliente.not_in'=>'La dirección del cliente es requerida',
                       'ubicacion_cliente.required'=> 'La ubicación del cliente es requerida',
                       'ubicacion_cliente.not_in'=> 'La ubicación del cliente es requerida', );

        $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 


      $errors = $validator->errors(); 
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 


      $cliente= new Clientes; 
      $cliente->nombres   = $request->nombre_cliente; 
      $cliente->telefono  = $request->telefono_cliente; 
      $cliente->direccion = $request->direccion_cliente;
      $cliente->barrio    = $request->barrio_cliente;
      $cliente->id_ciudad = $request->ciudad_cliente;
      $cliente->id_departamento=$request->departamento_cliente;
      $cliente->ruc_ci    = $request->ruc_cliente;
      $cliente->email     = $request->email_cliente;
      $cliente->ubicacion = $request->ubicacion_cliente;
      $cliente->id_tipo   = $request->tipo_cliente;
      $cliente->notas     = $request->nota_cliente;
      $cliente->id_estado= $request->id_estado;
      $cliente->id_usuario= $request->id_usuario;
      $cliente->save(); 

 
     
      return Redirect::to('registro/clientes')->with('message', 'El Cliente fue Creado Exitosamente!!');

      }  
        
    }

  public function editar($id_cliente){
    $cliente = Clientes::find($id_cliente);
   return view('Registro.Clientes.edit', compact('cliente'));
    }



	public function update(){
		return view('Registro.Clientes.edit');
	}

  public function gmaps($ubicacion)
  {

$data = explode(",", $ubicacion);      

   
        $lat=$data[0];
        $lon=$data[1];

        Mapper::map($lat,$lon, [
                   "zoom"           => 16,
                   "draggable"               =>  true,
                   "marker"            => true,
                   "eventAfterLoad"      => 'circleListener(maps[0].shapes[0].circle_0);'
                 ]

);



    

        return view('Registro.Clientes.gmaps');
  }
}
