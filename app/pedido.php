<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pedido extends Model
{

    protected $table = 'pedidos';
    protected $fillable = ['id','id_cliente','fecha','autor'];
	
	public function scopeEnEspera($query){
		return $query->join('ventas', 'pedidos.id', 'ventas.id_pedido')
            ->join('clientes', 'pedidos.id_cliente', 'clientes.id')            
            ->join('detalle_pedidos', 'pedidos.id', 'detalle_pedidos.id_pedido')
            ->join('productos', 'detalle_pedidos.id_producto', 'productos.id')
            ->join('categorias', 'productos.id_categoria', 'categorias.id')
            ->join('users', 'pedidos.id_usuario', 'users.id')
            ->select('clientes.nombres', 'clientes.telefono', 'productos.codigo_producto', 'productos.descripcion', 'productos.stock_activo', 'categorias.categoria', 'detalle_pedidos.cantidad', 'users.name', 'pedidos.id_usuario', 'ventas.fecha')
            ->where('ventas.id_estado', 5)
            ->where('categorias.tipo', 'Productos')
            ->where('productos.id', '<>', 36)
            ->orderBy('ventas.fecha', 'DESC');
	}

    public function scopeConsolidado($query){
        return $query->join('ventas', 'pedidos.id', 'ventas.id_pedido')          
            ->join('detalle_pedidos', 'pedidos.id', 'detalle_pedidos.id_pedido')
            ->join('productos', 'detalle_pedidos.id_producto', 'productos.id')
            ->join('categorias', 'productos.id_categoria', 'categorias.id')
            ->groupBy('productos.codigo_producto')
            ->orderBy('ventas.fecha', 'DESC')
            ->select(
                'productos.codigo_producto', 'productos.descripcion', 
                'productos.stock_activo', 'categorias.categoria', 
                'pedidos.id_usuario'
            )
            ->selectRaw('sum(detalle_pedidos.cantidad) as cantidad')
            ->where('ventas.id_estado', 5)
            ->where('categorias.tipo', 'Productos')
            ->where('productos.id', '<>', 36);
    }

    public function scopeVentasEnEspera($query){
        return $query->join('ventas', 'pedidos.id', 'ventas.id_pedido')          
            ->join('detalle_ventas', 'ventas.id', 'detalle_ventas.id_venta')
            ->join('productos', 'detalle_ventas.id_producto', 'productos.id')
            ->join('categorias', 'productos.id_categoria', 'categorias.id')
            ->join('clientes', 'clientes.id', 'pedidos.id_cliente')
            ->select(
                'productos.codigo_producto',
                'ventas.fecha',
                'clientes.nombres', 'clientes.telefono',
                'detalle_ventas.cantidad'

            );            
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
