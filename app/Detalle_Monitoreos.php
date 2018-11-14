<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_Monitoreos extends Model
{
       protected $table = 'detalle_monitoreo';
       protected $fillable = ['id','id_monitoreo','id_producto'];

}