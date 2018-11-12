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
    	$remisa = Remisa::all();
    	return view('Logistica.remisa')->with('empleados', $empleados)->with('ventas', $ventas)->with('remisa', $remisa);
    }

    public function saveRemisa(Request $request){
    	$empleado_id=$request['empleado_id'];
    	$venta_id=$request['venta_id'];


    	if ($empleado_id == 0) {
    		
    		$guardaRemisa = Remisa::where('id_venta', $venta_id)->delete();

    	}else{

    		$consultaRemisa = Remisa::where('id_venta',$venta_id)->delete();

			$guardaRemisa = new Remisa();
			$guardaRemisa->id_venta = $venta_id;
			$guardaRemisa->id_delivery = $empleado_id;
			$guardaRemisa->save();
    		

    		
    	}

    	

    	return $guardaRemisa;
    }
}
