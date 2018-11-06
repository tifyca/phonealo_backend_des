<?php

namespace App\Http\Controllers\api\ecommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class documentacionController extends Controller
{
     public function index()
    {
    	return view("ecommerce.documentacion.index");
    }
     public function ingresar()
    {
    	return view("ecommerce.documentacion.ingresar");
    }
}
