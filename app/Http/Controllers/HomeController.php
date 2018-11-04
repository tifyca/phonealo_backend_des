<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Remitos;
use App\Gastos;
use App\Estados;
use App\Productos;
use App\Ventas;
use App\Detalle_ventas;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $mes=date('m');
        $remitos = Remitos::Consulta()
            // Filtros de busqueda
            ->FiltroRemito($request->remito)->FiltroDelivery($request->delivery)
            ->FiltroFecha($request->fecha)->FiltroEstado($request->estado)
            // Agrupar por id remito y ordenar por id ascendentemente
            ->groupBy('remitos.id')
            ->orderBy('remitos.fecha', 'desc')
            ->paginate(6);             
        // Agrupa las ventas asociadas a los remitos, se muestra en modal
        $remitosVentas = Remitos::Ventas()
            // ->distinct()
            ->groupBy('ventas.id', 'remitos.id')
            // ->where('id_remito', 14463)
            ->get();

        // Productos asociados a la venta, se muestra en modal
        $remitosProductos = Remitos::Productos()
            ->groupBy('productos.id','detalle_ventas.id_venta')->get();  

        // Select que muestra los elementos que se encuentran en la tabla "estados"
        $estados = Estados::orderBy('id', 'ASC')
            ->select('id', 'estado')->get();

      /*$canreem =reembolso::select(DB::raw('count(cedben) as cantidad'))
              ->whereMonth('fecha',$mes)
              ->first();*/
        return view('inicio')->with('remitos',$remitos)->with('remitosVentas',$remitosVentas)->with('remitosProductos',$remitosProductos)->with('estados',$estados);
        
    }
}

