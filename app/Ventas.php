<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


class Ventas extends Model
{
	
    protected $table = 'ventas';
    protected $fillable = ['id','status','status_v'];

    public function scopeActivas($query, $fecha)
    {
        return $query->leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
            ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
            ->leftjoin('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
            ->leftjoin('horarios', 'ventas.id_horario', '=', 'horarios.id')
            ->leftjoin('forma_pago', 'ventas.id_forma_pago', '=', 'forma_pago.id')
                ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'forma_pago.forma_pago', 'ventas.factura', 'horarios.horario', 'ventas.fecha', 'ventas.fecha_activo', 'ventas.notas', 'ventas.id_estado', 'ventas.status_v','pedidos.id_cliente', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'ciudades.ciudad')
                ->where('ventas.id_estado', '=', '1')
                ->where('ventas.fecha', '=', $fecha)
                ->orderby('horarios.horario', 'desc')
            ->get();
    }

    public function scopeEnEspera($query)
    {
        return $query->leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
            ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
            ->leftjoin('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
            ->leftjoin('horarios', 'ventas.id_horario', '=', 'horarios.id')
            ->leftjoin('forma_pago', 'ventas.id_forma_pago', '=', 'forma_pago.id')
                ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'forma_pago.forma_pago', 'ventas.factura', 'horarios.horario', 'ventas.fecha', 'ventas.fecha_activo', 'ventas.notas', 'ventas.id_estado', 'ventas.status_v','pedidos.id_cliente', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'ciudades.ciudad')
                ->where('ventas.id_estado', '=', '5')
                ->orderby('horarios.horario', 'desc')
            ->get();
    }

    public function scopeRemisas($query)
    {
        return $query->leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
            ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
            ->leftjoin('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
            ->leftjoin('horarios', 'ventas.id_horario', '=', 'horarios.id')
            ->leftjoin('forma_pago', 'ventas.id_forma_pago', '=', 'forma_pago.id')
                ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'forma_pago.forma_pago', 'ventas.factura', 'horarios.horario', 'ventas.fecha', 'ventas.fecha_activo', 'ventas.notas', 'ventas.id_estado', 'ventas.status_v','pedidos.id_cliente', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'ciudades.ciudad')
                ->where('ventas.id_estado', '=', '6')
                ->orderby('horarios.horario', 'desc')
            ->get();
    }

    public function scopeDetalleRemisa($query)
    {
        return $query->leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
            ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
            ->leftjoin('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
            ->join('horarios', 'ventas.id_horario', '=', 'horarios.id')
            ->join('forma_pago', 'ventas.id_forma_pago', '=', 'forma_pago.id')
                ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'forma_pago.forma_pago', 'ventas.factura', 'horarios.horario', 'ventas.fecha', 'ventas.fecha_activo', 'ventas.notas', 'ventas.id_estado', 'ventas.status_v','pedidos.id_cliente', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'ciudades.ciudad')
                ->where('ventas.id_estado', '=', '6')
                ->orWhere('ventas.id_estado', '=', '12')
                ->orderby('horarios.horario', 'desc')
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
