<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalidasController extends Controller
{
    public function index(){
    	return view('Inventario.Salidas.index');
    }
}
