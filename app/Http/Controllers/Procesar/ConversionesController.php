<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Monitoreos;
use App\Detalle_Monitoreos;


class ConversionesController extends Controller
{
    public function index(){
    	return view('Procesar.Conversiones.index');
    }
    public function new(){
    	return view('Procesar.Conversiones.new');
    }
    public function show(){
    	return view('Procesar.Conversiones.show');
    }

     public function create(Request $request){


     	$lista=New Monitoreos;
     	$lista->nombre=$request->nombreLista;
     	$lista->fecha=date('Y-m-d');
     	$lista->id_usuario=$request->id_usuario;
     	$lista->save();

     	$dtlista=New Detalle_Monitoreos;
     	$dtlista->id_monitoreo=$lista->id;
     	$dtlista->id_producto=$request->id_producto;
     	$dtlista->id_usuario=$request->id_usuario;
     	$dtlista->save();



    	return $lista;
    }




}
