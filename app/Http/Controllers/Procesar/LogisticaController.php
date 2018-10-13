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
use App\Facturas;
use Illuminate\Support\Facades\Validator;

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
            $remito = Remitos::leftjoin('detalle_remito', 'detalle_remito.id_remito', '=', 'remitos.id')
                    ->leftjoin('ventas', 'detalle_remito.id_venta', '=', 'ventas.id')
                    ->leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
                    ->leftjoin('detalle_pedidos', 'detalle_pedidos.id_pedido', '=', 'ventas.id_pedido')
                    ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
                    ->leftjoin('productos', 'detalle_pedidos.id_producto', '=', 'productos.id')
                    ->leftjoin('users', 'pedidos.id_usuario', '=', 'users.id')
                    ->select('remitos.id as idremito', 'remitos.id_delivery', 'ventas.id_pedido',  'clientes.barrio', 'productos.nombre_original', 'productos.descripcion', 'users.name as usuario', 'detalle_pedidos.cantidad',
                        DB::raw('(detalle_pedidos.cantidad*detalle_pedidos.precio) as importe'))
                    ->where('remitos.id', $id_remisa)
                    ->groupBy('remitos.id', 'remitos.id_delivery', 'ventas.id_pedido',  'clientes.barrio', 'productos.nombre_original', 'productos.descripcion', 'users.name', 'detalle_pedidos.cantidad')
                    ->get();
              

            $empleado = Empleados::join('remitos', 'remitos.id_delivery', '=', 'empleados.id')
                                  ->leftjoin('detalle_remito', 'detalle_remito.id_remito', '=', 'remitos.id')
                                  ->leftjoin('ventas', 'detalle_remito.id_venta', '=', 'ventas.id')
                                  ->leftjoin('horarios', 'ventas.id_horario', '=', 'horarios.id')
                                  ->select('empleados.id', 'empleados.nombres', 'horarios.horario')
                                  ->where('remitos.id', $id_remisa)
                                  ->first();
            $vista="Procesar.Logistica.recibo_remisa";
            
        

         return $this->crearPDF($remito, $vista, $empleado, $id_remisa );

        }
        return view('Procesar.Logistica.index', compact('activas','xatender', 'enEsperas','remisas', 'ciudades', 'horarios'));
    	
    }
    public function CrearPDF ($remito, $vista, $empleado, $id_remisa ){

        $remito = $remito;
        $empleado=$empleado;
        $fecha = date('d-m-Y');
        $view =  \View::make($vista, compact('remito','empleado', 'fecha'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('recibo_remisa'.$id_remisa);


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
       
    

        $venta=Ventas::leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
                    ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
                    ->leftjoin('forma_pago', 'ventas.id_forma_pago', '=', 'forma_pago.id')
                    ->leftjoin('facturas', 'ventas.id', '=', 'facturas.id_venta')
                    ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'forma_pago.forma_pago', 'ventas.factura',  'ventas.fecha', 'ventas.notas', 'facturas.id', 'facturas.nombres',  'facturas.ruc_ci', 'clientes.telefono', 'facturas.direccion')
                    ->where('ventas.id', '=', $request->id_ventaf)
                    ->get();
        $factura=Detalle_Ventas::leftjoin('productos', 'detalle_ventas.id_producto', '=','productos.id')
                         ->select('detalle_ventas.cantidad', 'detalle_ventas.precio', 'productos.nombre_original', 'productos.descripcion')
                         ->where('detalle_ventas.id_venta', '=', $request->id_ventaf)
                         ->get();


        $impresion=Facturas::where('id_venta',$request->id_ventaf)
                  ->update(array('num_factura' => $request->num_fact, 'impresa'=> 1, 'id_usuario'=>$request->id_usuario));


       
         $fecha = Carbon::now();
         $date = $fecha->formatLocalized('%d %B %Y');


        $view =  \View::make('Procesar.Logistica.factura', compact('venta', 'factura', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        if( $request->tipo==1){return $pdf->stream('Factura_'.$request->id_venta.'.pdf');}
    
        if( $request->tipo==2){return $pdf->download('Factura_'.$request->id_venta.'.pdf');} 
      
      
    }

     public function movimiento(Request $request){

        $venta=Ventas::leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
                    ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
                    ->leftjoin('forma_pago', 'ventas.id_forma_pago', '=', 'forma_pago.id')
                    ->leftjoin('facturas', 'ventas.id', '=', 'facturas.id_venta')
                    ->leftjoin('horarios', 'ventas.id_horario', '=', 'horarios.id')
                    ->leftjoin('users', 'ventas.id_usuario', '=', 'users.id')
                    ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'forma_pago.forma_pago', 'horarios.horario', 'clientes.barrio', 'ventas.fecha_activo', 'ventas.factura',  'ventas.fecha', 'ventas.notas',  'clientes.nombres',  'clientes.ruc_ci', 'clientes.telefono', 'clientes.direccion', 'users.name' )
                    ->where('ventas.id', '=', $request->id_ventam)
                    ->get();
        $factura=Detalle_Ventas::join('productos', 'detalle_ventas.id_producto', '=','productos.id')
                         ->select('detalle_ventas.cantidad', 'detalle_ventas.precio', 'productos.nombre_original', 'productos.codigo_producto', 'productos.descripcion')
                         ->where('detalle_ventas.id_venta', '=', $request->id_ventam)
                         ->get();

       
         $fecha = Carbon::parse($venta[0]->fecha_activo)->format('d/m/Y');
        

        $view =  \View::make('Procesar.Logistica.movimiento', compact('venta', 'factura', 'fecha'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        if( $request->tipo==1){return $pdf->stream('Movimiento_'.$request->id_ventam.'.pdf');}
    
        if( $request->tipo==2){return $pdf->download('Movimiento_'.$request->id_ventam.'.pdf');}

      
    }

     public function recibo(Request $request){

        $venta=Ventas::leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
                    ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
                    ->leftjoin('forma_pago', 'ventas.id_forma_pago', '=', 'forma_pago.id')
                    ->leftjoin('facturas', 'ventas.id', '=', 'facturas.id_venta')
                    ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'forma_pago.forma_pago',  'ventas.factura',  'ventas.fecha', 'ventas.notas',  'facturas.nombres',  'facturas.ruc_ci', 'clientes.telefono', 'facturas.direccion')
                    ->where('ventas.id', '=', $request->id_ventar)
                    ->get();
        $factura=Detalle_Ventas::leftjoin('productos', 'detalle_ventas.id_producto', '=','productos.id')
                         ->select('detalle_ventas.cantidad', 'detalle_ventas.precio', 'productos.nombre_original', 'productos.descripcion')
                         ->where('detalle_ventas.id_venta', '=', $request->id_ventar)
                         ->get();

        
        $fecha = Carbon::now();
        $dated = $fecha->formatLocalized("%d");
        $datem = $fecha->formatLocalized("%B");    
        $datea = $fecha->formatLocalized("%y");                                                   
        
            
        $view =  \View::make('Procesar.Logistica.recibo', compact('venta', 'factura', 'dated', 'datem', 'datea'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        if( $request->tipo==1){return $pdf->stream('Recibo_'.$request->id_ventar.'.pdf');}
    
        if( $request->tipo==2){return $pdf->download('Recibo_'.$request->id_ventar.'.pdf');}
       
      
      
    }

    public function edithorario(Request $request){
        
        $horarioventa = Ventas::find($request->id_venta);
        $horarioventa->id_horario = $request->horario;
        $horarioventa->id_usuario = $request->id_usuario;
        $horarioventa->save();

        return $horarioventa;
        
    }


}
