<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cargos;

class Configurar extends Controller
{
    // MUESTRA TODOS LOS REGISTROS
    public function cargos(){
        $cargos = Cargos::get();
        return $cargos;
    }
    

    
}
