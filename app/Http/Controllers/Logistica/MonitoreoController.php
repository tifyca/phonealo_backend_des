<?php

namespace App\Http\Controllers\Logistica;

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
use App\Notas_Ventas;
use App\Estados;
use App\pedido;
use App\Estados_remitos;
use App\Detalle_remito;
use Illuminate\Support\Facades\Validator;

class MonitoreoController extends Controller
{
    public function index(Request $request)
    {
         $repartidores = Remitos::join('empleados','id_delivery','=','empleados.id')->select('remitos.id_delivery','empleados.nombres')->where('remitos.id_estado','6')->groupby('remitos.id_delivery')->get();
        //dd($repartidores);
        $remitos = Remitos::join('detalle_remito','remitos.id','=','detalle_remito.id_remito')->where('remitos.id_estado','6')->orderby('remitos.id','asc')->get();
        $gremitos = Remitos::where('id_estado','6')->select('id as id_remito','id_delivery','importe')->get();
        $estados = Estados_remitos::orderby('id')->get();
         //$repartidores = Empleados::where('id_cargo', 4)->where('id_estado',1)->get();
        //$ventas= Ventas::join('detalle_ventas','ventas.id','=','detalle_ventas.id_venta')->join('horarios','ventas.id_horario','=','horarios.id')->get();
        $ventas= DB::table('ventas as a')->leftjoin('horarios as b','a.id_horario','=','b.id')->join('detalle_ventas as c','a.id','=','c.id_venta')->select('c.id_venta','a.id_horario','b.horario',DB::raw('sum(c.precio * c.cantidad) as importe'))->groupBy('a.id')->get();
        
        return view('Logistica.monitoreo')->with('repartidores',$repartidores)->with('remitos',$remitos)->with('gremitos',$gremitos)->with('estados',$estados)->with('zventas',$ventas);
   	

    }
}
