<?php

namespace App\Http\Controllers\Logistica;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empleados;
use App\Ventas;
use App\Remisa;

class RemisaController extends Controller
{
    public function remisa(){
    	$empleados = Empleados::where('id_cargo', 4)->get();
    	$ventas = Ventas::where('id_estado', 6)->get();
        $ventasAsignadas = Ventas::where('id_estado', 13)->get();
    	$remisa = Remisa::all();
    	return view('Logistica.remisa')->with('empleados', $empleados)->with('ventas', $ventas)->with('remisa', $remisa)->with('ventasAsignadas', $ventasAsignadas);
    }

     public function remisa0(){

        $ventas = Ventas::where('id_estado', 6)->get();
        return view('Logistica.remisa.ventas6')->with('ventas', $ventas);
    }

    public function saveRemisa(Request $request){
    	$empleado_id=$request['empleado_id'];
    	$venta_id=$request['venta_id'];


    	if ($empleado_id == 0) {
    		
    		$guardaRemisa = Remisa::where('id_venta', $venta_id)->delete();
            $cambiaStadoVenta = Ventas::where('id',$venta_id)->update(['id_estado'=> 6]);

    	}else{

    		$consultaRemisa = Remisa::where('id_venta',$venta_id)->delete();

            $cambiaStadoVenta = Ventas::where('id', $venta_id)->update(['id_estado'=> 13]);

			$guardaRemisa = new Remisa();
			$guardaRemisa->id_venta = $venta_id;
			$guardaRemisa->id_delivery = $empleado_id;
			$guardaRemisa->save();
    		
    	}

    	

    	return $guardaRemisa;
    }
}
