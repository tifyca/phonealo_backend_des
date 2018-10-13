<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facturas;
use App\Ventas;
use App\Remitos;
use App\Detalle_remito;

class Logistica extends Controller
{
    #jgonzalez
   	public function detalle_venta(Request $request){
    	$id = $request['id'];
    	$venta = Ventas::Detalle($id);
    	return $venta;
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
  /*  public function activar_venta(Request $request){
        $id = $request['id'];
        $venta = Ventas::find($id);
        $venta->id_estado = 11;
        $venta->save();
        return $venta;
    }*/
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
        $remisa->id_estado = 7;
        $remisa->save();
        
        foreach ($ventas as $item) {
            
            $venta = Ventas::find($item);
            $venta->id_estado = 7;
            $venta->save();

            $detremito  = new Detalle_remito;
            $detremito->id_remito = $remisa->id;
            $detremito->id_venta  = $item;
            $detremito->id_usuario= $id_usuario;
            $detremito->save();
        }

        return $remisa;
     
    }


}
