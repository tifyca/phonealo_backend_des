<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Ventas extends Model
{
	
    protected $table = 'ventas';
    protected $fillable = ['id','status','status_v'];

    public function scopeListado($query)
    {
        return $query->leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
            ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
            ->leftjoin('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
                ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'ventas.forma_pago', 'ventas.factura', 'ventas.horario_entrega', 'ventas.fecha', 'ventas.fecha_activo', 'ventas.notas', 'ventas.id_estado', 'ventas.status_v','pedidos.id_cliente', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'ciudades.ciudad')
                ->where('ventas.id_estado', '=', '1')
                ->where('ventas.status_v', '=', '11')
                ->orWhere('ventas.id_estado', '=', '11')
                ->where('ventas.status_v', '=', '11')
                ->orderby('ventas.horario_entrega', 'desc')
            ->union(Ventas::leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
            ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
            ->leftjoin('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
                ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'ventas.forma_pago', 'ventas.factura', 'ventas.horario_entrega', 'ventas.fecha', 'ventas.fecha_activo', 'ventas.notas', 'ventas.id_estado', 'ventas.status_v', 'pedidos.id_cliente', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'ciudades.ciudad')
                ->where('ventas.id_estado','=','1')
                ->where('ventas.status_v','=', 'null')
                ->orderby('ventas.horario_entrega', 'desc'))
            ->union(Ventas::leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
            ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
            ->leftjoin('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
                ->select( 'ventas.id', 'ventas.importe', 'ventas.id_pedido', 'ventas.forma_pago', 'ventas.factura', 'ventas.horario_entrega', 'ventas.fecha', 'ventas.fecha_activo', 'ventas.notas', 'ventas.id_estado', 'ventas.status_v', 'pedidos.id_cliente', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'ciudades.ciudad')
                ->where('ventas.id_estado', '=', '5')
                ->orderby('ventas.horario_entrega', 'des'))
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
