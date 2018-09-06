<?php

namespace App\Http\Controllers\Registro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Productos;
use App\Categorias;
use App\Subcategorias;
use App\auditoria;
use DB;
use File;
 @session_start();

class ProductosController extends Controller
{
    public function index(Request $request){

    	$categoria = $request["id_categoria"];
    	$subcategoria = $request["id_subcategoria"];
    	if($categoria!=""){
    	 $productos=productos::where('id_categoria',$categoria)->paginate(10);	
    	}else{
    	  if($subcategoria!="")	$productos=productos::where('id_subcategoria',$categoria)->paginate(10);	
    	  else{
    	  	$productos=productos::orderby('id','asc')->paginate(10);
    	  }
    	}	    
    	
    	
    	$categorias=categorias::where('tipo','Productos')->get();

		return view('Registro.Productos.index')->with('categorias',$categorias)->with('productos',$productos);
	}

    public function edit($id){
    	$categorias = categorias::where('tipo','Productos')->get();
		$productos = productos::find($id);

		$subcategorias = subcategorias::where('id',$productos->id_subcategoria);
		return view('Registro.Productos.edit')->with('productos',$productos)->with('categorias',$categorias)->with('subcategoria',$subcategorias);
	}


	public function store(Request $request){
		//dd($request);
		try{
                $nombre          = $request->descripcion;
                $id_categoria    = $request->id_categoria;
                $id_subcategoria = $request->id_subcategoria;
                if(productos::where('descripcion',$nombre)->where('id_categoria',$id_categoria)->where('id_subcategoria',$id_subcategoria)->first()){
         return redirect()->route('productos.index')->with("notificacion_error","Ya se encuentra Registrado");
       }
       $productos = new productos($request->all());
     if($request["file-input"]){
        $file = $request->file('file-input');
         $name_file2 = 'producto_'.time().'.'.$file->getClientOriginalExtension();
        $path = public_path().'/img/productos/';
        if(!empty($file_temp)){
        unlink($path.$file_temp);  
        }            

         $file->move($path, $name_file2);
         $productos->img        = $name_file2;
      }
        
        $productos->descripcion          = $request["descripcion"];
        $productos->descripcion_producto = $request["descripcion_producto"];
        $productos->precio_ideal         = $request["precio_ideal"];
        $productos->id_categoria         = $request["id_categoria"];
        $productos->id_subcategoria      = $request["id_subcategoria"];
        $productos->cod_barra_producto          = $request["cod_barra_producto"];
        $productos->codigo_producto      = $request["codigo_producto"];
        $productos->descripcion          = $request["descripcion"];
        $productos->created_at           = date('Y-m-d');
        $productos->updated_at            = date('Y-m-d');
        $productos->id_usuario              = $_SESSION["user"];
        $productos->save();

        //crear registro de auditoria
         $auditoria = new auditoria();
         $auditoria->id_usuario =  $_SESSION["user"];
         $auditoria->fecha      = date('Y-m-d');
         $auditoria->accion     = "Creando Producto";
         $auditoria->id_producto = $productos->id;
         $auditoria->save(); 

        //
	  }catch (Exception $e) {
        \Log::info('Error creating item: '.$e);
       return \Response::json(['created' => false], 500);
     }
	}
	public function show($id){
        $categorias = categorias::where('tipo','Productos')->get();		

		return view('Registro.Productos.show')->with('categorias',$categorias);
	}
	public function update(Request $request,$id){
		try {
        $productos = productos::find($id);
        $productos->fill($request->all());
        if($request["file-input"]){
        $file = $request->file('file-input');
        $filename_old = $productos->img;
          $name_file2 = 'producto_'.time().'.'.$file->getClientOriginalExtension();
          $path = public_path().'/img/productos/';

        if(!empty($file_temp)){
          unlink($path.$file_temp);  
        }            
        File::delete($path . $filename_old); 
        $file->move($path, $name_file2);
        $productos->img = $name_file2;
      }
        $productos->descripcion          = $request["descripcion"];
        $productos->descripcion_producto = $request["descripcion_producto"];
        $productos->precio_ideal         = $request["precio_ideal"];
        $productos->id_categoria         = $request["id_categoria"];
        $productos->id_subcategoria      = $request["id_subcategoria"];
        $productos->cod_barra_producto   = $request["cod_barra_producto"];
        $productos->codigo_producto      = $request["codigo_producto"];
        $productos->descripcion          = $request["descripcion"];
        $productos->updated_at            = date('Y-m-d');
        $productos->id_usuario             = $_SESSION["user"];
        $productos->save();

          //crear registro de auditoria
         $auditoria = new auditoria();
         $auditoria->id_usuario =  $_SESSION["user"];
         $auditoria->fecha      = date('Y-m-d');
         $auditoria->accion     = "Editando Producto";
         $auditoria->id_producto = $productos->id;
         $auditoria->save(); 
        return redirect()->route('productos.index')->with("notificacion","Se ha guardado correctamente su información");
      } catch (Exception $e) {
        \Log::info('Error creating item: '.$e);
       return \Response::json(['created' => false], 500);
     }
   }
   
   public function detalle($id){
   	    $productos=productos::find($id);
   	    $categorias=Categorias::where('id',$productos->id_categoria)->first();
   	    if($categorias)
   	    	$categoria = $categorias->categoria;
   	    else 
   	    	$categoria="";
   	    $subcategorias=Subcategorias::where('id',$productos->id_subcategoria)->first();
   	    if($subcategorias)
   	    $subcategoria = $subcategorias->sub_categoria;
   	   else
   	   	$subcategoria="";
   	   $imagenes=db::table('producto_imagenes as a')
   	                ->select('a.id_producto','a.imagen')
   	                ->where('id_producto',$id)->get();
		return view('Registro.Productos.detalle')->with('productos',$productos)->with('categoria',$categoria)->with('subcategoria',$subcategoria)->with('imagenes',$imagenes);
	}
	
	
}
