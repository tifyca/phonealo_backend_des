<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Remitos;
use App\Estados;
class RemitosController extends Controller
{
    public function index(Request $request){
        $remito = $request->remito;
        $delivery = $request->delivery;
        $fecha = $request->fecha;
        $estado = $request->estado;

    	$remitos = Remitos::Consulta()
            ->FiltroRemito($remito)
            ->FiltroDelivery($delivery)
            ->FiltroFecha($fecha)
            ->FiltroEstado($estado)
            ->groupBy('remitos.id')
            ->orderBy('id', 'asc')
            ->paginate(10); 
        // return $remitos;  
        $remitosProductos = Remitos::Productos()
            ->groupBy('productos.id','detalle_ventas.id_venta')
            ->get();    

        $estados = Estados::orderBy('id', 'ASC')
            ->select('id', 'estado')
            ->get();

    	return view('Procesar.Remitos.index', compact('remitos', 'estados', 'remitosProductos'));
    }
}
