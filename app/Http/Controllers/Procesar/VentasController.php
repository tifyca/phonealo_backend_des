<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Clientes;
use App\Horarios;
use App\Ventas;
use App\Facturas;
use Redirect;
use Illuminate\Support\Facades\Validator;

class VentasController extends Controller
{
    public function index(){

    	$horarios=Horarios::all();

    	return view('Procesar.Ventas.index', compact('horarios'));
    }

    public function getcliente(Request $request){

    
    	$clientes=Clientes::where('telefono', $request->search)->first();

         	return ($clientes);
   	}

     public function create(Request $request){

     	$data=$request->all();

    $rules = array( 'nombre_cliente'=>'required', //|unique:clientes,nombres', 
                    'email_cliente'=>'required', //|unique:clientes,email',
                    'telefono_cliente'=>'required', //|unique:clientes,telefono',
                    'departamento_cliente'=>'required|not_in:0',
                    'ciudad_cliente'=>'required|not_in:0',
                    'barrio_cliente'=>'required|not_in:0',
                    'direccion_cliente'=>'required');

    $messages = array( 'nombre_cliente.required'=>'Nombre del Cliente es Requerido', 
                      // 'nombre_cliente.unique' => 'El Cliente ya Existe', 
                       'email_cliente.required'=>'El Email del Cliente es Requerido', 
                      // 'email_cliente.unique' => 'El Email del Cliente ya Existe',
                       'telefono_cliente.required'=>'El Teléfono del Cliente es Requerido', 
                      // 'telefono_cliente.unique' => 'El Teléfono del Cliente ya Existe',
                       'departamento_cliente.required'=>'El Departamento del Cliente es Requerido',
                       'departamento_cliente.not_in'=> 'El Departamento del Cliente es Requerido',
                       'ciudad_cliente.required'=> 'La Ciudad del Cliente es Requerida',
                       'ciudad_cliente.not_in'=> 'La Ciudad del Cliente es Requerida',
                       'barrio_cliente.required'=> 'El Barrio del Cliente es Requerido',
                       'barrio_cliente.not_in'=> 'El Barrio del Cliente es Requerido',
                       'direccion_cliente.required'=>'La Dirección del Cliente es Requerida',
                       'direccion_cliente.not_in'=>'La Dirección del Cliente es Requerida');

        $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 


      $errors = $validator->errors(); 
      
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 


      $cliente= new Ventas; 
      /*$cliente->nombres   = $request->nombre_cliente; 
      $cliente->telefono  = $request->telefono_cliente; 
      $cliente->direccion = $request->direccion_cliente;
      $cliente->barrio    = $request->barrio_cliente;
      $cliente->id_ciudad = $request->ciudad_cliente;
      $cliente->id_departamento=$request->departamento_cliente;
      $cliente->ruc_ci    = $request->ruc_cliente;
      $cliente->email     = $request->email_cliente;
      $cliente->ubicacion = $request->ubicacion_cliente;
      $cliente->id_tipo   = $request->tipo_cliente;
      $cliente->notas     = $request->nota_cliente;*/
      $cliente->id_estado= $request->id_estado;
      $cliente->id_usuario= $request->id_usuario;
      $cliente->save(); 

 //return response()->json(view('Registro.Clientes.index')->with('message', 'El Cliente fue Creado Exitosamente!!'));
     
      //return Redirect::to('registro/clientes')->with('message', 'El Cliente fue Creado Exitosamente!!');
      $trues="La venta fue Creada Exitosamente!!";
      return response()->json([ 'success' => true, 'message' => json_decode($trues) ], 200);

      }  
        
    }

}
