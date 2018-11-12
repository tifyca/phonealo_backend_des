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
use Carbon\Carbon;

class AbrirController extends Controller
{
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

        $total_efectivo = $this->totalEfectivo($id, 'resumen_caja');
        $total_pos = $this->totalPOS($id ,'resumen_caja');
        $total_otros = $this->totalOtros($id, 'resumen_caja');
        $total_salidas = 0;
        $total_gastos = 0;             
        $total_neto = $total_efectivo+$total_pos+$total_otros-($total_salidas+$total_gastos);
    
    	return view('Caja.Abrir.abrir', compact('caja', 'fecha','total_efectivo','total_pos','total_otros','$total_salidas','$total_gastos','total_neto'));
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
            ->where('estados.id', 6) //Estado "Delivery"            
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
    public function cerrar($id){
        $caja = Caja::find($id);
        $fecha = new Carbon($caja->fecha);
        $fecha = $fecha->format('d/m/Y');
    	return view('Caja.Abrir.cerrar', compact('caja','fecha'));
    }
    public function cerrarCaja(Request $request){
        // dd( $request->all() );
        $caja = Caja::find($request->id);
        $caja->id_estado = 2;//Cerrada
        $caja->observaciones = $request->observaciones;
        $caja->save();
        $caja->touch();
        return redirect()->route('caja.index');
    }
    public function salida(){
    	return view('Caja.Abrir.salida');
    }
    public function detalle(Request $request){
        $caja = Caja::find($request->caja);
        $detalles =  Caja::DetalleRemitoEntregado()
                ->where('caja.id_estado',1)//CAJA ABIERTA
                ->where('detalle_caja.id_caja',$caja->id)// CAJA ASOCIADA
                ->groupBy('ventas.id')
            ->select(
                'tipo_movimiento.descripcion as tipo', 'detalle_caja.importe',
                'detalle_caja.descripcion', 'detalle_caja.referencia_detalle as referencia'            
            )
            ->get();

            // Caja::DetalleRemitoEntregado()
            //     ->where('caja.id_estado',1)//CAJA ABIERTA
            //     ->where('detalle_caja.id_caja',$id)// CAJA ASOCIADA
            //     ->where('detalle_caja.id_forma_pago', 1)//FORMA PAGO EFECTIVO
            //     ->groupBy('ventas.id')
            //     ->select('detalle_caja.importe')            
            //     ->get();
        return view('Caja.Abrir.detalle_caja', compact('caja', 'detalles'));
    }

    private function totalEfectivo($id, $opcion){
        $total_efectivo = 0;
        if ( $opcion == "resumen_remito" ) {
            $efectivo = Remitos::Ventas()
                ->where('id_remito', $id)
                ->where('id_forma_pago', 1)//Efectivo
                // ->where('ventas.id_estado', 8)
                ->where('detalle_remito.id_estado', 2)
                ->groupBy('ventas.id')          
                ->get();
            foreach ($efectivo as $total) {
                $total_efectivo += $total->precio*$total->cantidad;
            }       
        }elseif ( $opcion == 'resumen_caja' ) {
            $efectivo = Caja::DetalleRemitoEntregado()
                ->where('caja.id_estado',1)//CAJA ABIERTA
                ->where('detalle_caja.id_caja',$id)// CAJA ASOCIADA
                ->where('detalle_caja.id_forma_pago', 1)//FORMA PAGO EFECTIVO
                ->groupBy('ventas.id')
                ->select('detalle_caja.importe')            
                ->get();
            foreach ($efectivo as $total) {
                $total_efectivo += $total->importe;
            }
        }   
        return $total_efectivo;
    }

    private function totalPOS($id, $opcion){
        $total_pos = 0;
        if ( $opcion == 'resumen_remito' ) {
            $pos = Remitos::Ventas()
                ->where('id_remito', $id)
                // ->where('ventas.id_estado', 8)
                ->where('detalle_remito.id_estado', 2)
                ->where(function($query){
                    $query->where('id_forma_pago',3)->orWhere('id_forma_pago',4);
                })
                ->groupBy('ventas.id')          
                ->get();            
            foreach ($pos as $total) {
                $total_pos += $total->precio*$total->cantidad;
            }
        }elseif ( $opcion == 'resumen_caja' ) {
           $pos = Caja::DetalleRemitoEntregado()
                ->where('caja.id_estado',1)//CAJA ABIERTA
                ->where('detalle_caja.id_caja',$id)// CAJA ASOCIADA
                ->where(function($query){//FORMA DE PAGO TARJETA/DEBIDO
                    $query->where('detalle_caja.id_forma_pago',3)
                        ->orWhere('detalle_caja.id_forma_pago',4);
                })
                ->groupBy('ventas.id')
                ->select('detalle_caja.importe')            
                ->get();
            foreach ($pos as $total) {
                $total_pos += $total->importe;
            }
        }
        return $total_pos;
    }

    private function totalOtros($id, $opcion){
        $total_otros = 0;
        if ( $opcion == 'resumen_remito' ) {
            $otros = Remitos::Ventas()
                ->where('id_remito', $id)
                // ->where('ventas.id_estado', 8)
                ->where('detalle_remito.id_estado', 2)
                ->where('id_forma_pago', '<>', 1)
                ->where('id_forma_pago', '<>', 3)
                ->where('id_forma_pago', '<>', 4)
                ->groupBy('ventas.id')          
                ->get();
            foreach ($otros as $total) {
                $total_otros += $total->precio*$total->cantidad;
            }
        }elseif ( $opcion == 'resumen_caja' ) {
            $efectivo = Caja::DetalleRemitoEntregado()
                ->where('caja.id_estado',1)//CAJA ABIERTA
                ->where('detalle_caja.id_caja',$id)// CAJA ASOCIADA
                ->where('detalle_caja.id_forma_pago', 2)//FORMA PAGO OTROS
                ->select('detalle_caja.importe') 
                ->groupBy('ventas.id')          
                ->get();
            foreach ($efectivo as $total) {
                $total_otros += $total->importe;
            }
        }
        return $total_otros;
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

