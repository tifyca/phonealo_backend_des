<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cargos;
use Redirect;


class CargosController extends Controller
{

  public function index(){
    	$cargos= Cargos::all();
    	return view('Configurar.Cargos.index')->with('cargos',$cargos);
    }

  public function agregar(Request $request){   
        $cargo= new Cargos;
        $cargo->cargo  =  $request->nombre;
        $cargo->status =$request->status;
        $cargo->save();
        return response()->json($cargo);
    }

  public function editar($cargo_id){
        $cargo = Cargos::find($cargo_id);
        return response()->json($cargo);
    }

  public function update (Request $request,$cargo_id){
        $cargo = Cargos::find($cargo_id);
        $cargo->cargo = $request->nombre;
        $cargo->status = $request->status;
        $cargo->save();
        return response()->json($cargo);
    }

  public function destroy($cargo_id){
        $cargo = Cargos::destroy($cargo_id);
        return response()->json($cargo);
    }

}
