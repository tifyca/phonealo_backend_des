<?php

namespace App\Http\Controllers\Caja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

class AbrirController extends Controller
{
    use TotalCaja;

    public function index(){
        $caja = Caja::orderBy('fecha', 'desc')
            ->where('id_usuario', auth()->user()->id)
            ->first();
        if ( $caja ) {
            $fecha = new Carbon($caja->fecha);
            $fecha = $fecha->format('d/m/Y');        
        }
    	return view('Caja.Abrir.index', compact('caja', 'fecha'));
    }
    public function crear(Request $request){      
        
        $nueva_caja = new Caja;
        $nueva_caja->monto_apertura = $request->monto_apertura;
        $nueva_caja->observaciones = "Caja aperturada";
        $nueva_caja->id_estado = 1;//Estado abierto
        $nueva_caja->id_usuario = auth()->user()->id;
        $nueva_caja->fecha = Carbon::now();
        $nueva_caja->save();
        return redirect()->route('caja.abrir', ['id' => $nueva_caja->id]);
    }

    public function abrir($id){
        $caja = Caja::find($id);
        $fecha = new Carbon($caja->fecha);
        $fecha = $fecha->format('d/m/Y');

        $salidasEfectivo = DetalleCaja::where('id_tipo_movimiento', 4)                    
                    ->where('id_caja',$caja->id)// CAJA ASOCIADA 
                    ->paginate(5);

        $total_efectivo = $this->totalEfectivo($id, 'resumen_caja') + $caja->monto_apertura;
        $total_pos = $this->totalPOS($id ,'resumen_caja');
        $total_otros = $this->totalOtros($id, 'resumen_caja');
        $total_salidas = $this->totalSalidaEfectivo($id);
        $total_gastos = $this->totalGastos($id);             
        $total_neto = $total_efectivo+$total_pos+$total_otros-($total_salidas+$total_gastos);
    
    	return view('Caja.Abrir.abrir', compact('caja', 'fecha','total_efectivo','total_pos','total_otros','total_salidas','total_gastos','total_neto', 'salidasEfectivo'));
    }
    public function remitos(Request $request){
        // dd($request->all());
        $caja = Caja::find($request->caja);
        // return Remitos::Consulta()
        //     ->groupBy('remitos.id')
        //     ->orderBy('id', 'desc')
        //     ->where('estados.id', 6)
        //     ->get();
        $remitos = Remitos::Consulta()
            ->groupBy('remitos.id')
            ->orderBy('id', 'desc')
            ->where(function($query){
                $query->where('estados.id', 6) //Estado "Delivery"
                     ->orWhere('estados.id', 11); //Estado "Cambiado"
            })           
            ->paginate(6);           
       
    	return view('Caja.Abrir.remitos', compact('caja','remitos'));
    }
    public function cobro_remito(Request $request,$id){ 
        $caja = Caja::find($request->caja);
        $remito = Remitos::findOrFail($id);
        // Agrupa las ventas asociadas a los remitos, se muestra en modal
        $remitosVentas = Remitos::Ventas()
            // ->distinct()
            ->groupBy('ventas.id', 'remitos.id')
            ->where('id_remito', $id)
            ->get();

        $importe_venta = Remitos::Ventas()
            ->where('id_remito', $id)
            ->get();

        // Productos asociados a la venta, se muestra en modal
        $remitosProductos = Remitos::Productos()
            ->groupBy('productos.id','detalle_ventas.id_venta')
            // ->distinct()
            ->where('id_remito', $id)
            ->get();        

        $delivery = Remitos::Consulta()->findOrfail($id)->nombre_delivery; 

        $habilitaConfirmacionRemito = $this->habilitaConfirmacionRemito($remito->id);
        $total_efectivo = $this->totalEfectivo($id, 'resumen_remito');
        $total_pos = $this->totalPOS($id, 'resumen_remito');
        $total_otros = $this->totalOtros($id, 'resumen_remito');     

    	return view('Caja.Abrir.cobro_remito', 
            compact('remito','remitosVentas', 'importe_venta','remitosProductos','delivery', 'total_efectivo', 'total_pos', 'total_otros', 'caja', 'habilitaConfirmacionRemito')
        );
    }
    public function descompuestos(Request $request){
        if ( $request->accion == 'si' ) {
            // dd($request->all());
            // return $cantidad = Remitos::Productos()
            //     ->where('remitos.id',$request->id_remito)
            //     ->where('productos.id', '<>', 36)
            //     ->where('detalle_remito.id_estado', 1)
            //     ->count();
            
            $producto = Productos::find($request->id_producto);
            $producto->stock_activo++;
            $producto->save();
            $producto->touch();
          
            $remito = Remitos::find($request->id_remito);
            $remito->id_estado = 7;
            $remito->save();            
            $remito->touch();            
            
            return back()->with('mensaje', 'El Producto fue confirmado exitosamente');
        }
        if ( $request->accion == 'no' ) {            
            // dd($request->all());
            $caja = Caja::find($request->caja);
            $producto = Productos::find($request->id_producto);
            $producto->descompuesto++;
            $producto->save();
            $producto->touch();
          
            $remito = Remitos::find($request->id_remito);
            $remito->id_estado = 7;
            $remito->save();            
            $remito->touch();  

            $soporte = new Soporte;
            $soporte->id_producto = $request->id_producto;
            $soporte->id_remito = $request->id_remito;
            $soporte->id_pedido = Ventas::find($request->id_venta)->id_pedido;
            $soporte->nota = $request->nota;
            $soporte->fecha_ing = Carbon::now();
            $soporte->status_soporte = 1;
            $soporte->id_usuario = $request->id_usuario;
            $soporte->save();

            return redirect()->route('caja.remitos', compact('caja'));
                // ->with('mensaje', 'El Producto descompuesto fue confirmado exitosamente');

        }
    }

    public function cerrar(Request $request, $id){
        // dd($request->all());
        $vistaAbrir = $request->vistaAbrir;
        $caja = Caja::find($id);
        $fecha = new Carbon($caja->fecha);
        $fecha = $fecha->format('d/m/Y');

        $total_efectivo = $this->totalEfectivo($id, 'resumen_caja') + $caja->monto_apertura;
        $total_pos = $this->totalPOS($id ,'resumen_caja');
        $total_otros = $this->totalOtros($id, 'resumen_caja');
        $total_salidas = $this->totalSalidaEfectivo($id);
        $total_gastos =  $this->totalGastos($id);             
        $total_neto = $total_efectivo+$total_pos+$total_otros-($total_salidas+$total_gastos);

    	return view('Caja.Abrir.cerrar', compact('caja','fecha', 'vistaAbrir','total_efectivo','total_pos','total_otros','total_salidas','total_gastos','total_neto'));
    }
    public function cerrarCaja(Request $request){
        // dd( $request->all() );       

        $caja = Caja::find($request->id);

        $total_efectivo = $this->totalEfectivo($caja->id, 'resumen_caja') + $caja->monto_apertura;
        $total_pos = $this->totalPOS($caja->id ,'resumen_caja');
        $total_otros = $this->totalOtros($caja->id, 'resumen_caja');
        $total_salidas = $this->totalSalidaEfectivo($caja->id);
        $total_gastos = $this->totalGastos($caja->id);            
        $total_neto = $total_efectivo+$total_pos+$total_otros-($total_salidas+$total_gastos);

        $caja->id_estado = 2;//Cerrada
        $caja->observaciones = $request->observaciones;
        $caja->monto_cierre = $total_neto;
        $caja->save();
        $caja->touch();
        return redirect()->route('caja.index')
            ->with('mensaje', "Caja #$caja->id Cerrada");
    }
    public function salida(Request $request){        
        // dd($request->all());
        $caja = Caja::find($request->caja);

    	return view('Caja.Abrir.salida',compact('caja'));
    }
    public function registrarSalida(Request $request){
        // dd($request->all());
        $cantidadSalidas = DetalleCaja::where('id_tipo_movimiento',4)
            ->where('id_caja',$request->caja)
            ->count();
        $fecha = Carbon::now()->format('dmy');
        $descripcion = $request->descripcionSalida;
        $importe = $request->importeSalida;

        foreach ($descripcion as $key => $desc) {
            $salida = new DetalleCaja;
            $salida->id_caja = $request->caja;
            $salida->fecha = Carbon::now();
            $salida->id_tipo_movimiento = 4;
            $salida->descripcion = $desc;
            $salida->referencia_detalle = $fecha.$request->caja.($cantidadSalidas++);
            $salida->importe = $importe[$key];
            $salida->id_usuario = auth()->user()->id;
            $salida->id_forma_pago = 1;
            $salida->save();
        }
        return back();
    
    }
    public function detalle(Request $request){
        // return $request;
        $caja = Caja::find($request->caja);
        $detalles = Caja::DetalleRemitoEntregado()
            ->where('caja.id_estado',1)//CAJA ABIERTA
            ->where('detalle_caja.id_caja',$caja->id)// CAJA ASOCIADA           
            ->orWhere(function($query) use ($caja){
                $query->where('id_tipo_movimiento', 4)
                    ->where('caja.id_estado',1)//CAJA ABIERTA
                    ->where('detalle_caja.id_caja',$caja->id);// CAJA ASOCIADA 
            }) 
            ->orWhere(function($query) use ($caja){
                $query->where('id_tipo_movimiento', 5)
                    ->where('caja.id_estado',1)//CAJA ABIERTA
                    ->where('detalle_caja.id_caja',$caja->id);// CAJA ASOCIADA 
            })       
            ->FiltroTipoMovimiento($request->tipo)
            ->groupBy('detalle_caja.id')
            ->select(
                'tipo_movimiento.descripcion as tipo', 'detalle_caja.importe',
                'detalle_caja.descripcion', 'detalle_caja.referencia_detalle as referencia'            
            )
            ->orderBy('detalle_caja.fecha', 'desc')
            ->paginate(10);
        return view('Caja.Abrir.detalle_caja', compact('caja', 'detalles'));
    }

    private function habilitaConfirmacionRemito($id){
        $cantidadPendiente = Detalle_remito::where('id_remito', $id)
            ->where('detalle_remito.id_estado', 1)
            ->count();
            // ->get();
        
        if ( $cantidadPendiente == 0 ) {
            return true;
        }
        return false;
    }    

}


