<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConversionesController extends Controller
{
    public function index(){
    	return view('Procesar.Conversiones.index');
    }
    public function new(){
    	return view('Procesar.Conversiones.new');
    }
    public function show(){
    	return view('Procesar.Conversiones.show');
    }

}
