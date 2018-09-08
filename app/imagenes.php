<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class imagenes extends Model
{
     protected $table = 'producto_imagenes';
    protected $fillable = ['id_producto','imagen','titulo','estatus'];
}
