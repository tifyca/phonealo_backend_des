<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EntradasController extends Controller
{
    public function index(){
    	return view('Inventario.Entradas.index');
    }
    public function show(){
    	return view('Inventario.Entradas.show');
    }
}
