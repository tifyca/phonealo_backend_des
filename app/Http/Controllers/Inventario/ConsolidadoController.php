<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Productos;
use App\Categorias;
use App\Subcategorias;
@session_start();
class ConsolidadoController extends Controller
{
	public function index(Request $request){
		$idcategoria    = $request->id_categoria;
		$idsubcategoria = $request->id_subcategoria;
		$filas = $request->filas;
    	////////////////////////////////////////////////////////////////7/
		if(empty($valor) && empty($idcategoria) && empty($idsubcategoria)){
			if(empty($filas))	
				$productos = Productos::orderby('codigo_producto','asc')->paginate(10);	
			else
				$productos = Productos::orderby('codigo_producto','asc')->paginate($filas);		
		}
    	///////////////////filtro por producto//////////////////////////////////
		if(!empty($valor) && empty($idcategoria) && empty($idsubcategoria)){
			if(empty($filas)){	
				$productos = Productos::where('codigo_producto',$valor)->orderby('codigo_producto','asc')->paginate(10);	
				if(!$productos){
					$val = $valor."%";
					$productos = Productos::where('descripcion','like',$val)->orderby('codigo_producto','asc')->paginate(10);	
				}

			}else{
				$productos = Productos::where('codigo_producto',$valor)->where('id_categoria',$idcategoria)->where('id_subcategoria',$idsubcategoria)->orderby('codigo_producto','asc')->paginate($filas);	
				if(!$productos){
					$val = $valor."%";
					$productos = Productos::where('descripcion','like',$val)->where('id_categoria',$idcategoria)->where('id_subcategoria',$idsubcategoria)->orderby('codigo_producto','asc')->paginate($filas);	
			 }
		   }
		}
    	///////////////////filtro producto y categoria////////////////////
		if(!empty($valor) && !empty($idcategoria) && empty($idsubcategoria)){
			if(empty($filas)){	
				$productos = Productos::where('codigo_producto',$valor)->where('id_categoria',$idcategoria)->where('id_subcategoria',$idsubcategoria)->orderby('codigo_producto','asc')->paginate(10);	
				if(!$productos){
					$val = $valor."%";
					$productos = Productos::where('descripcion','like',$val)->where('id_categoria',$idcategoria)->orderby('codigo_producto','asc')->paginate(10);	
				}

			}else{
				$productos = Productos::where('codigo_producto',$valor)->where('id_categoria',$idcategoria)->orderby('codigo_producto','asc')->paginate($filas);	
				if(!$productos){
					$val = $valor."%";
					$productos = Productos::where('descripcion','like',$val)->where('id_categoria',$idcategoria)->where('id_subcategoria',$idsubcategoria)->orderby('codigo_producto','asc')->paginate($filas);	}
			}
		}
    	//////////////////filtro producto categoria y subcategoria////////////
		if(!empty($valor) && !empty($idcategoria) && !empty($idsubcategoria)){
			if(empty($filas)){	
				$productos = Productos::where('codigo_producto',$valor)->where('id_categoria',$idcategoria)->where('id_subcategoria',$idsubcategoria)->orderby('codigo_producto','asc')->paginate(10);	
				if(!$productos){
					$val = $valor."%";
					$productos = Productos::where('descripcion','like',$val)->where('id_categoria',$idcategoria)->where('id_subcategoria',$idsubcategoria)->orderby('codigo_producto','asc')->paginate(10);	
				}

			}else{
				$productos = Productos::where('codigo_producto',$valor)->where('id_categoria',$idcategoria)->where('id_subcategoria',$idsubcategoria)->orderby('codigo_producto','asc')->paginate($filas);	
				if(!$productos){
					$val = $valor."%";
					$productos = Productos::where('descripcion','like',$val)->where('id_categoria',$idcategoria)->where('id_subcategoria',$idsubcategoria)->orderby('codigo_producto','asc')->paginate($filas);	}
			}
		}
        //////////////////filtro categoria y subcategoria//////////////
		if(empty($valor) && !empty($idcategoria) && !empty($idsubcategoria)){
			if(empty($filas))	
				$productos = Productos::where('id_categoria',$idcategoria)->where('id_subcategoria',$idsubcategoria)->orderby('codigo_producto','asc')->paginate(10);	
			else
				$productos = Productos::where('id_categoria',$idcategoria)->where('id_subcategoria',$idsubcategoria)->orderby('codigo_producto','asc')->paginate($filas);		
		}
        //////////////////////////filtro categoria///////////////////////////
		if(!empty($valor) && !empty($idcategoria) && empty($idsubcategoria)){
			if(empty($filas))	
				$productos = Productos::where('id_categoria',$idcategoria)->orderby('codigo_producto','asc')->paginate(10);	
			else
				$productos = Productos::where('id_categoria',$idcategoria)->orderby('codigo_producto','asc')->paginate($filas);		
		}


		$categorias=categorias::where('tipo','Productos')->orderby('categoria','asc')->get();
		return view('Inventario.Consolidado.index')->with('productos',$productos)->with('categorias',$categorias);

	}
}
