<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos;
use App\Categorias;
use App\Subcategorias;
use DB;
use App\imagenes;
@session_start();
class GaleriaController extends Controller
{
  public function index(Request $request){
   $id=$request->id;
    	//dd($id);
   $tipo="";
   $mensaje="";
   $productos = productos::find($id);
   $nombre = $productos->descripcion;
   $codigo = $productos->codigo_producto;
   $galeria=db::table('producto_imagenes as a')
   ->select('a.id_producto','a.id','a.imagen as img','a.titulo','a.estatus')
   ->where('id_producto',$id)->paginate(10);
   return view('Galeria.index')->with('galeria',$galeria)
   ->with('nombre',$nombre)
   ->with('codigo',$codigo)
   ->with("id",$id)
   ->with("tipo",$tipo)
   ->with("mensaje",$mensaje);
 }
 public function new(Request $request){
  return view('Galeria.new')->with('id',$request["id"]);
}
public function store(Request $request)
{
  try{
    $titulo          = $request->titulo;
    $id_producto    = $request->id_producto;
    $productos = productos::where('id',"=",$id_producto)->first();
    if(imagenes::where('titulo',$titulo)->where('id_producto',$id_producto)->first()){
      return redirect()->route('productos.index')->with("message","Ya se encuentra Registrado");
    }
    $galeria = new imagenes($request->all());
    if($request["archivo"]){
          //dd($request->archivo);
      $fileName = $this->saveFile($request["archivo"], "productos/");
      $galeria->imagen        = $fileName;
    }
    if(!isset($request["estatus"])) $estatus = 1;
    else $estatus = $request["estatus"];
    $galeria->titulo          = $request["titulo"];
    $galeria->estatus         = $estatus;
    $galeria->id_producto     = $request["id_producto"];
    $galeria->created_at      = date('Y-m-d');
    $galeria->updated_at      = date('Y-m-d');
    $galeria->id_usuario      = $_SESSION["user"];
    $galeria->save();
    
     $tipo="1";
   $mensaje="Imagen almacenada Satisfactoriamente";
   $productos = productos::find($id);
   $nombre = $productos->descripcion;
   $codigo = $productos->codigo_producto;
   $galeria=db::table('producto_imagenes as a')
   ->select('a.id_producto','a.id','a.imagen as img','a.titulo','a.estatus')
   ->where('id_producto',$id)->paginate(10);
   return view('Galeria.index')->with('galeria',$galeria)
   ->with('nombre',$nombre)
   ->with('codigo',$codigo)
   ->with("id",$id)
   ->with("tipo",$tipo)
   ->with("mensaje",$mensaje);

  }catch (Exception $e) {
    \Log::info('Error creating item: '.$e);
    return \Response::json(['created' => false], 500);
  }

}

public function edit($id){
  $galeria=imagenes::find($id);
  $id_producto = $galeria->id_producto;
  return view('Galeria.edit')->with('galeria',$galeria)->with('id',$id_producto);
}
public function show(Request $request,$id){

      //dd($id);
    //dd($id);
 $tipo="";
 $mensaje="";
 $productos = productos::find($id);
 if($productos){
 $nombre = $productos->descripcion;
 $codigo = $productos->codigo_producto;
}else{ $nombre=""; $codigo="";}
 $galeria=db::table('producto_imagenes as a')
 ->select('a.id_producto','a.id','a.imagen as img','a.titulo','a.estatus')
 ->where('id_producto',$id)->paginate(10);
 return view('Galeria.index')->with('galeria',$galeria)
 ->with('nombre',$nombre)
 ->with('codigo',$codigo)
 ->with("id",$id)
 ->with("tipo",$tipo)
 ->with("mensaje",$mensaje);

}
public function update(Request $request,$id){

  try {
   $galeria=imagenes::find($id);
   $galeria->fill($request->all());
   if($request["archivo"]){
    $zfile = $request["archivo"];

    $fileName = $this->saveFile($request->archivo, "productos/");
    $this->deleteFile($galeria->imagen, "productos/");
    $fileName = $this->saveFile($request["archivo"], "productos/");
    $galeria->imagen = $fileName;
  }
  $id_producto              = $galeria->id_producto;
  $galeria->titulo          = $request["titulo"];
  $galeria->estatus         = $request["estatus"];
  $galeria->updated_at      = date('Y-m-d');
  $galeria->id_usuario      = $_SESSION["user"];
  $galeria->save();


  return redirect()->route('galeria.index',$id_producto)->with("message","Se ha guardado correctamente su información");
} catch (Exception $e) {
  \Log::info('Error creating item: '.$e);
  return \Response::json(['created' => false], 500);
}


}

public function destroy(Request $request){

 try
 {
  $id = $request->id;
  $galeria= imagenes::find($id);
  $id_producto = $galeria->id_producto;
  $this->deleteFile($galeria->imagen, "productos/");
  $galeria->destroy($id);
  $productos = productos::where('id',$id_producto)->first();
  $id = $productos->id;
  return response()->json($galeria);
}catch(\Illuminate\Database\QueryException $e)
{

  if($e->getCode() === '23000') {

    return response()->json([ 'success' => false ], 400);

  } 
}




  //return redirect()->route('galeria.index',$id_producto)->with("message","Se ha Eliminado el Registro");

}
}
