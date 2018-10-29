<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facturas;
use App\Ventas;
use App\Remitos;
use App\Detalle_remito;
use App\Notas_Ventas;
use App\Productos;
use App\Horarios;
use App\pedido;
use DB;

class Logistica extends Controller
{
    #jgonzalez
   	public function detalle_venta(Request $request){
    	$id = $request['id'];
    	$venta = Ventas::Detalle($id);

         $notas  =Notas_Ventas::join('users', 'notas_ventas.id_usuario', '=', 'users.id')
                            ->select('nota', 'id_venta', 'name as nombre', 'notas_ventas.created_at as fecha')
                            ->groupBy('id_venta', 'notas_ventas.id_usuario', 'notas_ventas.created_at')
                            ->get();
    	//return $venta;
         return response()->json([ 'venta' => $venta, 'notas' => $notas ]);
    }
    #jgonzalez
    public function agregar_remisa(Request $request){
    	$id = $request['id'];
    	$venta = Ventas::find($id);
        $venta->id_estado = 6;
        $venta->save();
    	return $venta;
    }
    #jgonzalez
    public function quitar_remisa(Request $request){
        $id = $request['id'];
        $venta = Ventas::find($id);
        $venta->id_estado = 11;
        $venta->save();
        return $venta;
    }
    public function fact_venta(Request $request){
        $id = $request->id;
        $num = Facturas::rightjoin('ventas', 'ventas.id', '=', 'facturas.id_venta')->select('facturas.id as num_fact', 'ventas.id as venta','ventas.factura', 'facturas.impresa', 'facturas.num_factura')->where( 'ventas.id', $id)->get();
     
        return $num;
    }
    public function num_factura(Request $request){
        $id = $request->id;
        $num = Facturas::where( 'num_factura', $id)->count();
     
        return $num;
    }
    #jgonzalez
    public function activar_venta(Request $request){

        /*$vent_ped= Ventas::join('detalle_pedidos', 'ventas.id_pedido', '=', 'detalle_pedidos.id_pedido')
                       ->join('productos', 'detalle_pedidos.id_producto', '=', 'productos.id')
                       ->where('ventas.id_estado',5)
                       ->where('fecha_activo', date("Y-m-d"))
                       ->where( 'productos.id', '<>', 36)
                       ->select('ventas.id',  'ventas.id_pedido', 'cantidad', 'detalle_pedidos.id_producto', 'productos.stock_activo', DB::raw('(CASE when cantidad>=stock_activo THEN 0 ELSE 1 END) as result'))
                       ->get();*/

        $row=Ventas::join('detalle_pedidos', 'ventas.id_pedido', '=', 'detalle_pedidos.id_pedido')
                       ->join('productos', 'detalle_pedidos.id_producto', '=', 'productos.id')
                       ->where('ventas.id_estado',5)
                       ->where('fecha_activo', date("Y-m-d"))
                       ->where( 'productos.id', '<>', 36)
                       ->select( 'ventas.id', 'ventas.id_pedido',   DB::raw(' COUNT(1) AS cantprod, SUM((CASE when cantidad<=stock_activo THEN 1 ELSE 0 END)) as result'))
                       ->groupBy('ventas.id_pedido')
                       ->get();


        foreach ($row as $item)
        {
        
         if($item->cantprod==$item->result)
            {
                $venta = Ventas::find($item->id);
                $venta->id_estado = 1;
                $venta->save();
            }
        
        }
      
        return $venta;
    }
    #jgonzalez
    public function asignar_remisa(Request $request){
        $id_empleado = $request['id_empleado'];
        $id_usuario = $request['id_usuario'];
        $total = $request['total'];
        $ventas = $request['ventas'];
      

        $remisa  = new Remitos;
        $remisa->id_delivery = $id_empleado;
        $remisa->id_usuario = $id_usuario;
        $remisa->importe = $total;
        $remisa->fecha = date("Y-m-d");
//      $venta->id_estado = 7;
        $remisa->id_estado = 6;
        $remisa->save();

        $datos=0;
        
        foreach ($ventas as $item) {

            if($item!==$datos){   
           
            $venta = Ventas::find($item);
//          $venta->id_estado = 7;
            //Cuando se asigna a delivery la venta queda confirmada en 7 y el remito en 6
            $venta->id_estado = 7;  
            $venta->save();

            $idpedido=pedido::join('ventas', 'pedidos.id', '=', 'ventas.id_pedido')
                          ->where('ventas.id',$item )
                         ->select('id_pedido')->first();
                 
            $pedido= pedido::find($idpedido->id_pedido);
            $pedido->id_estado = 7;  
            $pedido->save();

            $detremito  = new Detalle_remito;
            $detremito->id_remito = $remisa->id;
            $detremito->id_venta  = $item;
            $detremito->id_usuario= $id_usuario;
            $detremito->save();

            $datos=$item;

            }

        }

      

        return $remisa;
     
    }

    public function add_notas(Request $request){
  
        $notas  = new Notas_Ventas;
        $notas->id_venta   = $request->id_venta;
        $notas->nota       = $request->nota;
        $notas->nota       = ucwords(strtolower($request->nota));
        $notas->id_usuario = $request->id_usuario;
        $notas->save();

        return $notas;
     
    }

    public function search_notas(){
  
        $nota  =Notas_Ventas::join('users', 'notas_ventas.id_usuario', '=', 'users.id')
                            ->select(DB::raw('GROUP_CONCAT(nota SEPARATOR "~") as nota'), 'id_venta', 'name as nombre')
                            ->groupBy('id_venta', 'notas_ventas.id_usuario')
                            ->get();

         return response()->json($nota);
     
    }


    public function onoffhorario(Request $request){

        if($request->option=='false')
        {

              $horario  =Horarios::find($request->id);
              $horario->status_v = 0;
              $horario->save();
        }else{

              $horario  =Horarios::find($request->id);
              $horario->status_v = 1;
              $horario->save();

        }

        return $horario;
        
     
    }

}
