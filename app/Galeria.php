<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    protected $table = 'productos_imagenes';
    protected $fillable = ['id_producto','imagen','titulo','estatus'];
}
