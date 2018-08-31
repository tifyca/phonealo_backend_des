<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MonitoreoController extends Controller
{
    public function index(){
    	return view('Procesar.Monitoreo.index');
    }
    public function cargar(){
    	return view('Procesar.Monitoreo.cargar');
    }
    public function show(){
    	return view('Procesar.Monitoreo.show');
    }
}
