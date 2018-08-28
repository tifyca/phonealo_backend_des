<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FuenteController extends Controller
{
    public function index(){
    	return view('Configurar.Fuente.index');
    }
    public function show(){
    	return view('Configurar.Fuente.show');
    }
    public function update(){
    	return view('Configurar.Fuente.edit');
    }
}
