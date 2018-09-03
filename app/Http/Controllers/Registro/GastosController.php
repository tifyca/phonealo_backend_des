<?php

namespace App\Http\Controllers\Registro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GastosController extends Controller
{
    public function index(){
		return view('Registro.Gastos.index');
	}
	public function show(){
		return view('Registro.Gastos.show');
	}
	public function update(){
		return view('Registro.Gastos.edit');
	}
}
