<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Clientes;
use App\Horarios;
use App\Ventas;
use App\Detalle_Temporal;
use App\Forma_pago;
use App\Detalle_Ventas;
use App\Facturas;
use App\Productos;
use App\Categorias;
use App\Subcategorias;
use App\pedido;
use App\detalle;
use App\Monto_delivery;
use DB;
use File;
 @session_start();
use Redirect;
use Illuminate\Support\Facades\Validator;

class VentasController extends Controller
{
    public function index(){

      $horarios  = Horarios::all();
      $deliverys = Monto_delivery::all();
      $formas    = Forma_pago::all();

      return view('Procesar.Ventas.index', compact('horarios','deliverys', 'formas' ));
    }

    public function getcliente($tlf){

    
      $clientes=Clientes::where('telefono', $tlf)->get();

           return $clientes;
 
         
    }

  public function addventa(Request $request){

        $precio_min=Productos::where('id',$request->id_producto)
                              ->Select('precio_minimo')->first();
        $pmin=number_format($precio_min->precio_minimo, 0, ',', '.');
                             
        $data=$request->all();

        $rules = array( 'cantidad'=>'required',
                        'precio'=> 'required|numeric|min:'.$pmin);

        $messages = array( 'cantidad.required'=>'La Cantidad es Requerida',
                            'precio.required'=>'El Precio es Requerido',
                            'precio.min'=> 'El Precio No Puede ser Menor A '.$pmin );

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

    public function delventa ($prod, $cliente){

      $dtemporal= Detalle_Temporal::where('id_producto',$prod)
                                  ->where('id_cliente',$cliente)
                                    ->Select('id_cliente', 'id_producto', 'cantidad', 'precio', 'espera', 'id_usuario')->first();


      
        $producto = Productos::find($prod);
        $producto->stock_activo = $producto->stock_activo+$dtemporal->cantidad;
        //$producto->id_usuario=$request->id_usuario;
        $producto->save();

        $del= Detalle_Temporal::where('id_producto',$prod)
                              ->where('id_cliente',$cliente)
                              ->delete();
        $espera= Detalle_Temporal::where('espera', 1)
                                 ->where('id_cliente',$cliente)
                                 ->count();

        return $espera;

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
                           'nombre_cliente.unique' => 'El Nombre del Cliente ya Existe', 
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
                             'nombre_cliente.unique' => 'El Nombre del Cliente ya Existe', 
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
            $id_estado_p=5;
            //$id_estado_p=1;
            
           }else{

            $id_estado_v=1;
            //$id_estado_p=7;
            $id_estado_p=1;
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
            $venta->id_forma_pago= $request->forma_pago;
            $venta->factura   = $request->factura;
            $venta->id_horario= $request->horario_venta;
            $venta->fecha_activo = $request->fecha_entrega;
            $venta->fecha_cobro  = $request->fecha_entrega;
            $venta->tipo_venta   =1;
            $venta->id_usuario   = $request->id_usuario;
            $venta->save(); 
            
            if($request->factura<>1){
            $factura= new Facturas;
            $factura->id_venta  = $venta->id;                               
            $factura->nombres   = ucwords(strtolower($request->factura_nomb));
            $factura->direccion = $request->factura_dir;
            $factura->ruc_ci    = $request->factura_ruc;
            $factura->impresa   = 0;
            $factura->id_usuario= $request->id_usuario;
            $factura->save();
            }


            
            $detalle_tempora = Detalle_Temporal::select('id_cliente', 'id_producto', 'cantidad', 'precio',  'id_usuario')->get();

              foreach ($detalle_tempora as $dt) {

                        $result  = new Detalle_Ventas;
                        $result->id_venta    = $venta->id;
                        $result->id_producto = $dt->id_producto;
                        $result->cantidad    = $dt->cantidad;
                        $result->precio      = $dt->precio;
                        $result->id_usuario  = $dt->id_usuario;
                        $result->save(); 

                        $detallep= new detalle;
                        $detallep->id_pedido  = $pedido->id;
                        $detallep->id_producto= $dt->id_producto;
                        $detallep->cantidad   = $dt->cantidad;
                        $detallep->precio     = $dt->precio;
                        $detallep->id_usuario = $dt->id_usuario;
                        $detallep->save();   

                        $del= Detalle_Temporal::where('id_cliente', $dt->id_cliente)
                                              ->where('id_producto', $dt->id_producto)
                                              ->delete();
      
                
              }

              if($request->monto>0){

                $deliverys=Monto_delivery::select('id', 'monto')->where('id',$request->monto)->first();

                $deliver= new Detalle_Ventas;
                $deliver->id_venta    = $venta->id;
                $deliver->id_producto = 36;
                $deliver->cantidad    = 1;
                $deliver->precio      = $deliverys->monto;
                $deliver->id_usuario  = $dt->id_usuario;
                $deliver->save();  

                 $detallep= new detalle;
                 $detallep->id_pedido  = $pedido->id;
                 $detallep->id_producto= 36;
                 $detallep->cantidad   = 1;
                 $detallep->precio     = $deliverys->monto;
                 $detallep->id_usuario = $dt->id_usuario;
                 $detallep->save();          
              }

             
              $jsonres['message']="La Venta fue Registrada con Éxito";
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

    public function editar_venta($id){
        
      
         $horarios  = Horarios::all();
           $deliverys = Monto_delivery::all();
          $formas    = Forma_pago::all();
          $venta=Ventas::leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
            ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
            ->leftjoin('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
            ->leftjoin('departamentos', 'clientes.id_departamento', '=', 'departamentos.id')
            ->leftjoin('facturas', 'ventas.id', '=', 'facturas.id_venta')
            ->leftjoin('horarios', 'ventas.id_horario', '=', 'horarios.id')
            ->leftjoin('forma_pago', 'ventas.id_forma_pago', '=', 'forma_pago.id')
                ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido','ventas.id_forma_pago', 'forma_pago.forma_pago', 'ventas.factura', 'ventas.id_horario', 'horarios.horario', 'ventas.fecha', 'ventas.fecha_activo', 'ventas.notas', 'ventas.id_estado', 'ventas.status_v','pedidos.id_cliente', 'clientes.id as idcliente','clientes.nombres','clientes.ruc_ci', 'clientes.id_tipo','clientes.email','clientes.telefono', 'clientes.direccion','clientes.ubicacion','clientes.barrio', 'departamentos.nombre as departamento', 'ciudades.ciudad as ciudad','barrio', 'clientes.id_ciudad as id_ciudad', 'clientes.id_departamento as id_departamento', 'ciudades.ciudad',  'facturas.nombres as fnombres',  'facturas.ruc_ci as fruc', 'facturas.direccion as fdireccion')
                ->where('ventas.id', $id)
                ->get();
          $detalles=Ventas::join('detalle_ventas', 'detalle_ventas.id_venta', '=','ventas.id')
                         ->join('productos', 'detalle_ventas.id_producto', '=','productos.id')
                         ->leftjoin('montos_delivery', 'montos_delivery.monto', '=','detalle_ventas.precio')
                         ->select('detalle_ventas.cantidad', 'detalle_ventas.precio', 'detalle_ventas.id_producto','montos_delivery.id as id_delivery', 'productos.codigo_producto', 'productos.nombre_original', 'productos.descripcion')
                         ->where('ventas.id', '=', $id)
                         ->get();
          
        
         return view('Procesar.Ventas.edit', compact('venta','horarios','deliverys', 'formas', 'detalles'));
    }

    
     public function deleditventa (Request $request){

      $dventa= Detalle_Ventas::where('id_producto',$request->id_producto)
                                ->where('id_venta',$request->id_venta)
                                ->Select('id_venta', 'id_producto', 'cantidad', 'precio')->first();


        $producto = Productos::find($request->id_producto);
        $producto->stock_activo = $producto->stock_activo+$dventa->cantidad;
        $producto->save();

        $del= Detalle_Ventas::where('id_producto',$request->id_producto)
                            ->where('id_venta',$request->id_venta)->delete();

        
        $detallep= detalle::join('ventas', 'detalle_pedidos.id_pedido', '=', 'ventas.id_pedido')
                          ->where('id_producto',$request->id_producto)
                          ->delete();


                              


        return true;

    

    }

    public function editar_guardar(Request $request){

        $data=$request->all();

        $rules = array( 'horario_venta'=>'required',
                        'forma_pago'=>'required');

        $messages = array( 'horario_venta.required'=>'El Horario de Entrega es Requerido',
                           'forma_pago.required'=>'La Forma de Pago es Requerida');

        $validator = Validator::make($data, $rules, $messages);


        if($validator->fails()){ 


              $errors = $validator->errors(); 
              
              return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
          
        }elseif ($validator->passes()){ 


           $dts= Detalle_Temporal::where('espera', 1)
                                  ->where('id_cliente', $request->id_cliente)
                                  ->count();

           if($dts>0){

            $id_estado_v=5;  
            
           }else{

            $id_estado_v=1;
           
           }

            $venta= Ventas::find($request->id_venta);
            $venta->id_estado = $id_estado_v;
            $venta->fecha     = $request->fecha_venta;
            $venta->status_v  = $id_estado_v;
            $venta->importe   = $request->importe;
            $venta->id_forma_pago= $request->forma_pago;
            $venta->factura   = $request->factura;
            $venta->id_horario= $request->horario_venta;
            $venta->fecha_activo = $request->fecha_entrega;
            $venta->fecha_cobro  = $request->fecha_entrega;
            $venta->tipo_venta   =1;
            $venta->id_usuario   = $request->id_usuario;
            $venta->save(); 


            
            
            if($request->factura<>1){

              $fact=Facturas::where('id_venta', $request->id_venta)
                                ->count();
          

            if($fact<0){

                  $factura= new Facturas;
                  $factura->id_venta  = $venta->id;                               
                  $factura->nombres   = ucwords(strtolower($request->factura_nomb));
                  $factura->direccion = $request->factura_dir;
                  $factura->ruc_ci    = $request->factura_ruc;
                  $factura->impresa   = 0;
                  $factura->id_usuario= $request->id_usuario;
                  $factura->save();
                }
            }

             $det_temp = Detalle_Temporal::where('id_cliente', $request->id_cliente)
                                               ->count();

            if($det_temp>0){

                  $detalle_tempora = Detalle_Temporal::where('id_cliente', $request->id_cliente)
                                                     ->select( 'id_cliente','id_producto', 'cantidad', 'precio',  'id_usuario')->get();

                  $pedido= Pedido::where('id_cliente', $request->id_cliente)
                                 ->where('fecha', $request->fecha_venta )
                                 ->first();
          

                    foreach ($detalle_tempora as $dt) {

                              $result  = new Detalle_Ventas;
                              $result->id_venta    = $venta->id;
                              $result->id_producto = $dt->id_producto;
                              $result->cantidad    = $dt->cantidad;
                              $result->precio      = $dt->precio;
                              $result->id_usuario  = $dt->id_usuario;
                              $result->save(); 

                              $detallep= new detalle;
                              $detallep->id_pedido  = $pedido->id;
                              $detallep->id_producto= $dt->id_producto;
                              $detallep->cantidad   = $dt->cantidad;
                              $detallep->precio     = $dt->precio;
                              $detallep->id_usuario = $dt->id_usuario;
                              $detallep->save();  

                              $del= Detalle_Temporal::where('id_cliente', $dt->id_cliente)
                                              ->where('id_producto', $dt->id_producto)
                                              ->delete();
 
                    }

            }

              if($request->monto>0){

                $detvent=Detalle_Ventas::where('id_venta', $request->id_venta)
                                       ->where('id_producto', 36)
                                       ->count();


                if($detvent<0){



                      $deliverys=Monto_delivery::select('id', 'monto')->where('id',$request->monto)->first();

                      $pedido= Pedido::where('id_cliente', $request->id_cliente)
                                 ->where('fecha', $request->fecha_venta )
                                 ->first();

                      $deliver= new Detalle_Ventas;
                      $deliver->id_venta    = $venta->id;
                      $deliver->id_producto = 36;
                      $deliver->cantidad    = 1;
                      $deliver->precio      = $deliverys->monto;
                      $deliver->id_usuario  = $request->id_usuario;
                      $deliver->save(); 
                      

                      $detallep= new detalle;
                      $detallep->id_pedido  = $pedido->id;
                      $detallep->id_producto= 36;
                      $detallep->cantidad   = 1;
                      $detallep->precio     = $deliverys->monto;
                      $detallep->id_usuario = $request->id_usuario;
                      $detallep->save();  
                }          
              }

              

              $jsonres['message']="La Venta fue  Modificada con Éxito";
               echo json_encode($jsonres);

        
        
}

}

}
