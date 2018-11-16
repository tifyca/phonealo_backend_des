<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Monitoreos;
use App\Detalle_Monitoreos;
use Illuminate\Support\Facades\Validator;
use DB;


class ConversionesController extends Controller
{
    public function index(){
    	return view('Procesar.Conversiones.index');
    }

    public function new(){
    	return view('Procesar.Conversiones.new');
    }

    public function show($id){
  

        $mlista=Detalle_Monitoreos::join('productos', 'detalle_monitoreo.id_producto', '=', 'productos.id')
                                   ->where('id_monitoreo', $id)
                                   ->select('productos.id', 'productos.codigo_producto', 'productos.descripcion')
                                   ->get();

        $lista=Detalle_Monitoreos::join('productos', 'detalle_monitoreo.id_producto', '=', 'productos.id')
                                    ->leftjoin('categorias', 'categorias.id', '=', 'productos.id_categoria')
                                   ->where('id_monitoreo', $id)
                                   ->select('productos.codigo_producto')
                                   ->get();

        $lista2=Detalle_Monitoreos::join('productos', 'detalle_monitoreo.id_producto', '=', 'productos.id')
                                    ->leftjoin('categorias', 'categorias.id', '=', 'productos.id_categoria')
                                   ->where('id_monitoreo', $id)
                                   ->select( DB::raw('(SELECT SUM(detalle_ventas.cantidad) FROM detalle_ventas  left join ventas  on detalle_ventas.id_venta=ventas.id WHERE detalle_ventas.id_producto=productos.id AND ventas.id_estado <> 2 ) as cant'))
                                   ->get();


    	return view('Procesar.Conversiones.show')->with('mlista', $mlista)
                                                 ->with('lista',json_encode($lista ))
                                                 ->with('lista2',json_encode($lista2));

    }

     public function getdata(Request $request){



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
         	$lista->nombre=ucwords(strtolower($request->nombreLista));
         	$lista->fecha=date('Y-m-d');
            $lista->id_estado=1;
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

        public function editar($id){


            $monitoreo=Monitoreos::join('detalle_monitoreo', 'monitoreo.id', '=', 'detalle_monitoreo.id_monitoreo')
                                ->join('productos', 'productos.id', '=', 'detalle_monitoreo.id_producto')
                                ->where('monitoreo.id', $id)
                                ->select('monitoreo.id', 'monitoreo.nombre', 'monitoreo.id_estado', 'detalle_monitoreo.id_producto', 'productos.descripcion')
                                ->get();

             return view('Procesar.Conversiones.edit', compact('monitoreo'));               
        }


        public function delProdLista(Request $request){

             $id_producto=Detalle_Monitoreos::where('id_producto',$request->id_producto)
                                         ->where('id_monitoreo',$request->id_lista)
                                         ->delete();

                  return response()->json(['success' => true]);



        }

        public function update(Request $request){



           foreach ($request->parametros as $key ) {


            $dtmonitoreo=Detalle_Monitoreos::where('id_monitoreo',$request->id_lista)
                                                ->where('id_producto', $key)
                                                ->count();

                $lista=Monitoreos::find($request->id_lista);
                $lista->id_estado=$request->id_estado;
                $lista->id_usuario=$request->id_usuario;
                $lista->save();


                if($dtmonitoreo==0){

                    $dtlista=New Detalle_Monitoreos;
                    $dtlista->id_monitoreo=$request->id_lista;
                    $dtlista->id_producto=$key;
                    $dtlista->id_usuario=$request->id_usuario;
                    $dtlista->save();
                }
            }
         
            return response()->json(['success' => true]);



        }




}
