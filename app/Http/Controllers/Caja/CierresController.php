<?php

namespace App\Http\Controllers\Caja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CierresController extends Controller
{
    public function index(){
    	return view('Caja.Cierres.index');
    }
    public function resumen(){
    	return view('Caja.Cierres.resumen');
    }
    public function informe(){
    	return view('Caja.Cierres.informe');
    }
    public function modificado(){
    	return view('Caja.Cierres.modificado');
    }
}
