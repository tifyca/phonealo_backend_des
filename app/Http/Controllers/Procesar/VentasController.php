<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VentasController extends Controller
{
    public function index(){
    	return view('Procesar.Ventas.index');
    }
}
