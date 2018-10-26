<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Remitos;
use App\Estados;
use App\pedido;
use App\Ventas;
use App\Detalle_remito;
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
        if ( $request->accion == 'confirmar_remito' ){
            // Pasar de estado "delivery(6)" a estado "cobrado(3)"
            $this->modificaEstadoRemito($id, 3);            
            session()->flash('mensaje', 'El remito fue confirmado exitosamente');
            return back();
        }
        if ( $request->accion == 'devolver_venta' ) {
            $venta = $this->modificaEstadoVenta($id, 1);
            $this->modificaEstadoDetalleRemito($id, 2);
            // $this->modificaEstadoPedido($venta->id_pedido, 2);
            return  response()->json([
                'mensaje' => 'La venta fue devuelta exitosamente',
                'estado' => Estados::where('id', $venta->id_estado)->first()
            ]);
        }
        if ( $request->accion == 'confirmar_venta' ) {
            $venta = $this->modificaEstadoVenta($id, 7);
            return  response()->json([
                'mensaje' => 'La venta fue confirmada exitosamente',
                'estado' => Estados::where('id', $venta->id_estado)->first()
            ]);
        }        
    }

    public function show($id){
        return Remitos::Ventas()->where('remitos.id', $id)->first();
    }

    private function modificaEstadoRemito($id, $estado){
        $remito = Remitos::find($id);
        $remito->id_estado = $estado;
        $remito->save();
        $remito->touch();
        return $remito;
    }
    private function modificaEstadoVenta($id, $estado = ''){
        $venta = Ventas::find($id);
        $venta->id_estado = $estado;
        $venta->save();
        $venta->touch();
        return $venta;
    }
    private function modificaEstadoPedido($id, $estado = ''){
        $pedido = pedido::find($id);
        $pedido->id_estado = $estado;
        $pedido->save();
        $pedido->touch();
        return $pedido;
    }
    private function modificaEstadoDetalleRemito($id, $estado = ''){
        $detalle_remito = Detalle_remito::where('id_venta', $id)->first();
        $detalle_remito->id_estado = $estado;
        $detalle_remito->save();
        $detalle_remito->touch();
        return $detalle_remito;
    }
}
