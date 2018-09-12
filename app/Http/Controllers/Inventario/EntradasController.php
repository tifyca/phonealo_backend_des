<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Proveedores;
class EntradasController extends Controller
{
    public function index(){
    	$proveedores = proveedores::where('id_estado','1')->get();
    	return view('Inventario.Entradas.index')->with('proveedores',$proveedores);
    }
    public function show(){
    	$proveedores = proveedores::where('id_estado','1')->get();
    	return view('Inventario.Entradas.show')->with('proveedores',$proveedores);
    }
}
