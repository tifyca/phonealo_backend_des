<?php

namespace App\Http\Controllers\ecommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use File;
use App\User;
use App\Slider;
use App\auditoria;
@session_start();

class sliderController extends Controller
{
    public function index(Request $request)
    {
      $tipo ="";
      $mensaje ="";
      $titulo = $request["titulo"];
      $publico = $request["publico"];
      $usuario = $request["usuario"];
      $fecha = $request["fecha"];
      if ($titulo=="" && $publico=="" && $usuario=="" && $fecha=="") {
        $slider = Slider::all();
      }
      else if ($titulo!="" && $publico!="" && $usuario!="" && $fecha!="") {
      $slider = Slider::where('descripcion','=',$titulo)
      ->where('publico','=',$publico)
      ->where('id_usuario','=',$usuario)
      ->where('created_at','=',$fecha)
      ->get();
      }
      else {
      $slider = Slider::where('descripcion','=',$titulo)
      ->orWhere('publico','=',$publico)
      ->orWhere('id_usuario','=',$usuario)
      ->orWhere('created_at','=',$fecha)
      ->get();
      }
      return view('ecommerce.slider.index')->with('slider',$slider)->with('tipo',$tipo)->with('mensaje',$mensaje);
    }
    public function create()
    {
      return view('ecommerce.slider.create');
    }
    public function edit($id){
        $slider = Slider::findOrFail($id);
        return view('ecommerce.slider.edit')->with('slider',$slider);
    }
     public function destroy($id)
    {
    }
    public function show($id)
    {

    }
    public function store(Request $request)
    {
      try{
        $titulo = $request->descripcion;
        $publico = $request->publico;
        $posicion = $request->posicion;
        if(Slider::where('descripcion',$titulo)->where('publico',$publico)->where('posicion',$posicion)->first()){
          $mensaje="Ya se encuentra Registrado";
          $tipo="2";
        }
         else{
         $slider = new Slider($request->all());
          if($request["archivo"]){
          $fileName = $this->saveFile($request["archivo"], "slider/");
          $slider->url = $fileName;
          }
        $slider->descripcion = $request["descripcion"];
        $slider->publico = $request["publico"];
        $slider->posicion = $request["posicion"];
        $slider->created_at = date('Y-m-d');
        $slider->updated_at = date('Y-m-d');
        $slider->id_usuario = $_SESSION["user"];
        $slider->save();
        //crear registro de auditoria
        $auditoria = new auditoria();
        $auditoria->id_usuario =  $_SESSION["user"];
        $auditoria->fecha = date('Y-m-d');
        $auditoria->accion = "Creando Slider";
        $auditoria->id_producto = $slider->id;
        $auditoria->save(); 
        $tipo="1";
        $mensaje="Slider Creado Satisfactoriamente";
      }    
      $slider=Slider::orderby('id','asc')->paginate(10);
      return view('ecommerce.slider.index')->with('slider',$slider)->with('tipo',$tipo)->with('mensaje',$mensaje);
    }catch (Exception $e) {
      \Log::info('Error creating item: '.$e);
      return \Response::json(['created' => false], 500);
    }
  }
    public function update(Request $request,$id){
      try {
        $slider = Slider::find($id);
        $slider->fill($request->all());
        if($request["archivo"]){
          $zfile = $request["archivo"];
          $fileName = $this->saveFile($request->archivo, "slider/");
          $this->deleteFile($slider->url, "slider/");
          $fileName = $this->saveFile($request["archivo"], "slider/");
          $slider->url = $fileName;
        }
        $slider->descripcion = $request["descripcion"];
        $slider->publico = $request["publico"];
        $slider->posicion = $request["posicion"];
        $slider->updated_at = date('Y-m-d');
        $slider->id_usuario = $_SESSION["user"];
        $slider->save();

            //crear registro de auditoria
       $auditoria = new auditoria();
       $auditoria->id_usuario =  $_SESSION["user"];
       $auditoria->fecha      = date('Y-m-d');
       $auditoria->accion     = "Editando Slider";
       $auditoria->id_producto = $slider->id;
       $auditoria->save(); 

       $tipo="1";
       $mensaje="Slider Actualizado Satisfactoriamente";
       $slider=slider::orderby('id','asc')->paginate(10);
       return view('ecommerce.slider.index')->with('slider',$slider)->with('tipo',$tipo)->with('mensaje',$mensaje);
      } catch (Exception $e) {
      \Log::info('Error creating item: '.$e);
      return \Response::json(['created' => false], 500);
    }
  }
}
