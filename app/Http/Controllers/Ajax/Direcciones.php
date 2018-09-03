<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Paises;
use App\Departamentos;
use App\Ciudades;
use App\Barrios;

class Direcciones extends Controller
{
	// MUESTRA TODOS LOS REGISTROS
	public function Paises(){
		$paises = Paises::get();
		return $paises;
	}
    public function Departamentos(){
    	$departamentos = Departamentos::get();
    	return $departamentos;
    }
    public function Ciudades(){
    	$ciudades = Ciudades::get();
    	return $ciudades;
    }
    public function Barrios(){
    	$barrios = Barrios::get();
    	return $barrios;
    }
    // //////////////////////////
    // COMBO: MUESTRA LOS REGISTROS SEGUN EL ID RECIBIDO
    public function CiudadesCombo(Request $request){
    	$id_departamento = $request['id_departamento'];
    	$ciudades = Ciudades::where('id_departamento',$id_departamento)->get();
    	return $ciudades;
    }
    public function BarriosCombo(Request $request){
    	$id_ciudad = $request['id_ciudad'];
       	$barrios = Barrios::where('id_ciudad',$id_ciudad)->get();
    	return $barrios;
    }
    // /////////////////////////
}
