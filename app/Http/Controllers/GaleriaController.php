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
   $productos = productos::find($id);
   $nombre = $productos->descripcion;
   $codigo = $productos->codigo_producto;
   $galeria=db::table('producto_imagenes as a')
   ->select('a.id_producto','a.id','a.imagen as img','a.titulo','a.estatus')
   ->where('id_producto',$id)->paginate(10);
   return view('Galeria.index')->with('galeria',$galeria)->with('nombre',$nombre)->with('codigo',$codigo)->with("id",$id);
 }
 public function new(Request $request){
  return view('Galeria.new')->with('id',$request["id"]);
}
public function store(Request $request)
{
  try{
    $titulo          = $request->titulo;
    $id_producto    = $request->id;

    if(imagenes::where('titulo',$titulo)->where('id_producto',$id_producto)->first()){
      return redirect()->route('productos.index')->with("notificacion_error","Ya se encuentra Registrado");
    }
    $galeria = new imagenes($request->all());
    if($request["archivo"]){
          //dd($request->archivo);
      $fileName = $this->saveFile($request["archivo"], "productos/");
      $galeria->imagen        = $fileName;
    }

    $galeria->titulo          = $request["titulo"];
    $galeria->estatus         = $request["estatus"];
    $galeria->id_producto     = $request["id_producto"];
    $galeria->created_at      = date('Y-m-d');
    $galeria->updated_at      = date('Y-m-d');
    $galeria->id_usuario      = $_SESSION["user"];
    $galeria->save();
    $id = $id_producto;
        //return redirect()->route('galeria.index',$request->id)->with("notificacion","Se ha guardado correctamente su información");
        //
    $productos = productos::find($id);
    $nombre = $productos->descripcion;
    $codigo = $productos->codigo_producto;
    $galeria=db::table('producto_imagenes as a')
    ->select('a.id_producto','a.id','a.imagen as img','a.titulo','a.estatus')
    ->where('id_producto',$id)->paginate(10);
    return view('Galeria.index')->with('galeria',$galeria)->with('nombre',$nombre)->with('codigo',$codigo)->with("id",$id);
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
public function show($id){

      //dd($id);
  $productos = productos::find($id);
  $nombre = $productos->descripcion;
  $codigo = $productos->codigo_producto;
  $galeria=db::table('producto_imagenes as a')
  ->select('a.id_producto','a.id','a.imagen as img','a.titulo','a.estatus')
  ->where('id_producto',$id)->paginate(10);
  return view('Galeria.index')->with('galeria',$galeria)->with('nombre',$nombre)->with('codigo',$codigo)->with("id",$id);

}
public function updated(Request $request,$id){

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


  return redirect()->route('galeria.index',$id_producto)->with("notificacion","Se ha guardado correctamente su información");
} catch (Exception $e) {
  \Log::info('Error creating item: '.$e);
  return \Response::json(['created' => false], 500);
}


}

public function destroy($id){
  $galeria= imagenes::find($id);
  $this->deleteFile($galeria->imagen, "productos/");
  $galeria->destroy($id);
  return redirect()->route('producto.index');

}
}
