<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
   protected $table = 'productos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','codigo_producto','descripcion','id_categoria','id_subcategoria','codigo_barra','precio_minimo','precio_ideal','usuario_id','descripcion','id_estado'];
    protected $guarded  = ['id'];

    public function detalles(){
    	return $this->hasMany(detalles::class, 'id_producto');
    }
}
