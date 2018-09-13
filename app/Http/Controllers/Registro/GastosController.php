<?php

namespace App\Http\Controllers\Registro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categorias;
use App\Subcategorias;
use App\auditoria;
use App\User;
use App\Fuente;
use App\Gastos;
use App\Proveedores;
use DB;
use File;
 @session_start();

class GastosController extends Controller
{
    public function index(Request $request){

    	$categorias=categorias::where('tipo','Gastos')->get();
        $gastos = gastos::orderby('fecha','desc')->paginate(10);
        $usuarios = User::orderby('id','asc')->get();
		return view('Registro.Gastos.index')->with('gastos',$gastos)->with('categorias',$categorias)->with('usuarios',$usuarios);
	}
	public function show(){
		
		$categorias=categorias::where('tipo','Gastos')->get();
		$fuentes= fuente::orderby('id')->get();
		$proveedores= proveedores::where('id_estado',1)->orderby('id')->get();
		return view('Registro.Gastos.show')->with('categorias',$categorias)->with('fuentes',$fuentes)->with('proveedores',$proveedores);
	}

	public function edit($id){
		$gastos=gastos::find($id);
		$fuentes= fuente::orderby('id')->get();
		$categorias=categorias::where('tipo','Gastos')->get();
		$proveedores=proveedores::get();
		return view('Registro.Gastos.edit')->with('gastos',$gastos)->with('categorias',$categorias)->with('fuentes',$fuentes)->with('proveedores',$proveedores);
	}

	public function store(Request $request)
	{
		try{
      $descripcion          = $request->descripcion;
      $id_categoria    = $request->id_categoria;
      //$id_subcategoria = $request->id_subcategoria;
      if(gastos::where('descripcion',$descripcion)->where('id_categoria',$id_categoria)->where('id_subcategoria',$id_subcategoria)->first()){
       return redirect()->route('gastos.index')->with("message","Ya se encuentra Registrado");
     }
     $gastos = new gastos($request->all());
    $gastos->descripcion          = $request["descripcion"];
    $gastos->observaciones        = $request["observaciones"];
    $gastos->importe              = $request["importe_gasto"];
    $gastos->id_proveedor         = $request["id_proveedor"];
    $gastos->id_categoria_gasto   = $request["id_categoria"];
    $gastos->comprobante          = $request["comprobante_gasto"];
    $gastos->fecha_comprobante    = $request["fecha_comprobante_gasto"];
    $gastos->id_fuente            = $request["fuente"];
    $gastos->id_divisa            = $request["divisa_gasto"];
    $gastos->cambio               = $request["cambio_gasto"];
    $gastos->created_at           = date('Y-m-d');
    $gastos->updated_at            = date('Y-m-d');
    $gastos->id_usuario              = $_SESSION["user"];
    $gastos->save();

       
    return redirect()->route('gastos.index')->with("message","Se ha guardado correctamente su información");
        //
  }catch (Exception $e) {
    \Log::info('Error creating item: '.$e);
    return \Response::json(['created' => false], 500);
  }

	}
	
	public function update(Request $request,$id){

	}
	public function destroy($id){}
}
