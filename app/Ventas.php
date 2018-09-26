<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Ventas extends Model
{
	
    protected $table = 'ventas';
    protected $fillable = ['id','status','status_v'];

    public function scopeActivas($query)
    {
        return $query->leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
            ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
            ->leftjoin('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
                ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'ventas.forma_pago', 'ventas.factura', 'ventas.id_horario', 'ventas.fecha', 'ventas.fecha_activo', 'ventas.notas', 'ventas.id_estado', 'ventas.status_v','pedidos.id_cliente', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'ciudades.ciudad')
                ->where('ventas.id_estado', '=', '1')
                ->orderby('ventas.id_horario', 'desc')
            ->get();
    }

    public function scopeEnEspera($query)
    {
        return $query->leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
            ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
            ->leftjoin('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
                ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'ventas.forma_pago', 'ventas.factura', 'ventas.id_horario', 'ventas.fecha', 'ventas.fecha_activo', 'ventas.notas', 'ventas.id_estado', 'ventas.status_v','pedidos.id_cliente', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'ciudades.ciudad')
                ->where('ventas.id_estado', '=', '5')
                ->orderby('ventas.id_horario', 'desc')
            ->get();
    }

    public function scopeRemisa($query, $id_venta)
    {
        return $query->leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
            ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
            ->leftjoin('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
                ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'ventas.forma_pago', 'ventas.factura', 'ventas.id_horario', 'ventas.fecha', 'ventas.fecha_activo', 'ventas.notas', 'ventas.id_estado', 'ventas.status_v','pedidos.id_cliente', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'ciudades.ciudad')
                ->where('ventas.id', '=', $id_venta)
            ->get();
    }



    public function scopeDetalle($query, $id_venta)
    {
        return $query->leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
            ->leftjoin('detalle_pedidos', 'pedidos.id', '=', 'detalle_pedidos.id_pedido')
            ->join('productos', 'detalle_pedidos.id_producto', '=', 'productos.id')
            ->select('productos.codigo_producto', 'productos.descripcion', 'detalle_pedidos.cantidad', 'detalle_pedidos.precio')
            ->where('ventas.id', '=', $id_venta)
            ->get();
    }
}
