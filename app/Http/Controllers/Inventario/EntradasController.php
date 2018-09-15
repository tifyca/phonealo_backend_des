<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Proveedores;
use App\solped;
use App\detallesolped;
use DB;
@session_start();

class EntradasController extends Controller
{
    public function index(){
    	$proveedores = proveedores::where('id_estado','1')->get();
    	$solped = DB::table('solped as a')->join('detalle_solped as b','a.id','=','b.id_solped')    	         ->join('proveedores as c','a.id_proveedor','=','c.id')->select('a.id','a.fecha','a.nro_documento','a.id_proveedor','c.nombres',DB::raw('sum(b.precio * b.cantidad) as monto'),'a.id_estado','a.created_at')->groupBy('a.id')->paginate(10);

    		 
    	//$solped = solped::orderby('created_at','desc')->paginate(10);
    	return view('Inventario.Entradas.index')->with('proveedores',$proveedores)->with('solped',$solped);
    }
    public function show(){
    	$proveedores = proveedores::where('id_estado','1')->get();
    	$fecha = date('Y-m-d');
    	return view('Inventario.Entradas.show')->with('proveedores',$proveedores)->with('fecha',$fecha);
    }
    public function store(Request $request)
    {
    	
            $solped = new solped;
            $solped->id_proveedor   = $request->get('id_proveedor');
            $solped->nro_documento  = $request->get('nro_documento');
            $solped->fecha          = $request->get('fecha_entrada');

            $solped->id_usuario     = $request->get('id_usuario');
            $solped->id_estado      = 1;
            $solped->id_usuario     = $_SESSION["user"];
            $solped->created_at     = date('Y-m-d');
            $solped->updated_at     = date('Y-m-d');
            $solped->save();
            $codigo     = $request->get('codigo');
            $cantidad   = $request->get('cantidad');
            $precio     = $request->get('precio');
            $cont=0;
            dd($request);
            while($cont < count($codigo))
            {
                $detallesolped              = new detallesolped();
                $detallesolped->id_solped   = $solped->id;
                $detallesolped->id_producto = $codigo[$cont];
                $detallesolped->cantidad    = $cantidad[$cont];
                $detallesolped->precio      = $precio[$cont];
                $detallesolped->save();
                $cont = $cont + 1;
            }
          return redirect()->route('inventario.entradas')->with("message","Se ha guardado correctamente su información"); 
    }
}
