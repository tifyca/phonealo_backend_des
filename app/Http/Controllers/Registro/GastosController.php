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
use App\detallesolped;
use App\Productos;
use App\Estados;
use File;
@session_start();

class GastosController extends Controller
{
  public function index(Request $request){
    $id_categoria=$request->id_categoria;
    $desde = $request->desde;
    $hasta = $request->hasta;
    $id_proveedor = $request->id_proveedor;
    $id_usuario=$request->id_usuario;
    $tipo="";
    $mensaje="";
    if($id_categoria=='' && $id_usuario=='' && $desde=='' && $hasta=='' && $id_proveedor==''){
     $gastos = gastos::orderby('fecha','desc')->paginate(10);
   }
   if($id_categoria!='' && $id_usuario=='' && $desde=='' && $hasta=='' && $id_proveedor==''){
     $gastos = gastos::where('id_categoria',$id_categoria)->orderby('fecha','desc')->paginate(10);
   }
   if($id_categoria=='' && $id_usuario!='' && $desde=='' && $hasta=='' && $id_proveedor==''){
     $gastos = gastos::where('id_usuario',$id_usuario)->orderby('fecha','desc')->paginate(10);
   }
   if($id_categoria=='' && $id_usuario=='' && $desde!='' && $hasta=='' && $id_proveedor==''){
     $gastos = gastos::where('fecha','>=',$desde)->orderby('fecha','desc')->paginate(10);
   }

   if($id_categoria=='' && $id_usuario=='' && $desde=='' && $hasta!='' && $id_proveedor==''){
     $gastos = gastos::where('fecha','<=',$hasta)->orderby('fecha','desc')->paginate(10);
   }

   if($id_categoria=='' && $id_usuario=='' && $desde=='' && $hasta=='' && $id_proveedor!=''){
     $gastos = gastos::where('id_proveedor','=',$id_proveedor)->orderby('fecha','desc')->paginate(10);
   }

   if($id_categoria!='' && $id_usuario!='' && $desde=='' && $hasta=='' && $id_proveedor==''){
     $gastos = gastos::where('id_usuario',$id_usuario)->where('id_categoria',$id_categoria)->orderby('fecha','desc')->paginate(10);
   }
   if($id_categoria!='' && $id_usuario!='' && $desde!='' && $hasta=='' && $id_proveedor==''){
     $gastos = gastos::where('id_usuario',$id_usuario)->where('id_categoria',$id_categoria)->where('fecha_comprobante','>=',$desde)->orderby('fecha','desc')->paginate(10);
   }
   if($id_categoria!='' && $id_usuario!='' && $desde!='' && $hasta!='' && $id_proveedor==''){
     $gastos = gastos::where('id_usuario',$id_usuario)->where('id_categoria',$id_categoria)->where('fecha_comprobante','>=',$desde)->where('fecha_comprobante','<=',$hasta)->orderby('fecha','desc')->paginate(10);
   }
   if($id_categoria!='' && $id_usuario!='' && $desde!='' && $hasta!='' && $id_proveedor!=''){
     $gastos = gastos::where('id_usuario',$id_usuario)->where('id_categoria',$id_categoria)->where('fecha_comprobante','>=',$desde)->where('fecha_comprobante','<=',$hasta)->where('id_proveedor',$id_proveedor)->orderby('fecha','desc')->paginate(10);
   }


   if($id_categoria=='' && $id_usuario!='' && $desde!='' && $hasta!='' && $id_proveedor!=''){
     $gastos = gastos::where('id_usuario',$id_usuario)->where('fecha_comprobante','>=',$desde)->where('fecha_comprobante','<=',$hasta)->where('id_proveedor',$id_proveedor)->orderby('fecha','desc')->paginate(10);
   }
   if($id_categoria=='' && $id_usuario!='' && $desde!='' && $hasta!='' && $id_proveedor==''){
     $gastos = gastos::where('id_usuario',$id_usuario)->where('fecha_comprobante','>=',$desde)->where('fecha_comprobante','<=',$hasta)->orderby('fecha','desc')->paginate(10);
   }


   if($id_categoria!='' && $id_usuario=='' && $desde!='' && $hasta!='' && $id_proveedor!=''){
     $gastos = gastos::where('id_categoria',$id_categoria)->where('fecha_comprobante','>=',$desde)->where('fecha_comprobante','<=',$hasta)->where('id_proveedor',$id_proveedor)->orderby('fecha','desc')->paginate(10);
   }

   if($id_categoria!='' && $id_usuario=='' && $desde!='' && $hasta!='' && $id_proveedor==''){
     $gastos = gastos::where('id_categoria',$id_categoria)->where('fecha_comprobante','>=',$desde)->where('fecha_comprobante','<=',$hasta)->orderby('fecha','desc')->paginate(10);
   }

   if($id_categoria=='' && $id_usuario=='' && $desde!='' && $hasta!='' && $id_proveedor!=''){
     $gastos = gastos::where('fecha_comprobante','>=',$desde)
     ->where('fecha_comprobante','<=',$hasta)->where('id_proveedor',$id_proveedor)->orderby('fecha','desc')->paginate(10);
   }
  
   if($id_categoria=='' && $id_usuario=='' && $desde!='' && $hasta!='' && $id_proveedor==''){
     $gastos = gastos::where('fecha_comprobante','>=',$desde)
     ->where('fecha_comprobante','<=',$hasta)->orderby('fecha','desc')->paginate(10);
   }
   
   $proveedores = proveedores::orderby('nombres','asc')->get();
   $categorias=categorias::where('tipo','Gastos')->get();
   $usuarios = User::orderby('id','asc')->get();
   $divisas = DB::table('divisa')->orderby('id_divisa')->get();
   $fuentes= fuente::orderby('id')->get();
   return view('Registro.Gastos.index')->with('gastos',$gastos)->with('categorias',$categorias)->with('usuarios',$usuarios)->with('divisas',$divisas)->with('fuentes',$fuentes)->with('tipo',$tipo)->with('mensaje',$mensaje)->with('proveedores',$proveedores);
 }
 public function show(){
  
  $categorias=categorias::where('tipo','Gastos')->get();
  $fuentes= fuente::orderby('id')->get();
  $divisas = DB::table('divisa')->orderby('id_divisa')->get();
  $proveedores= proveedores::where('id_estado',1)->orderby('id')->get();
  return view('Registro.Gastos.show')->with('categorias',$categorias)->with('fuentes',$fuentes)->with('proveedores',$proveedores)->with('divisas',$divisas);
}

 public function create(){
  
  $categorias=categorias::where('tipo','Gastos')->get();
  $fuentes= fuente::where('id','2')->get();
  $divisas = DB::table('divisa')->orderby('id_divisa')->get();
  $proveedores= proveedores::where('id_estado',1)->orderby('id')->get();
  return view('Registro.Gastos.create')->with('categorias',$categorias)->with('fuentes',$fuentes)->with('proveedores',$proveedores)->with('divisas',$divisas);

}


public function edit($id){
  $gastos     =gastos::find($id);
  $fuentes    = fuente::orderby('id')->get();
  $divisas    = DB::table('divisa')->orderby('id_divisa')->get();
  $categorias =categorias::where('id',$gastos->id_categoria)->first();
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
    if(gastos::where('descripcion',$descripcion)->where('id_categoria',$request["categoria_gasto"])->where('comprobante',$request["comprobante"])->first()){
     $mensaje="Ya se encuentra Registrado";
     $tipo=2;
   }
   else{
     $gastos = new gastos($request->all());
     $gastos->descripcion          = $request["descripcion_gasto"];
     $gastos->id_categoria         = $request["categoria_gasto"];
     $gastos->observaciones        = $request["observaciones"];
     $gastos->importe              = $request["importe_gasto"];
     $gastos->fecha_comprobante    = $request["fecha_comprobante_gasto"];
     $gastos->id_estado             = 1;
     if($request->id_proveedor && $request->id_solped) {
      $gastos->id_fuente = 1;
      $gastos->id_solped            = $request["id_solped"];
     $gastos->id_proveedor         = $request["id_proveedor"];
     $gastos->comprobante          = $request["comprobante_gasto2"];


    }else
    {
      $gastos->id_fuente            = $request["id_fuente"];
      $gastos->comprobante          = $request["comprobante_gasto"];
    }

    $gastos->id_divisa            = $request["divisa_gasto"];
    $gastos->cambio               = $request["cambio_gasto"];
    $gastos->created_at           = date('Y-m-d');
    $gastos->fecha                = date('Y-m-d');
    $gastos->updated_at            = date('Y-m-d');
    $gastos->id_usuario              = $_SESSION["user"];
    $gastos->save();
    if($request->id_proveedor && $request->id_solped) 
    {

      $detallesolped= detallesolped::where('id_solped',$request->id_solped)->get();
      $cant=0; //Contador de productos incluidos en la solicitud
      $pag=0;
      foreach ($detallesolped as $deta) {
        if(strtolower($deta->nfactura)==strtolower($request["comprobante_gasto"]))
        {
          $deta->pagado = 1;
          $deta->save();
          $productos= Productos::where('id',$deta->id_producto)->first();
          $stock = $productos->stock_activo + $deta->cantidad_confirmada;
          $productos->stock_activo  = $stock;
          $productos->precio_compra = $deta->precio_confirmado;
          $productos->updated_at    = date('Y-m-d');
          $productos->save();
          $pag++;
        }
        
      }
      $pagado=db::table("detalle_solped")->select(DB::raw('count(id_solped) as cantidad'))->where('id_solped',$request->id_solped)->where('pagado',1)->groupby('id_solped')->first();
      $cant =$pagado->cantidad;
      $detalle=db::table("detalle_solped")->select(DB::raw('count(id_solped) as cantidad'))->where('id_solped',$request->id_solped)->groupby('id_solped')->first();
      if($cant==$detalle->cantidad){  
        $solped = solped::where('id',$request->id_solped)->first();
        if($solped){
          $solped->id_estado=8;
          $solped->save();
        } 
      }
    }
    $tipo=1;
    $mensaje = "Se ha creado el registro de Gasto";   
    $categorias=categorias::where('tipo','Gastos')->get();
    $proveedores = proveedores::orderby('nombres','asc')->get();
    $usuarios = User::orderby('id','asc')->get();
    $divisas = DB::table('divisa')->orderby('id_divisa')->get();
    $fuentes= fuente::orderby('id')->get();
    $gastos = gastos::orderby('fecha','desc')->paginate(10);
    return view('Registro.Gastos.index')->with('gastos',$gastos)->with('categorias',$categorias)->with('usuarios',$usuarios)->with('divisas',$divisas)->with('fuentes',$fuentes)->with('tipo',$tipo)->with('mensaje',$mensaje)->with('proveedores',$proveedores);    
     }   //
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
  $gastos->fecha_comprobante    = $request["fecha_comprobante_gasto"];
  $gastos->id_fuente            = $request["id_fuente"];
  $gastos->updated_at            = date('Y-m-d');

  $gastos->id_usuario              = $_SESSION["user"];
  $gastos->save();  
  $tipo=1;
  $mensaje = "Se ha actualizado el registro de Gasto";   
  $categorias=categorias::where('tipo','Gastos')->get();
  $usuarios = User::orderby('id','asc')->get();
  $divisas = DB::table('divisa')->orderby('id_divisa')->get();
  $fuentes= fuente::orderby('id')->get();
  $gastos = gastos::orderby('fecha','desc')->paginate(10);
  $proveedores = proveedores::orderby('nombres','asc')->get();
  return view('Registro.Gastos.index')->with('gastos',$gastos)->with('categorias',$categorias)->with('usuarios',$usuarios)->with('divisas',$divisas)->with('fuentes',$fuentes)->with('tipo',$tipo)->with('mensaje',$mensaje)->with('proveedores',$proveedores);  
}
public function anular(Request $request){
   
 try{
      $id = $request->id;
      $gastos=gastos::find($id);
      $gastos->id_estado = 2;
      $gastos->save();
      return response()->json($gastos);
      }catch(\Illuminate\Database\QueryException $e)
      {      
              if($e->getCode() === '23000') {          
                    return response()->json([ 'success' => false ], 400);
              } 
          } 



  }
}
