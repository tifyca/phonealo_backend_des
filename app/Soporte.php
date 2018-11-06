<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soporte extends Model
{
    protected $table = 'soporte';
    protected $fillable = ['id','id_venta','id_pedido','id_remeti','nota'];
}
