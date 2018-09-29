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
    public function num_factura(Request $request){
        $id = $request->id;
        $num = Facturas::select('id')->where('id_venta', $id)->get();
     
        return $num;
    }
    #jgonzalez
    public function filtro_ciudad(Request $request){
        $id_ciudad = $request['id'];
        $ventas = Ventas::FiltroCiudad($id_ciudad);
        return $ventas;
    }
    #jgonzalez
    public function filtro_horario(Request $request){
        $id_horario = $request['id'];
        $ventas = Ventas::FiltroHorario($id_horario);
        return $ventas;
    }

}
