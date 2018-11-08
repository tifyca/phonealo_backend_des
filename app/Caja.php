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
}
