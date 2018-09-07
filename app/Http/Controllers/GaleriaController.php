<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos;
use App\Categorias;
use App\Subcategorias;
use DB;
use Galeria;
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

                if(galeria::where('titulo',$titulo)->where('id_producto',$id)->first()){
                  return redirect()->route('productos.index')->with("notificacion_error","Ya se encuentra Registrado");
                }
       $galeria = new glaeria($request->all());
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
        return redirect()->route('galeria.index',$id)->with("notificacion","Se ha guardado correctamente su información");
        //
	  }catch (Exception $e) {
        \Log::info('Error creating item: '.$e);
       return \Response::json(['created' => false], 500);
     }

    }

	public function edit($id){
		$galeria=galeria::find($id);
		return view('Galeria.edit')->with('galeria',$galeria);
	}
	public function updated(Request as request,$id){
		
try {
       $galeria=galeria::find($id);
       $galeria->fill($request->all());
        if($request["archivo"]){
          $zfile = $request["archivo"];
       
        $fileName = $this->saveFile($request->archivo, "productos/");
                $this->deleteFile($productos->img, "productos/");
                $fileName = $this->saveFile($request["archivo"], "productos/");
               $galeria->imagen = $fileName;
        }
        $galeria->titulo          = $request["titulo"];
        $galeria->estatus         = $request["estatus"];
        $galeria->updated_at      = date('Y-m-d');
        $galeria->id_usuario      = $_SESSION["user"];
        $galeria->save();


        return redirect()->route('productos.index')->with("notificacion","Se ha guardado correctamente su información");
      } catch (Exception $e) {
        \Log::info('Error creating item: '.$e);
       return \Response::json(['created' => false], 500);
     }


	}


}
