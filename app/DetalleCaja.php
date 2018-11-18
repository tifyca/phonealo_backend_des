<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class DetalleCaja extends Model
{
    protected $table = 'detalle_caja';

    /////////////////////////
    // FILTROS DE BUSQUEDA //
    /////////////////////////

   	public function scopeFiltroTipoMovimiento($query, $tipo){
        if ( $tipo && $tipo <> 0) {            
            return $query->where('detalle_caja.id_tipo_movimiento', $tipo);           
        }
    }

   	public function scopeFiltroVenta($query, $venta){
        if ( $venta && $venta <> 0) {            
            return $query->where('detalle_caja.id_venta','like', "%".$venta."%");           
        }
    }

    public function scopeFiltroUsuario($query,$user){
        if ( $user && $user <> 0 ) {            
            return $query->where('detalle_caja.id_usuario', $user);           
        }
    }

    public function scopeFiltroFecha($query,$fecha){
        if ( $fecha ) {            
            return $query->where('detalle_caja.fecha', 'like', "%".$fecha."%");           
        }
    }

	public function scopeFiltroReferencia($query,$referencia){
        if ( $referencia ) {            
            return $query->where('detalle_caja.referencia_detalle', 'like', "%".$referencia."%");
        }
    }

    //////////////////////////
    // ASESORES Y MUTADORES //
    //////////////////////////
    public function getFechaAttribute($fecha){
        return Carbon::parse($fecha)->format('d-m-Y');
    }
}
