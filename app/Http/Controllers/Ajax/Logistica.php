<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facturas;
use App\Ventas;
use App\Remitos;

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
    public function num_factura(Request $request){
        $id = $request->id;
        $num = Facturas::select('id', 'id_venta')->where('id_venta', $id)->get();
     
        return $num;
    }
    #jgonzalez
    public function activar_venta(Request $request){
        $id = $request['id'];
        $venta = Ventas::find($id);
        $venta->id_estado = 11;
        $venta->save();
        return $venta;
    }
    #jgonzalez
    public function asignar_remisa(Request $request){
        $id_empleado = $request['id_empleado'];
        $id_usuario = $request['id_usuario'];
        $total = $request['total'];
        $ventas = $request['ventas'];
        foreach ($ventas as $id) {
            $venta = Ventas::find($id);
            $venta->id_estado = 7;
            $venta->save();
        }
        $remisa  = new Remitos;
        $remisa->id_delivery = $id_empleado;
        $remisa->id_usuario = $id_usuario;
        $remisa->importe = $total;
        $remisa->fecha = date("Y-m-d");
        $remisa->id_estado = 7;
        $remisa->save();
        return $remisa;  
    }


}
