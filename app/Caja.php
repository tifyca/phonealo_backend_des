<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table = "caja";

    protected $fillable = [ 'monto_apertura', 'observaciones' ]; 

    public function scopeEstado($query){
    	return $query->join('estado_caja', 'estado.caja.id', 'caja.id_estado');
    }

    public function scopeDetalleRemitoEntregado($query){
    	return $query->join('detalle_caja','caja.id','detalle_caja.id_caja')
    		->join('ventas','ventas.id', 'detalle_caja.id_venta')
    		->join('detalle_remito','ventas.id', 'detalle_remito.id_venta')
            ->join('tipo_movimiento','tipo_movimiento.id','detalle_caja.id_tipo_movimiento')
            ->where('detalle_remito.id_estado', 2)//detalle remito estado entregado
    		->where('ventas.id_estado', 3)//Ventas con estado cobrado
    		;
    }
}
