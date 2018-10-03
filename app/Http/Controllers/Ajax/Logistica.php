<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facturas;
use App\Ventas;
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

}
