<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Monitoreos;
use App\Detalle_Monitoreos;
use Illuminate\Support\Facades\Validator;


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


        $data=$request->all();

        $rules = array( 'nombreLista'=>'required|unique:monitoreo,nombre',
                        'parametros'=>'required');

        $messages = array( 'nombreLista.required'=>'El Nombre de la Lista Requerido',
                           'nombreLista.unique'=>'El Nombre de la Lista ya Existe',
                           'parametros.required'=>'Debe Agreggar Productos a la Lista');

        $validator = Validator::make($data, $rules, $messages);

       if($validator->fails()){ 



          $errors = $validator->errors(); 
          
          return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
          
         }elseif ($validator->passes()){ 


         	$lista=New Monitoreos;
         	$lista->nombre=$request->nombreLista;
         	$lista->fecha=date('Y-m-d');
         	$lista->id_usuario=$request->id_usuario;
         	$lista->save();

            foreach ($request->parametros as $key ) {
          
         	$dtlista=New Detalle_Monitoreos;
         	$dtlista->id_monitoreo=$lista->id;
         	$dtlista->id_producto=$key;
         	$dtlista->id_usuario=$request->id_usuario;
         	$dtlista->save();

            }

        }

    	return $lista;
    }




}
