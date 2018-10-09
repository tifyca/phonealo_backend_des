<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detalle extends Model
{
    protected $table = 'detalle_pedidos';
    protected $fillable = ['id','id_pedido','id_producto','cantidad','precio'];

    public function pedido(){
    	return $this->belongsTo(pedido::class, 'id_pedido');
    }

    public function producto(){
    	return $this->belongsTo(Productos::class, 'id_producto');
    }
}
