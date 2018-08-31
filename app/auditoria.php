<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class auditoria extends Model
{
    protected $table = 'auditoria';
    protected $fillable = ['id_auditoria','id_usuario','fecha','accion','id_venta','id_producto'];
}
