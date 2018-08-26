<?php

namespace App\Http\Controllers\Registro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductosController extends Controller
{
    public function index(){
		return view('Registro.Productos.index');
	}
	public function store(){
		
	}
	public function show(){
		return view('Registro.Productos.show');
	}
	public function update(){
		return view('Registro.Productos.edit');
	}
	public function detalle(){
		return view('Registro.Productos.detalle');
	}
	public function edit(){
		
	}

}
