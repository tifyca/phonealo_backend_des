<?php

namespace App\Http\Controllers\ecommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use File;
use App\User;
use App\Productos;
use App\auditoria;
@session_start();

class OfertasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tipo ="";
        $mensaje ="";
        $productos = $request["producto"];
        $precio = $request["precio"];
        $home = $request["home"];
        if ($productos=="" && $precio=="" && $home=="") {
        $productos = Productos::where('precio_oferta','>',"")
        ->paginate(10);
      }
      else if ($productos!="" && $precio=="" && $home=="") {
      $productos = Productos::where('descripcion','like', '%' . $productos . '%')
      ->where('precio_oferta','>',"")
      ->paginate(10);
      }
       else if ($productos=="" && $precio!="" && $home=="") {
      $productos = Productos::where('precio_oferta','=',$precio)
      ->paginate(10);
      }
      else if ($productos=="" && $precio=="" && $home!="") {
      $productos = Productos::where('precio_oferta','>',"")
      ->where('home','=',$home)
      ->paginate(10);
      }
      else if ($productos!="" && $precio!="" && $home!="") {
      $productos = Productos::where('descripcion','like', '%' . $productos . '%')
      ->where('precio_oferta','=',$precio)
      ->where('home','=',$home)
      ->paginate(10);
      }
      else if ($productos!="" && $precio!="" && $home=="") {
        $productos = Productos::where('descripcion','like', '%' . $productos . '%')
        ->where('precio_oferta','=',$precio)
      ->paginate(10);
      }
      else if ($productos!="" && $precio=="" && $home!=""){
        $productos = Productos::where('descripcion','like', '%' . $productos . '%')
      ->where('precio_oferta','>',"")
      ->where('home','=',$home)
        ->paginate(10);
      }
      else if ($productos=="" && $precio!="" && $home!=""){
        $productos = productos::where('precio_oferta','=',$precio)
        ->where('home','=',$home)
        ->paginate(10);
      }
      else{
        $productos = productos::where('descripcion','like', '%' . $productos . '%')
      ->orWhere('precio_oferta','=',$precio)
      ->orWhere('home','=',$home)
      ->paginate(10);
      }
        return view('ecommerce.ofertas.index')->with('productos',$productos)->with('tipo',$tipo)->with('mensaje',$mensaje);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ecommerce.ofertas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request["idproducto"];
          try {
            $productos = Productos::find($id);
            $productos->fill($request->all());
            if($request["archivo"]){
              $zfile = $request["archivo"];
              $this->deleteFile($productos->banner_oferta, "banner/");
              $fileName = $this->saveFile($request["archivo"], "banner/");
              $productos->banner_oferta = $fileName;
            }
            $productos->home = $request["home"];
            $productos->precio_oferta = $request["precio_oferta"];
            $productos->updated_at = date('Y-m-d');
            $productos->id_usuario = $_SESSION["user"];
            $productos->save();

                //crear registro de auditoria
           $auditoria = new auditoria();
           $auditoria->id_usuario =  $_SESSION["user"];
           $auditoria->fecha      = date('Y-m-d');
           $auditoria->accion     = "Creando Producto en Oferta";
           $auditoria->id_producto = $productos->id;
           $auditoria->save(); 

           $tipo="1";
           $mensaje="Oferta Creada Satisfactoriamente";
           $productos=Productos::orderby('id','asc')->paginate(10);
           return view('ecommerce.ofertas.index')->with('productos',$productos)->with('tipo',$tipo)->with('mensaje',$mensaje);
          } catch (Exception $e) {
          \Log::info('Error creating item: '.$e);
          return \Response::json(['created' => false], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Productos::findOrFail($id);
        return view('ecommerce.ofertas.edit')->with('producto',$producto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idproducto)
    {
          try {
            $productos = Productos::find($idproducto);
            $productos->fill($request->all());
            if($request["archivo"]){
              $zfile = $request["archivo"];
              $this->deleteFile($productos->banner_oferta, "banner/");
              $fileName = $this->saveFile($request["archivo"], "banner/");
              $productos->banner_oferta = $fileName;
            }
            $productos->home = $request["home"];
            $productos->precio_oferta = $request["precio_oferta"];
            $productos->updated_at = date('Y-m-d');
            $productos->id_usuario = $_SESSION["user"];
            $productos->save();

                //crear registro de auditoria
           $auditoria = new auditoria();
           $auditoria->id_usuario =  $_SESSION["user"];
           $auditoria->fecha      = date('Y-m-d');
           $auditoria->accion     = "Editando Producto en Oferta";
           $auditoria->id_producto = $productos->id;
           $auditoria->save(); 

           $tipo="1";
           $mensaje="Se edito la Oferta Satisfactoriamente";
           $productos=Productos::orderby('id','asc')->paginate(10);
           return view('ecommerce.ofertas.index')->with('productos',$productos)->with('tipo',$tipo)->with('mensaje',$mensaje);
          } catch (Exception $e) {
          \Log::info('Error creating item: '.$e);
          return \Response::json(['created' => false], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($producto_id)
    {
        try
        {
            $productos = Productos::find($producto_id);
            $productos->home = NULL;
            $productos->precio_oferta = NULL;
            $productos->banner_oferta = NULL;
            $productos->updated_at = date('Y-m-d');
            $productos->id_usuario = $_SESSION["user"];
            $productos->save();
                //crear registro de auditoria
           $auditoria = new auditoria();
           $auditoria->id_usuario =  $_SESSION["user"];
           $auditoria->fecha      = date('Y-m-d');
           $auditoria->accion     = "Quitando Producto en Oferta";
           $auditoria->id_producto = $productos->id;
           $auditoria->save(); 
            return response()->json($productos);

         }catch(\Illuminate\Database\QueryException $e)
          {
           
              if($e->getCode() === '23000') {
           
                    return response()->json([ 'success' => false ], 400);
              } 
          }
    }
}
