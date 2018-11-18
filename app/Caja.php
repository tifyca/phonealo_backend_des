<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Caja extends Model
{
    protected $table = "caja";

    protected $fillable = [ 'monto_apertura', 'observaciones' ]; 

    ////////////
    // SCOPEs //
    ////////////
    public function scopeEstado($query){
    	return $query->join('estado_caja', 'estado.caja.id', 'caja.id_estado');
    }

    public function scopeDetalleRemitoEntregado($query){
    	return $query->join('detalle_caja','caja.id','detalle_caja.id_caja')
    		->leftjoin('ventas','ventas.id', 'detalle_caja.id_venta')
    		->leftjoin('detalle_remito','ventas.id', 'detalle_remito.id_venta')
            ->join('tipo_movimiento','tipo_movimiento.id','detalle_caja.id_tipo_movimiento')
            ->where('detalle_remito.id_estado', 2)//detalle remito estado entregado
    		->where('ventas.id_estado', 3)//Ventas con estado cobrado
    		;
    }

    //////////////////////
    // FILTROS BUSQUEDA //
    //////////////////////

    public function scopeFiltroTipoMovimiento($query, $tipo){

        if ( $tipo && $tipo <> 0) {            
                return $query->where('detalle_caja.id_tipo_movimiento', $tipo);           
        }
    }

    public function scopeFiltroUsuario($query,$user){
        if ( $user && $user <> 0 ) {            
                return $query->where('caja.id_usuario', $user);           
        }
    }

    public function scopeFiltroFecha($query,$fecha){
        if ( $fecha ) {            
            return $query->where('caja.fecha', 'like', "%".$fecha."%");           
        }
    }
    

    //////////////////////////
    // ASESORES Y MUTADORES //
    //////////////////////////
    public function getFechaAttribute($fecha){
        return Carbon::parse($fecha)->format('d-m-Y');
    }
}
