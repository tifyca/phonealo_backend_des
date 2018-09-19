<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cargos;
use App\Categorias;

class Configurar extends Controller
{
    // MUESTRA TODOS LOS REGISTROS
    public function cargos(){
        $cargos = Cargos::orderBy('cargo','asc')->get();
        return $cargos;
    }
    
     public function Categorias(Request $request){
     	$tipo=$request['tipo'];
        $categorias = Categorias::where('tipo',$tipo)->orderBy('categoria','asc')->get();
        return $categorias;
    }
    

    
}
