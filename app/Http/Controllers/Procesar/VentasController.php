<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Clientes;
use App\Horarios;
use App\Ventas;
use App\Detalle_Temporal;
use App\Forma_Pago;
use App\Detalle_Ventas;
use App\Facturas;
use App\Productos;
use App\Categorias;
use App\Subcategorias;
use App\pedido;
use App\Montos_delivery;
use DB;
use File;
 @session_start();
use Redirect;
use Illuminate\Support\Facades\Validator;

class VentasController extends Controller
{
    public function index(){

    	$horarios  = Horarios::all();
      $deliverys = Montos_delivery::all();
      $formas    = Forma_Pago::all();

    	return view('Procesar.Ventas.index', compact('horarios','deliverys', 'formas' ));
    }

    public function getcliente($tlf){

    
    	$clientes=Clientes::where('telefono', $tlf)->get();

           return $clientes;
 
         
   	}

	public function addventa(Request $request){

        $data=$request->all();

        $rules = array( 'cantidad'=>'required');

        $messages = array( 'cantidad.required'=>'La Cantidad es Requerida');

        $validator = Validator::make($data, $rules, $messages);

       if($validator->fails()){ 


          $errors = $validator->errors(); 
          
          return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
          
         }elseif ($validator->passes()){ 


    	        $addventa= new Detalle_Temporal;
              $addventa->id_cliente = $request->id_cliente;
              $addventa->id_producto= $request->id_producto;
              $addventa->cantidad   = $request->cantidad;
              $addventa->precio     = $request->precio;
              $addventa->id_usuario = $request->id_usuario;
              $addventa->espera     = $request->espera;
              $addventa->save(); 


              $producto = Productos::find($request->id_producto);
              $producto->stock_activo = $request->disponible;
              $producto->id_usuario   = $request->id_usuario;
              $producto->save();
    	
             	return ($addventa);

      }

}

    public function delventa ($prod){

      $dtemporal= Detalle_Temporal::where('id_producto',$prod)
                                    ->Select('id_cliente', 'id_producto', 'cantidad', 'precio', 'espera', 'id_usuario')->first();


      
        $producto = Productos::find($prod);
        $producto->stock_activo = $producto->stock_activo+$dtemporal->cantidad;
        //$producto->id_usuario=$request->id_usuario;
        $producto->save();

        $del= Detalle_Temporal::where('id_producto',$prod)->delete();
        $espera= Detalle_Temporal::where('espera', 1)->count();

        return $espera ;
    

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
		                    'direccion_cliente'=>'required',
                        'horario_venta'=>'required',
                        'forma_pago'=>'required');

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
		                       'direccion_cliente.not_in'=>'La Dirección del Cliente es Requerida',
                           'horario_venta.required'=>'El Horario de Entrega es Requerido',
                           'forma_pago.required'=>'La Forma de Pago es Requerida');

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

              $cliente=$cliente->id;
        }	

    }else{

         $data=$request->all();

          $rules = array( 'nombre_cliente'=>'required|unique:clientes,nombres,' .$request->id_cliente,  
                          'email_cliente'=>'required|email|unique:clientes,email,' .$request->id_cliente,
                          'telefono_cliente'=>'required|unique:clientes,telefono,' .$request->id_cliente,
                          //'telefono_cliente2'=>'unique:clientes,telefono,'.$cliente_id,
                          'departamento_cliente'=>'required|not_in:0',
                          'ciudad_cliente'=>'required|not_in:0',
                          'barrio_cliente'=>'required|not_in:0',
                          'direccion_cliente'=>'required',
                          'horario_venta'=>'required',
                          'forma_pago'=>'required');

          
          $messages = array( 'nombre_cliente.required'=>'Nombre del Cliente es Requerido', 
                             'nombre_cliente.unique' => 'El Cliente ya Existe', 
                             'email_cliente.required'=>'El Email del Cliente es Requerido', 
                             'email_cliente.unique' => 'El Email del Cliente ya Existe',
                             'email_cliente.email' => 'El Formato de Email es Incorrecto',
                             'telefono_cliente.required'=>'El Teléfono del Cliente es Requerido', 
                             'telefono_cliente.unique' => 'El Teléfono del Cliente ya Existe',
                            // 'telefono_cliente2.unique' => 'El Teléfono del Cliente ya Existe',
                             'departamento_cliente.required'=>'El Departamento del Cliente es Requerido',
                             'departamento_cliente.not_in'=> 'El Departamento del Cliente es Requerido',
                             'ciudad_cliente.required'=> 'La Ciudad del Cliente es Requerida',
                             'ciudad_cliente.not_in'=> 'La Ciudad del Cliente es Requerida',
                             'barrio_cliente.required'=> 'El Barrio del Cliente es Requerido',
                             'barrio_cliente.not_in'=> 'El Barrio del Cliente es Requerido',
                             'direccion_cliente.required'=>'La Dirección del Cliente es Requerida',
                             'direccion_cliente.not_in'=>'La Dirección del Cliente es Requerida',
                             'horario_venta.required'=>'El Horario de Entrega es Requerido',
                             'forma_pago.required'=>'La Forma de Pago es Requerida');

 

            $validator = Validator::make($data, $rules, $messages);


    if($validator->fails()){ 


            $errors = $validator->errors(); 
            
            return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
    }elseif ($validator->passes()){ 


            $cliente = Clientes::find($request->id_cliente);
            $cliente->nombres   = ucwords(strtolower($request->nombre_cliente)); 
            $cliente->telefono  = $request->telefono_cliente; 
           // $cliente->telefono2  = $request->telefono_cliente2; 
            $cliente->direccion = $request->direccion_cliente;
            $cliente->barrio    = $request->barrio_cliente;
            $cliente->id_ciudad = $request->ciudad_cliente;
            $cliente->id_departamento=$request->departamento_cliente;
            $cliente->ruc_ci    = $request->ruc_cliente;
            $cliente->email     = ucwords(strtolower($request->email_cliente));
            $cliente->ubicacion = $request->ubicacion_cliente;
            $cliente->id_tipo   = $request->tipo_cliente;
            $cliente->notas     = $request->nota_cliente;
            $cliente->id_estado = $request->id_estado;
            $cliente->id_usuario= $request->id_usuario;
            $cliente->save(); 

     
    }  

           $cliente= $request->id_cliente;
  }

           $dts= Detalle_Temporal::where('espera', 1)->count();

           if($dts>0){

            $id_estado_v=5;
            $id_estado_p=1;
            
           }else{

            $id_estado_v=1;
            $id_estado_p=7;
           }


            $pedido= new Pedido;
            $pedido->id_cliente = $cliente;
            $pedido->fecha      = $request->fecha_venta;
            $pedido->id_estado  =$id_estado_p;
            $pedido->id_usuario =$request->id_usuario;
            $pedido->save(); 


          	$venta= new Ventas;
          	$venta->id_pedido = $pedido->id;
          	$venta->id_estado = $id_estado_v;
          	$venta->fecha     = $request->fecha_venta;
          	$venta->status_v  = $id_estado_v;
          	$venta->importe   = $request->importe;
          	$venta->forma_pago= $request->forma_pago;
          	$venta->factura   = $request->factura;
          	$venta->id_horario= $request->horario_venta;
            $venta->fecha_activo   = $request->fecha_activo;
          	$venta->fecha_cobro    = $request->fecha_cobro;
          	$venta->id_usuario     = $request->id_usuario;
          	$venta->save(); 
          	
            if($request->factura<>1){
          	$factura= new Facturas;
          	$factura->id_venta  = $venta->id;                               
          	$factura->nombres   = ucwords(strtolower($request->factura_nomb));
          	$factura->direccion = $request->factura_dir;
          	$factura->ruc_ci    = $request->factura_ruc;
          	$factura->id_usuario= $request->id_usuario;
          	$factura->save();
            }


            
            $detalle_tempora = Detalle_Temporal::select( 'id_producto', 'cantidad', 'precio',  'id_usuario')->get();

              foreach ($detalle_tempora as $dt) {

                        $result  = new Detalle_Ventas;
                        $result->id_venta    = $venta->id;
                        $result->id_producto = $dt->id_producto;
                        $result->cantidad    = $dt->cantidad;
                        $result->precio      = $dt->precio;
                        $result->id_usuario  = $dt->id_usuario;
                        $result->save();           
                
              }

              if($request->monto>0){

                $deliverys=Montos_delivery::select('id', 'monto')->where('id',$request->monto)->first();

                $deliver= new Detalle_Ventas;
                $deliver->id_venta    = $venta->id;
                $deliver->id_producto = 36;
                $deliver->cantidad    = 1;
                $deliver->precio      = $deliverys->monto;
                $deliver->id_usuario  = $dt->id_usuario;
                $deliver->save();            
              }

              $del= Detalle_Temporal::truncate();

              $jsonres['message']="La Venta fue  Registrado con Éxito";
               echo json_encode($jsonres);

        
        
}

    public function detalle_producto($id){
        $productos=productos::find($id);
        $categorias=Categorias::where('id',$productos->id_categoria)->first();
        if($categorias)
            $categoria = $categorias->categoria;
        else 
            $categoria="";
        $subcategorias=Subcategorias::where('id',$productos->id_subcategoria)->first();
        if($subcategorias)
        $subcategoria = $subcategorias->sub_categoria;
       else
        $subcategoria="";
       $imagenes=db::table('producto_imagenes as a')
                    ->select('a.id_producto','a.imagen')
                    ->where('id_producto',$id)->get();
      
         return response()->json([ 'productos' => $productos, 'categoria' => $categoria, 'subcategoria' => $subcategoria, 'imagenes' => $imagenes ]);
    }

}
