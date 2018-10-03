<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use NumerosEnLetras;
use PDF;
use DB;
use App\Detalle_Ventas;
use App\Ventas;
use App\Ciudades;
use App\Horarios;
use App\Empleados;

class LogisticaController extends Controller
{
    public function index(Request $request){
        #jgonzalez 2018/09/27 
        $hora = strtotime(date("H:m"));
        #06:00
        if ($hora >= 1538546400) {
            $id_hora = array();
        }
        #09:00
        if ($hora > 1538557200) {
            $id_hora = array(4);
        }
        #12:00
        if ($hora > 1538568000) {
            $id_hora = array(1,4);
        }
        #15:00
        if ($hora > 1538578800) {
            $id_hora = array(1,4,5);
        }
        #18:00
        if ($hora > 1538589600) {
            $id_hora = array(1,2,4,5,6);     
        }
        #21:00
        if ($hora > 1538600400) {
            $id_hora = array(1,2,4,5,6,7);
        }
        
        $fecha1 = $request["fecha1"];
        $fecha2 = $request["fecha2"];
        $id_ciudad = $request["id_ciudad"];
        $id_horario = $request["id_horario"];

        #ciudad, horario, fecha1 y fecha2
        if($id_ciudad !="" && $id_horario !="" && $fecha1 != "" && $fecha2 != "" ){
            if($fecha1 <> $fecha2 ){
                if( $fecha1 < $fecha2){
                    $enEsperas = Ventas::EnEspera()->where('fecha', '>=', $fecha1)
                                        ->where('fecha', '<=', $fecha2)
                                        ->where('id_ciudad', '=', $id_ciudad)
                                        ->where('id_horario', '=', $id_horario);
                }else{
                    return redirect()->back()->with('messaje','Seleccione un rango de fecha 0000-00-01 al 0000-00-30 ');
                }
                        
            }elseif($fecha1 == $fecha2 ){
                $enEsperas = Ventas::EnEspera()->where('fecha', '=', $fecha1)
                                    ->where('id_ciudad', '=', $id_ciudad)
                                    ->where('id_horario', '=', $id_horario);
            }
        #horario, fecha1 y fecha2
        }elseif($id_ciudad =="" && $id_horario !="" && $fecha1 != "" && $fecha2 != "" ){
            if($fecha1 <> $fecha2 ){
                if( $fecha1 < $fecha2){
                    $enEsperas = Ventas::EnEspera()->where('fecha', '>=', $fecha1)
                                       ->where('fecha', '<=', $fecha2)
                                        ->where('id_horario', '=', $id_horario);
                }else{
                    return redirect()->back()->with('messaje','Seleccione un rango de fecha 0000-00-01 al 0000-00-30 ');
                }
                        
            }elseif($fecha1 == $fecha2 ){
                        $enEsperas = Ventas::EnEspera()->where('fecha', '=', $fecha1)
                                           ->where('id_horario', '=', $id_horario);
            } 
        #ciudad, fecha1 y fecha2
        }elseif($id_ciudad !="" && $id_horario =="" && $fecha1 != "" && $fecha2 != "" ){
            if($fecha1 <> $fecha2 ){
                if( $fecha1 < $fecha2){
                    $enEsperas = Ventas::EnEspera()->where('fecha', '>=', $fecha1)
                                         ->where('fecha', '<=', $fecha2)->where('id_ciudad', '=', $id_ciudad);
                }else{
                    return redirect()->back()->with('messaje','Seleccione un rango de fecha 0000-00-01 al 0000-00-30 ');
                }
            }elseif($fecha1 == $fecha2 ){
                $enEsperas = Ventas::EnEspera()->where('fecha', '=', $fecha1)->where('id_ciudad', '=', $id_ciudad);
            }   
        #fecha1 y fecha2
        }elseif($id_ciudad =="" && $id_horario =="" && $fecha1 !="" && $fecha2 !=""){
            if($fecha1 <> $fecha2 ){
                if( $fecha1 < $fecha2){
                    $enEsperas = Ventas::EnEspera()->where('fecha', '>=', $fecha1)
                                         ->where('fecha', '<=', $fecha2);
                }else{
                    return redirect()->back()->with('messaje','Seleccione un rango de fecha 0000-00-01 al 0000-00-30 ');
                }
            }elseif($fecha1 == $fecha2 ){
                $enEsperas = Ventas::EnEspera()->where('fecha', '=', $fecha1);
            }
        #horario
        }elseif($id_ciudad =="" && $id_horario !="" && $fecha1=="" && $fecha2==""){
            $enEsperas = Ventas::EnEspera()->where('id_horario', '=', $id_horario);
        #ciudad
        }elseif($id_ciudad !="" && $id_horario =="" && $fecha1=="" && $fecha2==""){
            $enEsperas = Ventas::EnEspera()->where('id_ciudad', '=', $id_ciudad);
        #ciudad y horario
        }elseif($id_ciudad != "" && $id_horario != "" && $fecha1=="" && $fecha2==""){
           $enEsperas = Ventas::EnEspera()->where('id_ciudad', '=', $id_ciudad)->where('id_horario', '=', $id_horario);
        #sin
        }else{ 
            $enEsperas = Ventas::EnEspera();
        }
        $xatender = Ventas::Activas()->where('fecha', '=', "2018-10-02")->whereIn('id_horario', $id_hora);
        $activas = Ventas::Activas()->where('fecha', '=', "2018-10-02")->whereNotIn('id_horario', $id_hora);
        $remisas = Ventas::Remisas();
        $ciudades = Ciudades::get();
        $horarios = Horarios::get();
        return view('Procesar.Logistica.index', compact('activas','xatender', 'enEsperas','remisas', 'ciudades', 'horarios'));
    	
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
                    ->join('forma_pago', 'ventas.id_forma_pago', '=', 'forma_pago.id')
                    ->join('facturas', 'ventas.id', '=', 'facturas.id_venta')
                    ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'forma_pago.forma_pago', 'ventas.factura',  'ventas.fecha', 'ventas.notas',  'facturas.nombres',  'facturas.ruc_ci', 'clientes.telefono', 'facturas.direccion')
                    ->where('ventas.id', '=', $request->id_venta)
                    ->get();
        $factura=Detalle_Ventas::join('productos', 'detalle_ventas.id_producto', '=','productos.id')
                         ->select('detalle_ventas.cantidad', 'detalle_ventas.precio', 'productos.nombre_original', 'productos.descripcion')
                         ->where('detalle_ventas.id_venta', '=', $request->id_venta)
                         ->get();


        $pdf = PDF::loadView('Procesar.Logistica.factura', compact('venta', 'factura' ));
        return $pdf->download('Factura_'.$request->num_fact.'.pdf');
      
      
    }

}
