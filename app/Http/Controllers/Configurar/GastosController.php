<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GastosController extends Controller
{
    public function index(){
    	return view('Configurar.Gastos.index');
    }
}
