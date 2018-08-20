<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DivisasController extends Controller
{
    public function index(){
    	return view('Configurar.Divisas.index');
    }
}
