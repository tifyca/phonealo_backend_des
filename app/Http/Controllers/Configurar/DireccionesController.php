<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Paises;
use App\Departamentos;
use App\Ciudades;
use App\Barrios;

class DireccionesController extends Controller
{
    public function paises(){
    	$paises = Paises::paginate(10);
    	return view('Configurar.Direcciones.paises')->with('paises', $paises);
    }
    public function departamentos(){
    	$departamentos = Departamentos::paginate(10);
    	return view('Configurar.Direcciones.departamentos')->with('departamentos', $departamentos);
    }
    public function ciudades(){
    	return view('Configurar.Direcciones.ciudades');
    }
    public function barrios(){
    	return view('Configurar.Direcciones.barrios');
    }

}
