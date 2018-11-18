<?php

namespace App\Http\Controllers\Caja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Remitos;
use App\Estados;
use App\Empleados;
use App\pedido;
use App\Ventas;
use App\Detalle_remito;
use App\Caja;
use App\DetalleCaja;
use App\EstadoCaja;
use App\TipoMovimiento;
use App\TipoTransaccion;
use App\Productos;
use Carbon\Carbon;
use App\Http\Traits\Caja\TotalCaja;
class CierresController extends Controller
{
    use TotalCaja;

    public function index(Request $request){
        
        $usuarios = User::all();
        $cierres = Caja::orderBy('fecha', 'desc')
            ->join('users', 'users.id', 'caja.id_usuario')
            ->select(
                'caja.id as caja_id', 'caja.fecha as fecha', 
                'caja.monto_apertura', 'caja.monto_cierre',
                'users.name as user_nombre'
            )
            ->FiltroUsuario($request->usuario)
            ->FiltroFecha($request->fecha)
            // ->groupBy('caja.id')
            // ->get();
            ->where('id_estado', 2)//Caja CERRADA
            ->paginate(10);
    	return view('Caja.Cierres.index', compact('usuarios','cierres'));
    }
    public function resumen($id){
        $caja = Caja::findOrFail($id);
        $fecha = new Carbon($caja->fecha);
        $fecha = $fecha->format('d/m/Y');
        $user = User::find($caja->id_usuario)->name;

        $total_efectivo = $this->totalEfectivo($id, 'resumen_caja') + $caja->monto_apertura;
        $total_pos = $this->totalPOS($id ,'resumen_caja');
        $total_otros = $this->totalOtros($id, 'resumen_caja');
        $total_salidas = $this->totalSalidaEfectivo($id);
        $total_gastos = $this->totalGastos($id);             
        $total_neto = $total_efectivo+$total_pos+$total_otros-($total_salidas+$total_gastos);
    	return view('Caja.Cierres.resumen', compact('user','fecha'));
    }
    public function informe(){
    	return view('Caja.Cierres.informe');
    }
    public function modificado(){
    	return view('Caja.Cierres.modificado');
    }
} 
