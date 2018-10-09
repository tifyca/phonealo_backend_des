<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pedido extends Model
{

    protected $table = 'pedidos';
    protected $fillable = ['id','id_cliente','fecha','autor'];
	
	public function scopeEnEspera($query){
		return $query->join('clientes', 'pedidos.id_cliente', 'clientes.id')
            ->join('detalle_pedidos', 'pedidos.id', 'detalle_pedidos.id_pedido')
            ->join('productos', 'detalle_pedidos.id_producto', 'productos.id')
            ->join('categorias', 'productos.id_categoria', 'categorias.id')
            ->join('empleados', 'pedidos.id_usuario', 'empleados.id')
            ->join('ventas', 'pedidos.id', 'ventas.id_pedido')
            ->select('clientes.nombres', 'clientes.telefono', 'productos.codigo_producto', 'productos.descripcion', 'productos.stock_activo', 'categorias.categoria', 'detalle_pedidos.cantidad', 'empleados.nombres as nombresEmpleado', 'pedidos.id_usuario', 'ventas.fecha')
            ->where('pedidos.id_estado', 5)
            ->orderBy('ventas.fecha', 'DESC');
	}

    ////////////////
    // Relaciones //
    ////////////////

	public function venta(){
		return $this->hasOne(Ventas::class, 'id_pedido');
	}

	public function cliente(){
		return $this->belongsTo(Clientes::class, 'id_cliente');
	}

}
