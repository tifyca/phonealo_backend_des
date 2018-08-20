<?php

namespace App\Http\Controllers\Registro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GastosController extends Controller
{
    public function index(){
		return view('Registro.Gastos.index');
	}
}
