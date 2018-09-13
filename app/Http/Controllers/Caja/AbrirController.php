<?php

namespace App\Http\Controllers\Caja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AbrirController extends Controller
{
    public function index(){
    	return view('Caja.Abrir.index');
    }
    public function abrir(){
    	return view('Caja.Abrir.abrir');
    }
    public function remitos(){
    	return view('Caja.Abrir.remitos');
    }
    public function cobro_remito(){
    	return view('Caja.Abrir.cobro_remito');
    }
    public function cerrar(){
    	return view('Caja.Abrir.cerrar');
    }
    public function salida(){
    	return view('Caja.Abrir.salida');
    }
    public function detalle(){
        return view('Caja.Abrir.detalle_caja');
    }
}

