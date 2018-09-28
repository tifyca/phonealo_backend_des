<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Ventas;
use App\Ciudades;
use App\Horarios;
use App\Empleados;

class LogisticaController extends Controller
{
    public function index(){
    	#jgonzalez 
        $fecha = "2018-09-08";
        #sugerencia para que sea el dia de actual => date("Y-m-d");
        $hora = date("H:i:s");
        #dd($hora);     
    	$activas = Ventas::Activas()->where('fecha', '=', $fecha);
        $enEsperas = Ventas::EnEspera()->where('fecha', '=', $fecha);
        $remisas = Ventas::Remisas()->where('fecha', '=', $fecha);
        #SOLICITAR AYUDA CON ESTIO->paginate(10);
        $ciudades = Ciudades::get();
    	$horarios = Horarios::get();
    	return view('Procesar.Logistica.index', compact('activas','enEsperas','remisas', 'ciudades', 'horarios'));
    }
    public function edit(){
    	return view('Procesar.Logistica.edit');
    }
    public function remisa(){
        $remisas = Ventas::DetalleRemisa();
        $repartidores = Empleados::where('id_cargo', 4)->get();
        #dd($repartidores);
    	return view('Procesar.Logistica.remisa', compact('remisas', 'repartidores'));
    }
}
