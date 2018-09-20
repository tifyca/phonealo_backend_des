<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Detalle_Temporal extends Model
{
	
    protected $table = 'detalle_temporal';
    protected $fillable = ['id', 'id_cliente', 'id_producto', 'cantidad', 'precio'];

}