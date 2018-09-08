<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
    protected $table = 'gastos';
    protected $fillable = ['id','id_categoria_gasto','descripcion','importe','comprobante','id_proveedor','fecha_comprobante','fecha','id_divisa','cambio','observaciones','created_at','updated_at','id_usuariou'];
}
