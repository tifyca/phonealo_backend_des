<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


class Ventas extends Model
{
	
    protected $table = 'ventas';
    protected $keyType = 'varchar';
    protected $fillable = ['id','status','status_v'];

    #scope para buscar ventas con id_estado  1 o 11 (ventas activas o ventas modificadas)
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
    ##scope para buscar ventas con id_estado  5 o 12 (ventas pendientes por producto y reparando)
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
    #scope para buscar ventas con id_estado  6 (ventas para remisar)
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
    #scope para buscar ventas con id_estado  6 (ventas para remisar), muestra detalle en listado remisa
    #con DB::raw se hace el producto entre campos para optener importe
    public function scopeDetalleRemisa($query)
    {
        return $query->leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
            ->leftjoin('detalle_pedidos', 'ventas.id_pedido', '=', 'detalle_pedidos.id_pedido')
            ->leftjoin('productos', 'detalle_pedidos.id_producto', '=', 'productos.id')
            ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
            ->leftjoin('users', 'pedidos.id_usuario', '=', 'users.id')
            ->leftjoin('horarios', 'ventas.id_horario', '=', 'horarios.id')
            ->leftjoin('forma_pago', 'ventas.id_forma_pago', '=', 'forma_pago.id')
                ->select('ventas.id', 'ventas.id_pedido', 'detalle_pedidos.id_producto', 'detalle_pedidos.cantidad','detalle_pedidos.precio' , 'productos.descripcion', 'users.id as id_usuario','ventas.id_estado', 'ventas.status_v','horarios.horario', 'forma_pago.forma_pago',
                         DB::raw('(detalle_pedidos.cantidad*detalle_pedidos.precio) as importe'))
                ->where('ventas.id_estado', '=', '6')
            ->get();
    }

    #scope para buscar datos detalle de venta listada en vista Logistica
    public function scopeDetalle($query, $id_venta)
    {
        return $query->leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
            ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
            ->leftjoin('detalle_pedidos', 'pedidos.id', '=', 'detalle_pedidos.id_pedido')
            ->leftjoin('productos', 'detalle_pedidos.id_producto', '=', 'productos.id')
            ->leftjoin('horarios', 'ventas.id_horario', '=', 'horarios.id')
            ->leftjoin('users', 'ventas.id_usuario', '=', 'users.id')
            ->leftjoin('forma_pago', 'ventas.id_forma_pago', '=', 'forma_pago.id')
            ->select('ventas.id', 'ventas.importe', 'ventas.fecha', 'ventas.fecha_cobro', 'ventas.id_horario', 'clientes.nombres', 'clientes.telefono','clientes.email', 'clientes.ruc_ci','clientes.direccion','clientes.barrio', 'clientes.ubicacion', 'clientes.id_tipo', 'forma_pago.forma_pago','horarios.horario', 'productos.codigo_producto', 'productos.descripcion', 'detalle_pedidos.cantidad', 'detalle_pedidos.precio', 'users.name as nameuser')
            ->where('ventas.id', '=', $id_venta)
            ->get();
    }

    ////////////////
    // Relaciones //
    ////////////////

    public function pedido(){
        return $this->belongsTo(pedido::class, 'id_pedido');
    }
    
    
}
