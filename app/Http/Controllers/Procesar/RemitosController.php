<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Remitos;
use App\Estados;
use App\Empleados;
use App\pedido;
use App\Ventas;
use App\Detalle_remito;
use App\auditoria;
use App\Notas_Ventas;
use App\Caja;
use App\DetalleCaja;
use App\EstadoCaja;
use App\TipoMovimiento;

@session_start();

class RemitosController extends Controller
{
    /////////////////
    // PROPIEDADES //
    /////////////////

    private $input_confirmar;    
    private $tipo_movimiento;
    private $importe_venta;
    private $forma_pago_venta;
    private $descripcion_caja;

    ////////////////////////
    // METODOS PUBLICAS //
    ////////////////////////

    public function index(Request $request){
    	$remitos = Remitos::Consulta()
            // Filtros de busqueda
            ->FiltroRemito($request->remito)->FiltroDelivery($request->delivery)
            ->FiltroFecha($request->fecha)->FiltroEstado($request->estado)
            // Agrupar por id remito y ordenar por id ascendentemente
            ->groupBy('remitos.id')
            ->orderBy('id', 'desc')
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
       
    	return view('Procesar.Remitos.index', 
            compact('remitos', 'estados', 'remitosProductos', 'remitosVentas')
        );
    }

    public function update(Request $request, $id){        
        if ( $request->accion == 'confirmar_remito' ){
            // dd($request->all());
            // Pasar de estado "delivery(6)" a estado "cobrado(3)"
            $estado = 3; //Estado cobrado
            $this->modificaEstadoRemito($id,$estado);
            $this->auditoriaEstadoRemito($id, $estado);

            ///////////////////////////////////////////
            // MODIFICAR ESTADOS DE VENTAS ASOCIADAS //
            ///////////////////////////////////////////
            $ventas = Remitos::Ventas()
                ->where('detalle_remito.id_remito', $id)
                ->where('detalle_remito.id_estado', 2)
                ->get();
            foreach ($ventas as $venta) {
                $this->modificaEstadoVenta($venta->dr_id_venta, 3);
                // $this->creaDetalleCaja($request->caja,$id, $venta->dr_id_venta);
            }
            session()->flash('mensaje', 'El remito fue confirmado exitosamente');
            return redirect()->route('caja.remitos', ['caja' => $request->caja]);
        }
        if ( $request->accion == 'devolver_venta' ) {
            // dd($request->all());
            $venta_devuelta = $this->modificaEstadoVenta($id, 1);//Estado Activo
            $this->modificaEstadoDetalleRemito($id, 3);//Estado Cancelado

            $detalle = Detalle_remito::where('id_venta', $id)->first(); 
            $remito = $detalle->id_remito;

            $cantidadVentas = Detalle_remito::where('id_remito', $remito)->count();
            $ventasAsociadas = Detalle_remito::where('id_remito', $remito)->get();

            // $cont = 0;
            // foreach ($ventasAsociadas as $venta) {
            //     $v = Ventas::find($venta->id_venta);
            //     if ( $v->id_estado == 1 ) {
            //         $cont += 1;
            //     }                
            // }
            // if ( $cont == $cantidadVentas) {
            //     $baja = true; 
            //     $this->modificaEstadoRemito($remito, 2);       
            // }else{
            //     $baja = false;
            // }
            // return  response()->json([
            //     'mensaje' => 'La venta fue devuelta exitosamente',
            //     'estado' => Estados::where('id', $venta_devuelta->id_estado)->first(),
            //     'baja' => $baja
            // ]);
            
            return back()->with('mensaje', 'La venta fue devuelta exitosamente');
        }

        // if ( $request->accion == 'confirmar_venta' ) {
        //     $venta = $this->modificaEstadoVenta($id, 8);
        //     $this->modificaEstadoDetalleRemito($id, 2);//Estado entregado
        //     return back()->with('mensaje', 'La venta fue confirmada exitosamente');
            // return  response()->json([
            //     'mensaje' => 'La venta fue confirmada exitosamente',
            //     'estado' => Estados::where('id', $venta->id_estado)->first()
            // ]);
        // } 
        if ( $request->accion == 'rechazar_venta' ) {
            $this->add_notas($request);
            $this->modificaEstadoDetalleRemito($id, 4);//Estado Recordinado
            return back()->with('mensaje', 'La venta ha sido devuelta exitosamente');
        }       
        if ( $request->accion2 = 'modificar_pago' ) {
            // METODO QUE VALIDA EL TIPO DE PAGO Y LO MODIFICA
            $modificar_pago = $this->modoDePago($id,$request);
            if ( $modificar_pago == true ) {                 
                $this->modificaEstadoVenta($id, 8);   
                $this->modificaEstadoDetalleRemito($id, 2);//Estado entregado   
                $this->creaDetalleCaja($request->caja,$request->remito,$id);
                return back()->with('mensaje', 'La venta fue confirmada exitosamente');
            }else{
                return back()->with('mensaje', 'Campo del modo de pago requerido');
            }      
        }

    }

    public function show($id){
        return Remitos::Ventas()->where('remitos.id', $id)->first();
    }

    public function monitoreo(Request $request){
        $repartidores = Remitos::join('empleados','id_delivery','=','empleados.id')->select('remitos.id_delivery','empleados.nombres')->where('remitos.id_estado','6')->groupby('remitos.id_delivery')->get();
        //dd($repartidores);
        $remitos = Remitos::join('detalle_remito','remitos.id','=','detalle_remito.id_remito')->where('remitos.id_estado','6')->orderby('remitos.id','asc')->get();
        $gremitos = Remitos::where('id_estado','6')->select('id as id_remito','id_delivery','importe')->get();

        //$repartidores = Empleados::where('id_cargo', 4)->where('id_estado',1)->get();

        return view('Logistica.monitoreo')->with('repartidores',$repartidores)->with('remitos',$remitos)->with('gremitos',$gremitos);
    }

    ////////////////////////
    // METODOS PRIVADOS //
    ////////////////////////

    private function modificaEstadoRemito($id, $estado){
        $remito = Remitos::find($id);
        $remito->id_estado = $estado;
        $remito->save();
        $remito->touch();
        return $remito;
    }  
    private function modificaEstadoVenta($id, $estado){
        $venta = Ventas::find($id);
        $venta->id_estado = $estado;
        $venta->save();
        $venta->touch();
        return $venta;
    }
    private function modificaEstadoPedido($id, $estado){
        $pedido = pedido::find($id);
        $pedido->id_estado = $estado;
        $pedido->save();
        $pedido->touch();
        return $pedido;
    }
    private function modificaEstadoDetalleRemito($id, $estado){
        // $detalle_remito = Detalle_remito::orderBy('created_at', 'desc')
        //     ->where('id_venta', $id)->first();
        // $detalle_remito->id_estado = $estado;
        // $detalle_remito->save();
        // $detalle_remito->touch();
        // return $detalle_remito;

        // PROVISIONAL MIENTRAS SOLVENTAN LOS DUPLICADOS DE DETALLE_REMITO
        $detalle_remitos = Detalle_remito::orderBy('created_at', 'desc')
            ->where('id_venta', $id)->get();
        foreach ($detalle_remitos as $detalle_remito) {
            $detalle_remito->id_estado = $estado;
            $detalle_remito->save();
            $detalle_remito->touch();
        }
    }

    private function auditoriaEstadoRemito($id, $estado){
        $estado = Estados::where('id', $estado)->first();
        $auditoria = new auditoria();
        // $auditoria->id_venta   = $id;
        $auditoria->id_usuario =  $_SESSION["user"];
        $auditoria->fecha      = date('Y-m-d');
        $auditoria->accion     = "Procesando Remito Nro.".$id.", cambiado a estado ".$estado->estado;
        $auditoria->save();
    }

    private function modoDePago($id, $request){
        if ( $request->accion == 'modo_pago_efectivo' ) {
            $modificar_pago = $this->modificaFormaPagoVenta($id,1);
            $this->descripcion_caja = "Venta #".$id. ", via Efectivo";
        }
        if ( $request->accion == 'modo_pago_tarjeta' ) {
            $modificar_pago = $this->modificaFormaPagoVenta($id, 3,$request->input_pos);
            $this->descripcion_caja = "Venta #".$id. ", via Tarjeta #".$request->input_pos;
        }
        if ( $request->accion == 'modo_pago_debito' ) {
            $modificar_pago = $this->modificaFormaPagoVenta($id, 4,$request->input_pos);
            $this->descripcion_caja = "Venta #".$id. ", via Tarjeda de debito #".$request->input_pos;
        }        
        if ( $request->accion == 'modo_pago_otros' ) {
            $modificar_pago = $this->modificaFormaPagoVenta($id, 2, $request->input_otros);
            $this->descripcion_caja = "Venta #".$id. ", via Otra forma de pago: ".$request->input_otros;
        }
        return $modificar_pago;     
    }

    private function modificaFormaPagoVenta($id, $forma_pago, $input=""){
        $venta = Ventas::find($id);     
        $venta->id_forma_pago = $forma_pago;
        if ( $forma_pago == 1 ) {
            $this->input_confirmar = "Pago en efectivo";            
        }
        elseif ( ($forma_pago <> 1 )&&( !$input )  ) {
            return false; //valida que el campo no este vacio
        }
        elseif ( ($forma_pago <> 1 )&&( $input ) ) {
            $this->input_confirmar = $input;            
        }
        $this->tipoMovimientoCaja($forma_pago);
        $this->importe_venta = $venta->importe;
        $this->forma_pago_venta = $forma_pago;
        $venta->save();
        $venta->touch();
        return true;
    }

    private function add_notas($request){  
        $notas  = new Notas_Ventas;
        $notas->id_venta   = $request->id_venta;
        $notas->nota       = $request->nota;
        $notas->nota       = ucwords(strtolower($request->nota));
        $notas->id_usuario = $request->id_usuario;
        $notas->save();
        return $notas;
     
    }

    private function tipoMovimientoCaja($forma_pago){
        if ( $forma_pago == 1 ) {
            $this->tipo_movimiento = 1; //ingreso efectivo
        }
        if ( $forma_pago == 2 ) {
            $this->tipo_movimiento = 3;//ingreso otros
        }
        if ( $forma_pago == 3 ) {
            $this->tipo_movimiento = 2; //ingreso pos
        }
        if ( $forma_pago == 4 ) {
            $this->tipo_movimiento = 2; //ingreso pos
        }
    }

    private function creaDetalleCaja($id_caja,$id_remito, $id_venta){
        // return $this->input_confirmar." ".$this->importe_venta." ".$this->forma_pago_venta." ".$this->tipo_movimiento;
        $detalle_caja = new DetalleCaja;
        $detalle_caja->id_caja = $id_caja;     
        $detalle_caja->fecha = Carbon::now();
        $detalle_caja->descripcion = $this->descripcion_caja;
        $detalle_caja->id_tipo_movimiento = $this->tipo_movimiento;
        $detalle_caja->referencia_detalle = $id_remito;
        $detalle_caja->importe = $this->importe_venta;
        $detalle_caja->id_venta = $id_venta;
        $detalle_caja->id_forma_pago = $this->forma_pago_venta;
        $detalle_caja->id_remito = $id_remito;
        $detalle_caja->id_usuario = auth()->user()->id;
        $detalle_caja->save();
        // return $detalle_caja;

    }

   
}
