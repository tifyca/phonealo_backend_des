<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use App\Ventas;
use App\Ciudades;
use App\Horarios;

class LogisticaController extends Controller
{
    public function index(){
    	#jgonzalez 
        $fecha = "2018-09-08";
        #sugerencia para que sea el dia de actual => date("Y-m-d");
    	$activas = Ventas::Activas()->where('fecha', '=', $fecha);
        $enEsperas = Ventas::EnEspera()->where('fecha', '=', $fecha);
        #SOLICITAR AYUDA CON ESTIO->paginate(10);
        $ciudades = Ciudades::get();
    	$horarios = Horarios::get();
    	return view('Procesar.Logistica.index', compact('activas','enEsperas', 'ciudades', 'horarios'));
    }
    public function edit(){
    	return view('Procesar.Logistica.edit');
    }
    public function remisa(){
    	return view('Procesar.Logistica.remisa');
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
