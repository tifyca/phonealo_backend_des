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
    		// ->join('ventas', 'ventas.id', 'detalle_remito.id_venta')
    		// ->join('pedidos', 'ventas.id_pedido', 'pedidos.id')
            // ->join('clientes', 'pedidos.id_cliente', 'clientes.id')
    		->select(
    			'remitos.id', 'remitos.fecha', 'remitos.importe',
    			'empleados.nombres', 
    			'estados.estado'
    			// 'clientes.nombres as nombre_cliente'
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
