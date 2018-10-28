<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Remitos;
use App\Estados;
use App\Empleados;
@session_start();
class RemitosController extends Controller
{
    public function index(Request $request){
    	$remitos = Remitos::Consulta()
            // Filtros de busqueda
            ->FiltroRemito($request->remito)->FiltroDelivery($request->delivery)
            ->FiltroFecha($request->fecha)->FiltroEstado($request->estado)
            // Agrupar por id remito y ordenar por id ascendentemente
            ->groupBy('remitos.id')
            ->orderBy('id', 'desc')
            ->paginate(10); 
            
        // Agrupa las ventas asociadas a los remitos, se muestra en modal
        $remitosVentas = Remitos::Ventas()
            ->groupBy('ventas.id')->get();

        // Productos asociados a la venta, se muestra en modal
        $remitosProductos = Remitos::Productos()
            ->groupBy('productos.id','detalle_ventas.id_venta')->get();  

        // Select que muestra los elementos que se encuentran en la tabla "estados"
        $estados = Estados::orderBy('id', 'ASC')
            ->select('id', 'estado')->get();

    	return view('Procesar.Remitos.index', 
            compact('remitos', 'estados', 'remitosProductos', 'remitosVentas')
        );
    }

    public function update(Request $request, $id){
        $confirmar = $request->confirmar;
        $estado;
        if ( isset($confirmar) ){
            // Pasar de estado "delivery(6)" a estado "cobrado(3)"
            $estado = 3;
            $this->modificaEstadoRemito($id, $estado);            
            session()->flash('mensaje', 'El Remito fue confirmado exitosamente');
        }

        return back();
    }

    public function show($id){
        return "hola";
    }

    private function modificaEstadoRemito($id, $estado){
        $remito = Remitos::find($id);
        $remito->id_estado = $estado;
        $remito->save();
        $remito->touch();
        return $remito;
    }
    public function monitoreo(Request $request){
         $repartidores = Empleados::where('id_cargo', 4)->where('id_estado',1)->get();
        return view('logistica.monitoreo');
    }
}
