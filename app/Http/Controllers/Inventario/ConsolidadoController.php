<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Productos;
use App\Categorias;
use App\Subcategorias;
use App\detallesolped;
use App\solped;
use DB;
@session_start();
class ConsolidadoController extends Controller
{
	public function index(Request $request){
		$idcategoria    = $request->id_categoria;
		$idsubcategoria = $request->id_subcategoria;
		$valor          = $request->valor;

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
		if(!empty($valor) && !empty($idcategoria) && empty($idsubcategoria)){
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
    	//////////////////filtro producto categoria y subcategoria////////////
			if(!empty($valor) && !empty($idcategoria) && !empty($idsubcategoria)){
				if(empty($filas)){	
					$productos = Productos::where('codigo_producto',$valor)->where('id_categoria',$idcategoria)->where('id_subcategoria',$idsubcategoria)->orderby('codigo_producto','asc')->paginate(10);	
					if($productos->isEmpty()){
						$val = $valor."%";
						$productos = Productos::where('descripcion','like',$val)->where('id_categoria',$idcategoria)->where('id_subcategoria',$idsubcategoria)->orderby('codigo_producto','asc')->paginate(10);	
					}

				}else{
					$productos = Productos::where('codigo_producto',$valor)->where('id_categoria',$idcategoria)->where('id_subcategoria',$idsubcategoria)->orderby('codigo_producto','asc')->paginate($filas);	
					if($productos->isEmpty()){
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
				if(empty($valor) && !empty($idcategoria) && empty($idsubcategoria)){
					
					if(empty($filas))	
						$productos = Productos::where('id_categoria',$idcategoria)->orderby('codigo_producto','asc')->paginate(10);	
					else
						$productos = Productos::where('id_categoria',$idcategoria)->orderby('codigo_producto','asc')->paginate($filas);		
				}
                 
				$precioc = DB::table('solped as a')->join('detalle_solped as b','a.id','=','b.id_solped')->select('b.id_producto',DB::raw('MAX(a.fecha) as ultima'))->where('a.id_estado',8)->orwhere('id_estado',7)->groupby('b.id_producto')->get();

				$data=[];

				foreach($precioc as $prec){
					$id_producto= $prec->id_producto;	
					$ultima = $prec->ultima;

					$zprecioc = solped::join('detalle_solped','solped.id','=','detalle_solped.id_solped')
					->select('solped.fecha as fecha','detalle_solped.id_producto as idp','detalle_solped.precio_confirmado as conf','detalle_solped.precio')
					->where('detalle_solped.id_producto',$id_producto)
					->where('solped.fecha',$ultima)
					->first();
					$data[]=[
						'id_producto' => $zprecioc->idp,
						'precioc' => $zprecioc->conf,
						'precio' => $zprecioc->precio
					];

				}
				//dd($data);
				$categorias=categorias::where('tipo','Productos')->orderby('categoria','asc')->get();
				return view('Inventario.Consolidado.index')->with('productos',$productos)->with('categorias',$categorias)->with('precios',$data);

			}
		}
