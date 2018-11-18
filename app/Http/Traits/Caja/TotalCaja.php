<?php 

namespace App\Http\Traits\Caja;
use App\Remitos;
use App\Caja;
use App\DetalleCaja;

trait TotalCaja{

	 public function totalEfectivo($id, $opcion){
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
                // ->where('caja.id_estado',1)//CAJA ABIERTA
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

    public function totalPOS($id, $opcion){
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
                // ->where('caja.id_estado',1)//CAJA ABIERTA
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

    public function totalOtros($id, $opcion){
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
                // ->where('caja.id_estado',1)//CAJA ABIERTA
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

    public function totalSalidaEfectivo($id){
        $salidasEfectivo = DetalleCaja::where('id_caja', $id)
            ->where('id_tipo_movimiento', 4)
            ->get();
        $total = 0;
        foreach ($salidasEfectivo as $salidaEfectivo) {
            $total += $salidaEfectivo->importe;
        }
        return $total;
    }

    public function totalGastos($id){
        $gastos = DetalleCaja::where('id_caja', $id)
            ->where('id_tipo_movimiento', 5)
            ->get();
        $total = 0;
        foreach ($gastos as $gasto) {
            $total += $gasto->importe;
        }
        return $total;
    }

}

 ?>