<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Clientes;
use App\Horarios;
use App\Ventas;
use App\Detalle_Temporal;
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

	public function addventa(Request $request){



    	$addventa= new Detalle_Temporal;
    	$addventa->id_cliente=$request->id_cliente;
    	$addventa->id_producto=$request->id_producto;
    	$addventa->cantidad=$request->cantidad;
    	$addventa->precio=$request->precio;
    	$addventa->save(); 
    	


         	return ($addventa);
   	} 
	

     public function create(Request $request){


     	if($request->id_cliente=="")
     	{
     	$data=$request->all();

		    $rules = array( 'nombre_cliente'=>'required|unique:clientes,nombres', 
		                    'email_cliente'=>'required|email|unique:clientes,email',
		                    'telefono_cliente'=>'required|unique:clientes,telefono',
		                    'departamento_cliente'=>'required|not_in:0',
		                    'ciudad_cliente'=>'required|not_in:0',
		                    'barrio_cliente'=>'required|not_in:0',
		                    'direccion_cliente'=>'required');

		    $messages = array( 'nombre_cliente.required'=>'Nombre del Cliente es Requerido', 
		                       'nombre_cliente.unique' => 'El Cliente ya Existe', 
		                       'email_cliente.required'=>'El Email del Cliente es Requerido', 
		                       'email_cliente.unique' => 'El Email del Cliente ya Existe',
		                       'email_cliente.email' => 'El Formato de Email es Incorrecto',
		                       'telefono_cliente.required'=>'El Teléfono del Cliente es Requerido', 
		                       'telefono_cliente.unique' => 'El Teléfono del Cliente ya Existe',
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
    $cliente->id_estado = $request->id_estado;
    $cliente->id_usuario= $request->id_usuario;
    $cliente->save(); 
}	
	$venta= new Ventas;
	$venta->id_pedido;
	$venta->id_estado;
	$venta->fecha;
	$venta->status_v;
	$venta->notas;
	$venta->importe;
	$venta->forma_pago;
	$venta->factura;
	$venta->horario_entrega;
    $venta->fecha_activo;
	$venta->fecha_cobro;
	$venta->id_usuario;
	$venta->save(); 
	
	$factura= new Facturas;
	$factura->id_venta  = $venta->id;                               
	$factura->nombres   = $request->factura_nomb;
	$factura->direccion = $request->factura_dir;
	$factura->ruc_ci    = $request->factura_ruc;
	$factura->id_usuario= $request->id_usuario;
	$factura->save();

 //return response()->json(view('Registro.Clientes.index')->with('message', 'El Cliente fue Creado Exitosamente!!'));
     
      //return Redirect::to('registro/clientes')->with('message', 'El Cliente fue Creado Exitosamente!!');
     // $trues="La venta fue Creada Exitosamente!!";
    //  return response()->json([ 'success' => true, 'message' => json_decode($trues) ], 200);

      }  
        
    }

}
