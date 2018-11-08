<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Soporte;
use App\Productos;
use PDF;
class DescompuestoController extends Controller
{
    public function index(){

        $descompuesto=Soporte::join('productos', 'productos.id', '=', 'soporte.id_producto')
                             ->whereIn('status_soporte', [1,3])
                             ->leftjoin('ventas', 'ventas.id_pedido', '=', 'soporte.id_pedido')
                             ->select('soporte.id as idsoporte', 'soporte.id_producto', 'soporte.id_remito','soporte.id_pedido','soporte.nota','soporte.fecha_ing','soporte.fecha_eg','soporte.status_soporte', 'productos.id', 'productos.descripcion','productos.precio_compra')
                             ->orderBy('soporte.id', 'DESC')
                             ->get();
    

        return view('Procesar.Descompuesto.index', compact('descompuesto'));
    }

    public function addSoporte(Request $request){



        $option=$request->option;
        $opt=$request->opt;

        if($request->id_soporte){



          $report=Soporte::join('productos', 'productos.id', '=', 'soporte.id_producto')
                             ->where('soporte.id',$request->id_soporte)
                             ->select('soporte.id', 'soporte.nota','productos.descripcion')
                             ->orderBy('soporte.id', 'DESC')
                             ->first();
       
          $vista="Procesar.Descompuesto.rpt_soporte";
            
          
          return $this->crearPDF($report, $vista, $opt);
        
        }

        if(isset($request->id_soportes)){
             $datas = json_decode($request->id_soportes);
            $report=Soporte::join('productos', 'productos.id', '=', 'soporte.id_producto')
                             ->whereIn('soporte.id', $datas)
                             ->select('soporte.id', 'soporte.nota','productos.descripcion')
                             ->orderBy('soporte.id', 'DESC')
                             ->get();
        
          $vista="Procesar.Descompuesto.rpt_soporte";
            
          
          return $this->crearPDF($report, $vista, $opt);
          
        } 
        
        if($option==1){

             
          $soporte=Soporte::find($request->id);
          $soporte->status_soporte=2;
          $soporte->save();

        return $option;


        }else{

            $data = json_decode($request->dato);
        

          for ($i=0; $i < count($data); $i++) { 
                      
              $id_soporte= $data[$i];

              $soporte=Soporte::find($id_soporte);
              $soporte->status_soporte=2;
              $soporte->save();
    

             }
            
       return $option;
             

        }




    }

    public function CrearPDF ($report, $vista, $opt){

        $opt=$opt;
        $report = $report;
        $fecha = date('d-m-Y');
        $view =  \View::make($vista, compact('report', 'fecha', 'opt'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('Reporte_Soporte');


    }

    public function soporte(){


    	$soporte=Soporte::join('productos', 'productos.id', '=', 'soporte.id_producto')
    						 ->where('status_soporte', 2)
    						 ->leftjoin('ventas', 'ventas.id_pedido', '=', 'soporte.id_pedido')
    						 ->select('soporte.id as idsoporte', 'soporte.id_producto', 'soporte.id_remito','soporte.id_pedido','soporte.nota','soporte.fecha_ing','soporte.fecha_eg','soporte.status_soporte', 'productos.id', 'productos.descripcion','productos.precio_compra')
    					     ->get();


    	return view('Procesar.Descompuesto.soporte', compact('soporte'));
    }

    public function getSoporte(Request $request){


        $id = $request->id;
        $status = $request->status_sop;
        $cantidad="1";
        $precio="0";
        $hoy=date('Y-m-d');

      
        $prod=Soporte::where('id', $id)
                        ->select('id_producto')
                        ->first();
        

        $id_producto= $prod->id_producto;

        $soporte=Soporte::find($id);
        $soporte->status_soporte=$status;
        $soporte->fecha_eg=$hoy;
        $soporte->save();

       if($status==4){

        $producto=Productos::find($id_producto);
        $producto->stock_activo= $producto->stock_activo+1;
        $producto->descompuesto= $producto->descompuesto-1;
        $producto->save();

       }
        return $soporte;
  
   /*("INSERT INTO carga_producto (id_usuario, id_producto, cantidad, precio, fecha,estado) VALUES ('$id_usuario', '$id_producto', '$cantidad', '$precio', CURDATE(), 'Reparado')");*/

    }
}
