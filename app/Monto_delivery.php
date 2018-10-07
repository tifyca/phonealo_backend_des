<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monto_delivery extends Model
{
    protected $table = 'montos_delivery';
    protected $fillable = ['id','monto','id_usuario'];
}
