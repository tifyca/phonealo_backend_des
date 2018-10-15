<?php

namespace App\Http\Controllers\api\delivery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class documentacionController extends Controller
{
    public function index()
    {
    	return view("Delivery.documentacion.index");
    }
     public function ingresar()
    {
    	return view("Delivery.documentacion.ingresar");
    }
}
