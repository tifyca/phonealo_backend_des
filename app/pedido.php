<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pedido extends Model
{

    protected $table = 'pedidos';
    protected $fillable = ['id','id_cliente','fecha','autor'];
	
	public function venta(){
		return $this->hasOne(Ventas::class, 'id_pedido');
	}

	public function cliente(){
		return $this->belongsTo(Clientes::class, 'id_cliente');
	}


}
