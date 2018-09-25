<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Detalle_Ventas extends Model
{
	
    protected $table = 'detalle_ventas';
    protected $fillable = ['id', 'id_producto', 'cantidad', 'precio'];

}