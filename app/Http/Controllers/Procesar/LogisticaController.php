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
use App\Notas_Ventas;


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
        $id_horario = $request["id_horario"];
        $buscador = $request["buscador"];


        if( $id_horario !="" ){
        $enEsperas = Ventas::EnEspera()->where('id_horario', '=', $id_horario);
        $xatender = Ventas::Activas()->where('id_horario', '=', $id_horario);
        $activas = Ventas::Activas()->where('id_horario', '=', $id_horario);
        $remisas = Ventas::Remisas()->where('id_horario', '=', $id_horario);
        $class=1;
        $busca=0;
              
        }elseif($buscador!=""){

        $enEsperas = Ventas::leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
                            ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
                            ->leftjoin('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
                            ->leftjoin('horarios', 'ventas.id_horario', '=', 'horarios.id')
                            ->leftjoin('forma_pago', 'ventas.id_forma_pago', '=', 'forma_pago.id')
                            ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido','ventas.id_horario', 'ventas.factura', 'forma_pago.forma_pago', 'horarios.horario', 'ventas.fecha', 'ventas.fecha_activo', 'ventas.notas', 'ventas.id_estado', 'ventas.status_v','pedidos.id_cliente', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'clientes.id_ciudad','ciudades.ciudad')
                            ->where(function ($q) {
                                    $q->where('ventas.id_estado', '=', '5')
                                      ->orWhere('ventas.id_estado', '=', '12');
                            })->Where(function($q) use ($buscador) {
                                    $q->where('ciudades.ciudad', 'like', $buscador.'%')
                                          ->orWhere('clientes.nombres', 'like', $buscador.'%')
                                          ->orWhere('clientes.telefono', '=', $buscador)
                                          ->orWhere('horarios.horario', '=', $buscador);

                                    })->orderby( 'ventas.id_horario', 'desc')
                                      ->get();
        
        $xatender = Ventas::leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
                            ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
                            ->leftjoin('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
                            ->leftjoin('horarios', 'ventas.id_horario', '=', 'horarios.id')
                            ->leftjoin('forma_pago', 'ventas.id_forma_pago', '=', 'forma_pago.id')
                            ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido','ventas.id_horario', 'ventas.factura', 'forma_pago.forma_pago', 'horarios.horario', 'ventas.fecha', 'ventas.fecha_activo', 'ventas.notas', 'ventas.id_estado', 'ventas.status_v','pedidos.id_cliente', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'clientes.id_ciudad','ciudades.ciudad')
                            ->where(function ($q) {
                                    $q->where('ventas.id_estado', '=', '1')
                                      ->orWhere('ventas.id_estado', '=', '11');
                            })->Where(function($q) use ($buscador) {
                                    $q->where('ciudades.ciudad', 'like', $buscador.'%')
                                          ->orWhere('clientes.nombres', 'like', $buscador.'%')
                                          ->orWhere('clientes.telefono', '=', $buscador)
                                          ->orWhere('horarios.horario', '=', $buscador);

                                    })->orderby( 'ventas.id_horario', 'desc')
                                      ->get();
        
        $activas = Ventas::leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
                            ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
                            ->leftjoin('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
                            ->leftjoin('horarios', 'ventas.id_horario', '=', 'horarios.id')
                            ->leftjoin('forma_pago', 'ventas.id_forma_pago', '=', 'forma_pago.id')
                            ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido','ventas.id_horario', 'ventas.factura', 'forma_pago.forma_pago', 'horarios.horario', 'ventas.fecha', 'ventas.fecha_activo', 'ventas.notas', 'ventas.id_estado', 'ventas.status_v','pedidos.id_cliente', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'clientes.id_ciudad','ciudades.ciudad')
                            ->where(function ($q) {
                                    $q->where('ventas.id_estado', '=', '1')
                                      ->orWhere('ventas.id_estado', '=', '11');
                            })->Where(function($q )use ($buscador){
                                    $q->where('ciudades.ciudad', 'like', $buscador.'%')
                                          ->orWhere('clientes.nombres', 'like', $buscador.'%')
                                          ->orWhere('clientes.telefono', '=', $buscador)
                                          ->orWhere('horarios.horario', '=', $buscador);

                                    })->orderby( 'ventas.id_horario', 'desc')
                                      ->get();

        $remisas = Ventas::leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
                            ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
                            ->leftjoin('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
                            ->leftjoin('horarios', 'ventas.id_horario', '=', 'horarios.id')
                            ->leftjoin('forma_pago', 'ventas.id_forma_pago', '=', 'forma_pago.id')
                            ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'forma_pago.forma_pago', 'ventas.factura', 'horarios.horario', 'ventas.fecha', 'ventas.fecha_activo', 'ventas.notas', 'ventas.id_estado', 'ventas.status_v','pedidos.id_cliente', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'ciudades.ciudad')
                            ->where(function ($q) {
                                    $q->where('ventas.id_estado', '=', '6');
                            })->Where(function($q ) use ($buscador) {
                                    $q->where('ciudades.ciudad', 'like', $buscador.'%')
                                          ->orWhere('clientes.nombres', 'like', $buscador.'%')
                                          ->orWhere('clientes.telefono', '=', $buscador)
                                          ->orWhere('horarios.horario', '=', $buscador);

                                    })->orderby( 'ventas.id_horario', 'desc')
                                      ->get();

       $class=1;
       $busca=1;

        }else{ 
        $enEsperas = Ventas::EnEspera();
        $xatender = Ventas::Activas()->whereIn('id_horario', $id_hora);
        $activas = Ventas::Activas()->where('fecha', '=', $fecha)->whereNotIn('id_horario', $id_hora);
        $remisas = Ventas::Remisas();
        $class=0;
        $busca=0;
        }


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
        $nota  =Notas_Ventas::join('users', 'notas_ventas.id_usuario', '=', 'users.id')
                            ->select('nota', 'id_venta', 'name as nombre', 'notas_ventas.created_at as fecha')
                            ->groupBy('id_venta', 'notas_ventas.id_usuario', 'notas_ventas.created_at')
                            ->orderBy('id_venta')
                            ->get();
 

        $notaventa= Notas_Ventas::join('ventas', 'notas_ventas.id_venta', '=', 'ventas.id')
                                ->select('notas_ventas.id_venta')->get();

    
       $totalhorario= DB::select( DB::raw('select `horarios`.`id`, `horarios`.`status_v`, COUNT(*) as total from `horarios` inner join `ventas` on `horarios`.`id` = `ventas`.`id_horario` where `ventas`.`fecha` = "'.date('Y-m-d').'" group by `id_horario` union (select `horarios`.`id`, `horarios`.`status_v`, 0 as total from `horarios` where `horarios`.`id` not in (select `id_horario` from `ventas` where `horarios`.`id` = ventas.id_horario and `ventas`.`fecha` = "'.date('Y-m-d').'")) order by `id` asc'));



        $first = strtotime('last Sunday');
        $first =  date('Y-m-d', $first);
        $last  = strtotime('next Saturday');
        $last  = date('Y-m-d', $last);


        $karma= Ventas::Activas()->where('fecha', '>=', $first)
                                 ->where('fecha', '<=', $last)
                                 ->count();

       

        return view('Procesar.Logistica.index', compact('activas','xatender', 'enEsperas','remisas', 'ciudades', 'horarios', 'nota', 'notaventa', 'totalhorario', 'karma', 'class', 'id_horario', 'busca'));
    	
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
        $repartidores = Empleados::where('id_cargo', 4)->where('id_estado',1)->get();
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

        if( $request->tipof==1){return $pdf->stream('Factura_'.$request->id_venta.'.pdf');}
    
        if( $request->tipof==2){return $pdf->download('Factura_'.$request->id_venta.'.pdf');} 
      
      
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
