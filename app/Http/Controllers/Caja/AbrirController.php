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

class AbrirController extends Controller
{
    public function index(){
    	return view('Caja.Abrir.index');
    }
    public function abrir(){
    	return view('Caja.Abrir.abrir');
    }
    public function remitos(){
        $remitos = Remitos::Consulta()
            ->groupBy('remitos.id')
            ->orderBy('id', 'desc')
            ->where('estados.id', 6) //Estado "Delivery"            
            ->paginate(6);           
       
    	return view('Caja.Abrir.remitos', compact('remitos'));
    }
    public function cobro_remito($id){     
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
       
        $total_efectivo = $this->totalEfectivo($id);
        $total_pos = $this->totalPOS($id);
        $total_otros = $this->totalOtros($id);     

    	return view('Caja.Abrir.cobro_remito', 
            compact('remito','remitosVentas', 'importe_venta','remitosProductos','delivery', 'total_efectivo', 'total_pos', 'total_otros')
        );
    }
    public function cerrar(){
    	return view('Caja.Abrir.cerrar');
    }
    public function salida(){
    	return view('Caja.Abrir.salida');
    }
    public function detalle(){
        return view('Caja.Abrir.detalle_caja');
    }

    private function totalEfectivo($id){
        $total_efectivo = 0;
        $efectivo = Remitos::Ventas()
            ->where('id_remito', $id)
            ->where('id_forma_pago', 1)//Efectivo
            ->where('ventas.id_estado', 8)
            ->get();
        foreach ($efectivo as $total) {
            $total_efectivo += $total->precio*$total->cantidad;
        }
        return $total_efectivo;
    }

    private function totalPOS($id){
        $total_pos = 0;
        $pos = Remitos::Ventas()
            ->where('id_remito', $id)
            ->where('ventas.id_estado', 8)
            ->where(function($query){
                $query->where('id_forma_pago',3)->orWhere('id_forma_pago',4);
            })
            ->get();            
        foreach ($pos as $total) {
            $total_pos += $total->precio*$total->cantidad;
        }
        return $total_pos;
    }

    private function totalOtros($id){
        $total_otros = 0;
        $otros = Remitos::Ventas()
            ->where('id_remito', $id)
            ->where('ventas.id_estado', 8)
            ->where('id_forma_pago', '<>', 1)
            ->where('id_forma_pago', '<>', 3)
            ->where('id_forma_pago', '<>', 4)
            ->get();
        foreach ($otros as $total) {
            $total_otros += $total->precio*$total->cantidad;
        }
        return $total_otros;
    }
}

