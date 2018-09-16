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
use App\solped;
use DB;
use File;
 @session_start();

class GastosController extends Controller
{
    public function index(Request $request){
      $id_categoria=$request->id_categoria;
      $desde = $request->desde;
      $hasta = $request->hasta;
      $id_usuario=$request->id_usuario;
      if($id_categoria=='' && $id_usuario=='' && $desde=='' && $hasta==''){
         $gastos = gastos::orderby('fecha','desc')->paginate(10);
      }
      if($id_categoria!='' && $id_usuario=='' && $desde=='' && $hasta==''){
         $gastos = gastos::where('id_categoria_gasto',$id_categoria)->orderby('fecha','desc')->paginate(10);
      }
      if($id_categoria=='' && $id_usuario!='' && $desde=='' && $hasta==''){
         $gastos = gastos::where('id_usuario',$id_usuario)->orderby('fecha','desc')->paginate(10);
      }
      if($id_categoria=='' && $id_usuario=='' && $desde!='' && $hasta==''){
         $gastos = gastos::where('fecha_comprobante','>=',$desde)->orderby('fecha','desc')->paginate(10);
      }

      if($id_categoria=='' && $id_usuario=='' && $desde=='' && $hasta!=''){
         $gastos = gastos::where('fecha_comprobante','<=',$hasta)->orderby('fecha','desc')->paginate(10);
      }

      if($id_categoria!='' && $id_usuario!='' && $desde=='' && $hasta==''){
         $gastos = gastos::where('id_usuario',$id_usuario)->where('id_categoria',$id_categoria)->orderby('fecha','desc')->paginate(10);
      }
      if($id_categoria!='' && $id_usuario!='' && $desde!='' && $hasta==''){
         $gastos = gastos::where('id_usuario',$id_usuario)->where('id_categoria',$id_categoria)->where('fecha_comprobante','>=',$desde)->orderby('fecha','desc')->paginate(10);
      }
      if($id_categoria!='' && $id_usuario!='' && $desde!='' && $hasta!=''){
         $gastos = gastos::where('id_usuario',$id_usuario)->where('id_categoria',$id_categoria)->where('fecha_comprobante','>=',$desde)->where('fecha_comprobante','<=',$hasta)->orderby('fecha','desc')->paginate(10);
      }
      if($id_categoria=='' && $id_usuario!='' && $desde!='' && $hasta!=''){
         $gastos = gastos::where('id_usuario',$id_usuario)->where('fecha_comprobante','>=',$desde)->where('fecha_comprobante','<=',$hasta)->orderby('fecha','desc')->paginate(10);
      }
      if($id_categoria!='' && $id_usuario=='' && $desde!='' && $hasta!=''){
         $gastos = gastos::where('id_categoria',$id_categoria)->where('fecha_comprobante','>=',$desde)->where('fecha_comprobante','<=',$hasta)->orderby('fecha','desc')->paginate(10);
      }
        if($id_categoria=='' && $id_usuario=='' && $desde!='' && $hasta!=''){
         $gastos = gastos::where('fecha_comprobante','>=',$desde)->where('fecha_comprobante','<=',$hasta)->orderby('fecha','desc')->paginate(10);
      }


    	$categorias=categorias::where('tipo','Gastos')->get();
        $usuarios = User::orderby('id','asc')->get();
         $divisas = DB::table('divisa')->orderby('id_divisa')->get();
     $fuentes= fuente::orderby('id')->get();
		return view('Registro.Gastos.index')->with('gastos',$gastos)->with('categorias',$categorias)->with('usuarios',$usuarios)->with('divisas',$divisas)->with('fuentes',$fuentes);
	}
	public function show(){
		
		$categorias=categorias::where('tipo','Gastos')->get();
		$fuentes= fuente::orderby('id')->get();
    $divisas = DB::table('divisa')->orderby('id_divisa')->get();
		$proveedores= proveedores::where('id_estado',1)->orderby('id')->get();
		return view('Registro.Gastos.show')->with('categorias',$categorias)->with('fuentes',$fuentes)->with('proveedores',$proveedores)->with('divisas',$divisas);
	}

	public function edit($id){
		$gastos     =gastos::find($id);
		$fuentes    = fuente::orderby('id')->get();
    $divisas    = DB::table('divisa')->orderby('id_divisa')->get();
		$categorias =categorias::where('id',$gastos->id_categoria_gasto)->first();
    if($categorias) $categoria  = $categorias->categoria;
    else $categoria="";
    $sproveedor = $categorias->proveedor;
		$proveedores =proveedores::get();
    $solped      = solped::where('id_proveedor',$gastos->id_solped)->get();
		return view('Registro.Gastos.edit')->with('gastos',$gastos)->with('categoria',$categoria)->with('fuentes',$fuentes)->with('proveedores',$proveedores)->with('divisas',$divisas)->with('sproveedor',$sproveedor)->with('solped',$solped);
	}

	public function store(Request $request)
	{
		try{
      $descripcion          = $request->descripcion;
      $id_categoria    = $request->id_categoria;
      //$id_subcategoria = $request->id_subcategoria;
      if(gastos::where('descripcion',$descripcion)->where('id_categoria_gasto',$request["categoria_gasto"])->where('comprobante',$request["comprobante_gasto"])->first()){
       return redirect()->route('gastos.index')->with("message","Ya se encuentra Registrado");
     }
     $gastos = new gastos($request->all());
     $gastos->descripcion          = $request["descripcion_gasto"];
     $gastos->id_categoria_gasto   = $request["categoria_gasto"];
     $gastos->observaciones        = $request["observaciones"];
     $gastos->importe              = $request["importe_gasto"];
     $gastos->id_solped            = $request["id_solped"];
     $gastos->id_proveedor         = $request["id_proveedor"];
     $gastos->comprobante          = $request["comprobante_gasto"];
     $gastos->fecha_comprobante    = $request["fecha_comprobante_gasto"];
     $gastos->id_fuente            = $request["id_fuente"];
     $gastos->id_divisa            = $request["divisa_gasto"];
     $gastos->cambio               = $request["cambio_gasto"];
     $gastos->created_at           = date('Y-m-d');
     $gastos->updated_at            = date('Y-m-d');
     $gastos->id_usuario              = $_SESSION["user"];
     $gastos->save();
     if($request->id_proveedor && $request->id_solped) 
     {
        $solped = solped::where('id',$request->id_solped)->first();
        if($solped){
          $solped->id_estado=8;
         $solped->save();
       } 
    }   
    return redirect()->route('gastos.index')->with("message","Se ha creado el registro de gasto");
        //
  }catch (Exception $e) {
    \Log::info('Error creating item: '.$e);
    return \Response::json(['created' => false], 500);
  }

	}
	
	public function update(Request $request,$id)
  {
    $gastos=gastos::find($id);
   $gastos->descripcion          = $request["descripcion_gasto"];
    $gastos->observaciones        = $request["observaciones_gastos"];
    $gastos->importe              = $request["importe_gasto"];
    $gastos->id_proveedor         = $request["id_proveedor"];
    $gastos->id_solped            = $request["id_solped"];
    $gastos->id_categoria_gasto   = $request["categoria_gasto"];
    $gastos->comprobante          = $request["comprobante_gasto"];
    $gastos->fecha_comprobante    = $request["fecha_comprobante_gasto"];
    $gastos->id_fuente            = $request["id_fuente"];
    $gastos->id_divisa            = $request["divisa_gasto"];
    $gastos->cambio               = $request["cambio_gasto"];
    $gastos->updated_at            = date('Y-m-d');
    $gastos->id_usuario              = $_SESSION["user"];
    $gastos->save();  
    return redirect()->route('gastos.index')->with("message","Se ha guardado correctamente su información");
	}
	public function destroy($id){
    $gastos=gastos::find($id);
    $solped=solped::where('id',$gastos->id_solped)->first();
    if($solped)
       return redirect()->route('gastos.index')->with("message","No se puede Eliminar");   
    else  
    {
       $gastos->destroy($id);
        return redirect()->route('gastos.index')->with("message","Se ha eliminado el registro");
    }
  }
}
