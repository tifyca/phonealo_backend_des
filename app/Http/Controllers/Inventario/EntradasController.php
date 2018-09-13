<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Proveedores;
use App\solped;
use App\detallesolped;
use DB;
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
}
