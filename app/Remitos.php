<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remitos extends Model
{
    //jgonzalez
    protected $table = 'remitos';
    protected $fillable = ['id_delivery','importe','fecha','id_estado','id_usuario'];

    public function scopeConsulta($query){
    	return $query->join('detalle_remito', 'remitos.id', 'detalle_remito.id_remito')
    		->join('empleados', 'remitos.id_delivery', 'empleados.id')
    		->join('estados', 'remitos.id_estado', 'estados.id')
    		->join('ventas', 'ventas.id', 'detalle_remito.id_venta')
    		->join('pedidos', 'ventas.id_pedido', 'pedidos.id')
            ->join('clientes', 'pedidos.id_cliente', 'clientes.id')
            ->join('detalle_ventas', 'detalle_ventas.id_venta', 'ventas.id')
            ->join('productos', 'productos.id', 'detalle_ventas.id_producto')
            ->join('forma_pago', 'forma_pago.id', 'ventas.id_forma_pago')
    		->select(
    			'remitos.id', 'remitos.fecha', 'remitos.importe',
    			'empleados.nombres as nombre_delivery', 
    			'estados.estado',
    			'clientes.nombres as nombre_cliente', 'clientes.telefono',
                'productos.id as id_producto','productos.descripcion',
                'ventas.id as id_venta', 
                'forma_pago.forma_pago',
                'detalle_remito.id_venta as dr_id_venta'
    		);
    }

    public function scopeProductos($query){
        return $query->join('detalle_remito', 'remitos.id', 'detalle_remito.id_remito')
            ->join('ventas', 'ventas.id', 'detalle_remito.id_venta')
            ->join('detalle_ventas', 'detalle_ventas.id_venta', 'ventas.id')
            ->join('productos', 'productos.id', 'detalle_ventas.id_producto')
            ->select(
                'remitos.id as id_remitos', 'productos.id as id_producto',
                'productos.descripcion', 'productos.codigo_producto',
                'ventas.id as id_venta',
                'detalle_ventas.cantidad', 'detalle_ventas.precio'
            );
    }

    public function scopeVentas($query){
        return $query->join('detalle_remito', 'remitos.id', 'detalle_remito.id_remito')
            ->join('ventas', 'ventas.id', 'detalle_remito.id_venta')
            ->join('detalle_ventas', 'detalle_ventas.id_venta', 'ventas.id')
            ->join('productos', 'productos.id', 'detalle_ventas.id_producto')
            ->join('pedidos', 'ventas.id_pedido', 'pedidos.id')
            ->join('clientes', 'pedidos.id_cliente', 'clientes.id')
            ->join('forma_pago', 'forma_pago.id', 'ventas.id_forma_pago')
            ->join('estados', 'ventas.id_estado', 'estados.id')
            ->select(
                'remitos.id as id_remito', 
                'ventas.id', 'estados.estado',
                'detalle_ventas.cantidad', 'detalle_ventas.precio',
                'detalle_remito.id_remito as dr_id_remito', 'detalle_remito.id_venta as dr_id_venta',
                'clientes.nombres as nombre_cliente', 'clientes.telefono',
                'forma_pago.forma_pago'
            );
    }
    
    public function scopeFiltroRemito($query, $remito){
        if ( $remito ) {
            return $query->where('remitos.id', $remito);            
        }
    }
    public function scopeFiltroDelivery($query, $delivery){
        if ( $delivery ) {
            return $query->where('empleados.nombres', 'like', '%'.$delivery.'%');         
        }
    }
    public function scopeFiltroFecha($query, $fecha){
        if ( $fecha ) {
            return $query->where('remitos.fecha', $fecha);         
        }
    }
    public function scopeFiltroEstado($query, $estado){
        if ( $estado ) {
            return $query->where('estados.id', $estado);            
        }
    }

}
