<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use PDF;
use DB;
use App\Detalle_Ventas;
use App\Ventas;
use App\Ciudades;
use App\Horarios;
use App\Empleados;
use App\Remitos;

class LogisticaController extends Controller
{
    public function index(Request $request){
        #jgonzalez 2018/09/27 
        #Con estos IF se genera variable $id_fecha que permite cambiar las ventas entre los listados "Listado" y "Ventas por Atender" de forma automatica segun el valor del campo venta.id_horario
        $hora = strtotime(date("H:m"));
        $fecha = date("Y-m-d");
        #06:00
        if ($hora >= 1538546400 || $hora < 1538546400 ) {
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
        ###################################################################
        $fecha1 = $request["fecha1"];
        $fecha2 = $request["fecha2"];
        $id_ciudad = $request["id_ciudad"];
        $id_horario = $request["id_horario"];

        #FILTROS CIUDAD, HORARIO, FECHA1 Y FECHA2
        #TODOS LOS CAMPOS ACTIVOS
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
        #ACTIVOS: HORARIOS, FECHA1 Y FECHA2
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
        #ACTIVOS CIUDAD, FECHA1 Y FECHA2
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
        #ACTIVOS FECHA1 Y FECHA2
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
        #ACTIVO HORARIO
        }elseif($id_ciudad =="" && $id_horario !="" && $fecha1=="" && $fecha2==""){
            $enEsperas = Ventas::EnEspera()->where('id_horario', '=', $id_horario);
            
        #ACTIVO CIUDAD
        }elseif($id_ciudad !="" && $id_horario =="" && $fecha1=="" && $fecha2==""){
            $enEsperas = Ventas::EnEspera()->where('id_ciudad', '=', $id_ciudad);
            
        #ACTIVOS CIUDAD Y HORARIO
        }elseif($id_ciudad != "" && $id_horario != "" && $fecha1=="" && $fecha2==""){
           $enEsperas = Ventas::EnEspera()->where('id_ciudad', '=', $id_ciudad)->where('id_horario', '=', $id_horario);

        #TODOS LOS FILTROS VACIOS
        /*LOS FILTROS SOLO APLICAN SOBRE LAS VENTAS EN ESPERA, YA QUE:
            *LISTADO
            *VENTAS POR ATENDER
            *REMISA
        DEBEN MOSTRAR LAS VENTAS DEL DIA*/
        }else{ 
            $enEsperas = Ventas::EnEspera();
            
        }
        $xatender = Ventas::Activas()->where('fecha', '=', $fecha)->whereIn('id_horario', $id_hora);
        $activas = Ventas::Activas()->where('fecha', '=', $fecha)->whereNotIn('id_horario', $id_hora);
        $remisas = Ventas::Remisas();
        $ciudades = Ciudades::get();
        $horarios = Horarios::get();
        if($request["id_remisa"]){
            $id_remisa = $request["id_remisa"];
            $remito = Remitos::find($id_remisa);
            $empleado = Empleados::find($remito->id_delivery);
            #dd($empleado);
            #no existe relacion entre entidad remito y entidad venta, en el sistema anterior existe como "detalle_remito", sin esta relacion no se puede hacer la consulta para generar el detalle de producto dejo la intruccion para que se vea la prueba sobre la vista y comentado el codigo que debe generar el pdf
            return view('Procesar.Logistica.recibo_remisa', compact('remito', 'empleado'));
            //$pdf = PDF::loadView('Procesar.Logistica.recibo_remisa');
            //$pdf->download('recibo_remisa'.$id_remisa.'.pdf');
        }
        return view('Procesar.Logistica.index', compact('activas','xatender', 'enEsperas','remisas', 'ciudades', 'horarios'));
    	
    }
    public function edit(){
    	return view('Procesar.Logistica.edit');
    }
    public function remisa(){
        #jgonzalez 2018/09/27
        $remisas = Ventas::DetalleRemisa();
        $repartidores = Empleados::where('id_cargo', 4)->get();
        return view('Procesar.Logistica.remisa', compact( 'remisas', 'repartidores'));
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

        
         $fecha = Carbon::now();
         $date = $fecha->formatLocalized('%d %B %Y');
        
        $pdf = PDF::loadView('Procesar.Logistica.factura', compact('venta', 'factura', 'date'));
        return $pdf->download('Factura_'.$request->num_fact.'.pdf');
      
      
    }


}
