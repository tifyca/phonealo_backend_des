<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notas_Ventas extends Model
{
    protected $table = 'notas_ventas';
    protected $fillable = ['id','id_venta','nota','id_usuario'];
}
