<?php

namespace App\Http\Controllers\Documentacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentacionController extends Controller
{
    public function index(){
    	return view('Documentacion.index');
    }
    public function configurar(){
    	return view('Documentacion.configurar');
    }
 
    




}
