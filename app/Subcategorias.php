<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Subcategorias extends Model
{
	
    protected $table = 'sub_categorias';
    protected $fillable = ['id','id_categoria','sub_categoria','status'];

}
