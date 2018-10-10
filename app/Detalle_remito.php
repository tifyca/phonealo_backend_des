<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_remito extends Model
{
    protected $table = 'detalle_remito';
    protected $fillable = ['id', 'id_venta', 'id_remito', 'id_usuario'];

}
