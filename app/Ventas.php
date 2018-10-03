<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


class Ventas extends Model
{
	
    protected $table = 'ventas';
    protected $fillable = ['id','status','status_v'];

    #·ventas en listado con id_1 y 11
    public function scopeActivas($query)
    {
        return $query->leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
            ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
            ->leftjoin('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
            ->leftjoin('horarios', 'ventas.id_horario', '=', 'horarios.id')
            ->leftjoin('forma_pago', 'ventas.id_forma_pago', '=', 'forma_pago.id')
                ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido','ventas.id_horario', 'ventas.factura', 'forma_pago.forma_pago', 'horarios.horario', 'ventas.fecha', 'ventas.fecha_activo', 'ventas.notas', 'ventas.id_estado', 'ventas.status_v','pedidos.id_cliente', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'clientes.id_ciudad','ciudades.ciudad')
                ->where('ventas.id_estado', '=', '1')
                ->orWhere('ventas.id_estado', '=', '11')
            ->orderby( 'ventas.id_horario', 'desc')
            ->get();
    }

    public function scopeEnEspera($query)
    {
        return $query->leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
            ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
            ->leftjoin('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
            ->leftjoin('horarios', 'ventas.id_horario', '=', 'horarios.id')
            ->leftjoin('forma_pago', 'ventas.id_forma_pago', '=', 'forma_pago.id')
                ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido','ventas.id_horario', 'ventas.factura', 'forma_pago.forma_pago', 'horarios.horario', 'ventas.fecha', 'ventas.fecha_activo', 'ventas.notas', 'ventas.id_estado', 'ventas.status_v','pedidos.id_cliente', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'clientes.id_ciudad','ciudades.ciudad')
                ->where('ventas.id_estado', '=', '5')
                ->orWhere('ventas.id_estado', '=', '12')
            ->orderby( 'ventas.id_horario', 'desc')
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
                ->orderby( 'ventas.id', 'desc')
            ->get();
    }

    public function scopeDetalleRemisa($query)
    {
        return $query->leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
            ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
            ->leftjoin('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
            ->leftjoin('horarios', 'ventas.id_horario', '=', 'horarios.id')
            ->leftjoin('forma_pago', 'ventas.id_forma_pago', '=', 'forma_pago.id')
                ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'forma_pago.forma_pago', 'ventas.factura', 'horarios.horario', 'ventas.fecha', 'ventas.fecha_activo', 'ventas.notas', 'ventas.id_estado', 'ventas.status_v','pedidos.id_cliente', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'ciudades.ciudad')
                ->where('ventas.id_estado', '=', '6')
                ->orderby( 'ventas.id', 'desc')
            ->get();
    }


    public function scopeDetalle($query, $id_venta)
    {
        return $query->leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
            ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
            ->leftjoin('detalle_pedidos', 'pedidos.id', '=', 'detalle_pedidos.id_pedido')
            ->leftjoin('productos', 'detalle_pedidos.id_producto', '=', 'productos.id')
            ->select('ventas.id', 'clientes.nombres', 'clientes.telefono','clientes.email', 'clientes.ruc_ci','clientes.direccion', 'productos.codigo_producto', 'productos.descripcion', 'detalle_pedidos.cantidad', 'detalle_pedidos.precio')
            ->where('ventas.id', '=', $id_venta)
            ->get();
    }

    
    
}
