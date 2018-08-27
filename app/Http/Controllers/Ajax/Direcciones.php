<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Departamentos;
use App\Ciudades;

class Direcciones extends Controller
{
    public function Departamentos(){
    	$departamentos = Departamentos::get();
    	return $departamentos;
    }
    public function Ciudades(Request $request){
    	$id_departamento = $request['id_departamento'];
    	$ciudades = Ciudades::where('id_departamento',$id_departamento)->get();
    	return $ciudades;
    }
}
