<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use DB;
use App\Ventas;
use App\Ciudades;
use App\Horarios;
use App\Empleados;

class LogisticaController extends Controller
{
    public function index(Request $request){
        #jgonzalez 2018/09/27 
        $fecha1 = $request["fecha1"];
        $fecha2 = $request["fecha2"];
        $id_ciudad = $request["id_ciudad"];
        $id_horario = $request["id_horario"];

        if($id_ciudad !="" && $id_horario !="" && $fecha1 != "" && $fecha2 != "" ){
            if(isset($fecha1) && isset($fecha2)){
                    if($fecha1 <> $fecha2 ){
                        if( $fecha1 < $fecha2){
                           $activas = Ventas::Activas()
                                    ->where('fecha', '>=', $fecha1)
                                    ->where('fecha', '<=', $fecha2)
                                    ->where('id_ciudad', '=', $id_ciudad)
                                    ->where('id_horario', '=', $id_horario); 
                        }else{
                            return redirect()->back()
                                ->with('messaje','Seleccione un rango de fecha 0000-00-01 al 0000-00-30 ');
                        }
                        
                    }elseif($fecha1 == $fecha2 ){
                        $activas = Ventas::Activas()
                                    ->where('fecha', '=', $fecha1)
                                    ->where('id_ciudad', '=', $id_ciudad)
                                    ->where('id_horario', '=', $id_horario);
                    }
            }


        }elseif($id_ciudad =="" && $id_horario !="" && $fecha1 != "" && $fecha2 != "" ){
            if(isset($fecha1) && isset($fecha2)){
                    if($fecha1 <> $fecha2 ){
                        if( $fecha1 < $fecha2){
                           $activas = Ventas::Activas()
                                    ->where('fecha', '>=', $fecha1)
                                    ->where('fecha', '<=', $fecha2)
                                    ->where('id_horario', '=', $id_horario); 
                        }else{
                            return redirect()->back()
                                ->with('messaje','Seleccione un rango de fecha 0000-00-01 al 0000-00-30 ');
                        }
                        
                    }elseif($fecha1 == $fecha2 ){
                        $activas = Ventas::Activas()
                                    ->where('fecha', '=', $fecha1)
                                    ->where('id_horario', '=', $id_horario);
                    }
            }  
        }elseif($id_ciudad !="" && $id_horario =="" && $fecha1 != "" && $fecha2 != "" ){
            if(isset($fecha1) && isset($fecha2)){
                    if($fecha1 <> $fecha2 ){
                        if( $fecha1 < $fecha2){
                           $activas = Ventas::Activas()
                                    ->where('fecha', '>=', $fecha1)
                                    ->where('fecha', '<=', $fecha2)
                                    ->where('id_ciudad', '=', $id_ciudad); 
                        }else{
                            return redirect()->back()
                                ->with('messaje','Seleccione un rango de fecha 0000-00-01 al 0000-00-30 ');
                        }
                        
                    }elseif($fecha1 == $fecha2 ){
                        $activas = Ventas::Activas()
                                    ->where('fecha', '=', $fecha1)
                                    ->where('id_ciudad', '=', $id_ciudad);
                    }
            } 
        }elseif($id_ciudad =="" && $id_horario !=""){
            $activas = Ventas::Activas()
                        ->where('fecha', '=', date("Y-m-d"))
                        ->where('id_horario', '=', $id_horario);
            #dd($request->all());
        }elseif($id_ciudad !="" && $id_horario ==""){
            $activas = Ventas::Activas()
                        ->where('fecha', '=', date("Y-m-d"))
                        ->where('id_ciudad', '=', $id_ciudad);
            #dd($activas);
        }elseif($id_ciudad != "" && $id_horario != ""){
            $activas = Ventas::Activas()
                        ->where('fecha', '=', date("Y-m-d"))
                        ->where('id_ciudad', '=', $id_ciudad)
                        ->where('id_horario', '=', $id_horario);
            #dd($activas);
        }elseif($fecha1 != "" || $fecha2 != "" ){
            if(isset($fecha1) && isset($fecha2)){
                    if($fecha1 <> $fecha2 ){
                        if( $fecha1 < $fecha2){
                           $activas = Ventas::Activas()
                                    ->where('fecha', '>=', $fecha1)
                                    ->where('fecha', '<=', $fecha2); 
                        }else{
                            return redirect()->back()
                                ->with('messaje','Seleccione un rango de fecha 0000-00-01 al 0000-00-30 ');
                        }
                        
                    }elseif($fecha1 == $fecha2 ){
                        $activas = Ventas::Activas()
                                    ->where('fecha', '=', $fecha1);
                    }
            }elseif(isset($fecha1)){
                    $activas = Ventas::Activas()->where('fecha', '=', $fecha1);
            }elseif(isset($fecha2)){
                    $activas = Ventas::Activas()->where('fecha', '=', $fecha2);
            }
            #dd($activas);
        }else{
            $activas = Ventas::Activas()->where('fecha', '=', date("Y-m-d"));
        }

        $enEsperas = Ventas::EnEspera();
        $remisas = Ventas::Remisas();
        $ciudades = Ciudades::get();
        $horarios = Horarios::get();
        return view('Procesar.Logistica.index', compact('activas','enEsperas','remisas', 'ciudades', 'horarios'));
    	
    }
    public function edit(){
    	return view('Procesar.Logistica.edit');
    }
    public function remisa(){
        #jgonzalez 2018/09/27
        $remisas = Ventas::DetalleRemisa();
        $repartidores = Empleados::where('id_cargo', 4)->get();
        return view('Procesar.Logistica.remisa', compact('remisas', 'repartidores'));
    }


     public function factura(Request $request){

        $venta=Ventas::join('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
                    ->join('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
                    ->join('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
                    ->join('horarios', 'ventas.id_horario', '=', 'horarios.id')
                    ->join('forma_pago', 'ventas.id_forma_pago', '=', 'forma_pago.id')
                    ->join('facturas', 'ventas.id', '=', 'facturas.id_venta')
                    ->join('detalle_ventas', 'detalle_ventas.id_venta', '=','ventas.id')
                    ->join('productos', 'detalle_ventas.id_producto', '=','productos.id')
                    ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'forma_pago.forma_pago', 'ventas.factura', 'horarios.horario', 'ventas.fecha', 'ventas.fecha_activo', 'ventas.notas', 'ventas.id_estado', 'ventas.status_v','pedidos.id_cliente', 'facturas.nombres',  'facturas.ruc_ci', 'clientes.telefono', 'facturas.direccion', 'ciudades.ciudad','detalle_ventas.cantidad', 'detalle_ventas.precio', 'productos.nombre_original', 'productos.descripcion')
                    ->where('ventas.id', '=', $request->num_fact)
                    ->get();
        $factura=Ventas::join('detalle_ventas', 'detalle_ventas.id_venta', '=','ventas.id')
                         ->join('productos', 'detalle_ventas.id_producto', '=','productos.id')
                         ->select('detalle_ventas.cantidad', 'detalle_ventas.precio', 'productos.nombre_original', 'productos.descripcion')
                         ->where('ventas.id', '=', $request->num_fact)
                         ->get();


        $pdf = PDF::loadView('Procesar.Logistica.factura', compact('venta', 'factura'));
        return $pdf->download('Factura_'.$request->num_fact.'.pdf');
      
      
    }

}
