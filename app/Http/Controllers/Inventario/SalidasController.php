<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Productos;
use App\Categorias;
use App\Subcategorias;
use App\detallesolped;
use App\solped;
use App\Ventas;
use App\Detalle_Ventas;
use DB;
@session_start();
class SalidasController extends Controller
{
    public function index(Request $request){
		$idcategoria    = $request->id_categoria;
		$idsubcategoria = $request->id_subcategoria;
		$valor          = $request->valor;
        $desde          = $request->desde;
        $hasta          = $request->hasta;
		$filas = $request->filas;
    	////////////////////////////////////////////////////////////////7/
		if(empty($valor) && empty($idcategoria) ){
			if(empty($filas))	
				$productos = Productos::orderby('codigo_producto','asc')->paginate(10);	
			else
				$productos = Productos::orderby('codigo_producto','asc')->paginate($filas);		
		}
    	///////////////////filtro por producto//////////////////////////////////
		if(!empty($valor) && empty($idcategoria)){

			if(empty($filas)){	

				$productos = Productos::where('codigo_producto',$valor)->orderby('codigo_producto','asc')->paginate(10);	
                
				if($productos->isEmpty()){
                   
					$val = $valor."%";
					
					$productos = Productos::where('descripcion','like',$val)->orderby('descripcion','asc')->paginate(10);	
				}

			}else{
				$productos = Productos::where('codigo_producto',$valor)->where('id_categoria',$idcategoria)->where('id_subcategoria',$idsubcategoria)->orderby('codigo_producto','asc')->paginate($filas);	
				if($productos->isEmpty()){
					$val = $valor."%";
					$productos = Productos::where('descripcion','like',$val)->where('id_categoria',$idcategoria)->where('id_subcategoria',$idsubcategoria)->orderby('codigo_producto','asc')->paginate($filas);	
				}
			}
		}
    	///////////////////filtro producto y categoria////////////////////
		if(!empty($valor) && !empty($idcategoria) ){
			if(empty($filas)){	
				$productos = Productos::where('codigo_producto',$valor)->where('id_categoria',$idcategoria)->where('id_subcategoria',$idsubcategoria)->orderby('codigo_producto','asc')->paginate(10);	
				if($productos->isEmpty()){
					$val = $valor."%";
					$productos = Productos::where('descripcion','like',$val)->where('id_categoria',$idcategoria)->orderby('codigo_producto','asc')->paginate(10);	
				}

			}else{
				$productos = Productos::where('codigo_producto',$valor)->where('id_categoria',$idcategoria)->orderby('codigo_producto','asc')->paginate($filas);	
				if($productos->isEmpty()){
					$val = $valor."%";
					$productos = Productos::where('descripcion','like',$val)->where('id_categoria',$idcategoria)->where('id_subcategoria',$idsubcategoria)->orderby('codigo_producto','asc')->paginate($filas);	}
				}
			}
        //////////////////////////filtro categoria///////////////////////////
				if(empty($valor) && !empty($idcategoria)){
					
					if(empty($filas))	
						$productos = Productos::where('id_categoria',$idcategoria)->orderby('codigo_producto','asc')->paginate(10);	
					else
						$productos = Productos::where('id_categoria',$idcategoria)->orderby('codigo_producto','asc')->paginate($filas);		
				}
                 
				//dd($data);
                if(empty($desde) && empty($hasta))
                {
				  $ventas = Ventas::join('detalle_ventas','ventas.id','=','detalle_ventas.id_venta')->whereIn('ventas.id_estado',['7','8'])->orderby('detalle_ventas.id_producto')->get();
				}
                if(!empty($desde) && empty($hasta))
                {
				  $ventas = Ventas::join('detalle_ventas','ventas.id','=','detalle_ventas.id_venta')->whereIn('ventas.id_estado',['7','8'])->orderby('detalle_ventas.id_producto')->where('fecha',$desde)->get();
				}

                if(!empty($desde) && !empty($hasta))
                {
				  $ventas = Ventas::join('detalle_ventas','ventas.id','=','detalle_ventas.id_venta')->whereIn('ventas.id_estado',['7','8'])->orderby('detalle_ventas.id_producto')->where('fecha','>=',$desde)->where('fecha','<=',$hasta)->get();
				}
                if(empty($desde) && !empty($hasta))
                {
				  $ventas = Ventas::join('detalle_ventas','ventas.id','=','detalle_ventas.id_venta')->whereIn('ventas.id_estado',['7','8'])->orderby('detalle_ventas.id_producto')->where('fecha','<=',$hasta)->get();
				}

				$categorias=categorias::where('tipo','Productos')->orderby('categoria','asc')->get();
				return view('Inventario.Salidas.index')->with('productos',$productos)->with('categorias',$categorias)->with('ventas',$ventas);


    	
    }
}
