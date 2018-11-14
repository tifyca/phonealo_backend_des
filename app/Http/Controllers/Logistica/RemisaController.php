<?php

namespace App\Http\Controllers\Logistica;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empleados;
use App\Ventas;
use App\Remisa;
use App\Remitos;
use App\Detalle_remito;

class RemisaController extends Controller
{
    public function remisa(){
    	$empleados = Empleados::where('id_cargo', 4)->get();
    	$ventas = Ventas::where('id_estado',6)->get();
        $ventasAsignadas = Ventas::whereIn('id_estado', [13,7])->get();
    	$remisa = Remisa::all();

    	return view('Logistica.remisa')->with('empleados', $empleados)->with('ventas', $ventas)->with('remisa', $remisa)->with('ventasAsignadas', $ventasAsignadas);
    }

     public function remisa0(){

        $data['ventas'] = Ventas::where('id_estado', 6)->get();

        $data['empleados'] = Empleados::where('id_cargo', 4)->get();

        return $data;
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

    public function destroyRemisa(Request $request){

        $venta_id = $request['venta_id'];
        
        $cambiaStadoVenta = Ventas::where('id',$venta_id)->update(['id_estado'=> 11]);

        return $cambiaStadoVenta;

    }

    public function saveRemito(Request $request){

        $id_delivery = $request['id_delivery'];
        $importe = $request['suma'];

        $ventas = $request['ventas'];
        $montos = $request['montos'];
        
        $saveRemito = new Remitos;
        $saveRemito->id_delivery = $id_delivery;
        $saveRemito->importe = $importe;
        $saveRemito->id_estado = 6;
        $saveRemito->fecha = date("Y-m-d");
        $saveRemito->save();

        $ultimo = Remitos::pluck('id');
        $ultimoRegistro = $ultimo->last();

        foreach($ventas as $venta){

            $saveRemito = Ventas::where('id',$venta)->update(['id_estado'=> 7]);
            //dejo el registro en la tarjeta? porque ya no es 6
            
            $detremito  = new Detalle_remito;
            $detremito->id_remito = $ultimoRegistro;
            $detremito->id_venta  = $venta;
            //$detremito->id_usuario= $id_usuario;
            $detremito->id_estado = 1;
            $detremito->save();
        }


       

        return $saveRemito;



    }
}
