<?php

namespace App\Http\Controllers\Caja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use app\User;
use App\Remitos;
use App\Estados;
use App\Empleados;
use App\pedido;
use App\Ventas;
use App\Detalle_remito;
use App\auditoria;
use App\Caja;
use App\DetalleCaja;
use App\EstadoCaja;
use App\TipoMovimiento;
use App\TipoTransaccion;
use App\Productos;
use App\Soporte;
use Carbon\Carbon;
use App\Http\Traits\Caja\TotalCaja;

class HistorialController extends Controller
{
    public function index(Request $request){
    	
    	$users = User::all();

    	$detalles = DetalleCaja::orderBy('detalle_caja.fecha','desc')
    		->join('users', 'users.id', 'detalle_caja.id_usuario')
    		->join('tipo_movimiento', 'tipo_movimiento.id', 'detalle_caja.id_tipo_movimiento')    		
    		->where(function($query){
    			$query->where('detalle_caja.id_tipo_movimiento' , 2)
    				->orWhere('detalle_caja.id_tipo_movimiento', 3);
    		})
    		->select(
    			'detalle_caja.fecha', 'detalle_caja.id_venta', 'detalle_caja.importe', 
    			'detalle_caja.referencia_detalle', 'tipo_movimiento.descripcion as tipo_movimiento',
    			'users.name as nombre_usuario'
    		)
    		->FiltroVenta($request->venta)->FiltroUsuario($request->usuario)
    		->FiltroFecha($request->fecha)->FiltroReferencia($request->referencia)
    		->paginate(10);



    	return view('Caja.Historial.index', compact('detalles', 'users'));
    }
}
