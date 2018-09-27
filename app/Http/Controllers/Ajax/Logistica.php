<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $venta->id_estado = 5;
        $venta->save();
        return $venta;
    }

}
