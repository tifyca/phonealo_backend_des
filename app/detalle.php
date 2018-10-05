<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detalle extends Model
{
    protected $table = 'detalle_pedidos';
    protected $fillable = ['id','id_pedido','id_producto','cantidad','precio'];
}
