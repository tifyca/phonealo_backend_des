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
        // Agrupa las ventas asociadas a los remitos, se muestra en modal
        $remitosVentas = Remitos::Ventas()
            // ->distinct()
            ->groupBy('ventas.id', 'remitos.id')
            ->where('id_remito', $id)
            ->get();

        // Productos asociados a la venta, se muestra en modal
        $remitosProductos = Remitos::Productos()
            // ->groupBy('productos.id','detalle_ventas.id_venta')
            ->where('id_remito', $id)
            ->get();        

        $delivery = Remitos::Consulta()->findOrfail($id)->nombre_delivery;
        
    	return view('Caja.Abrir.cobro_remito', compact('remitosVentas', 'remitosProductos','delivery'));
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
}

