<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Subcategorias extends Model
{
	
    protected $table = 'sub_categorias';
    protected $fillable = ['id','id_categoria','sub_categoria','status'];

     public function scopeSearch($query, $scope="")
    {
    	return $query->join('categorias', 'sub_categorias.id_categoria', '=', 'categorias.id')
                        ->where('sub_categoria','LIKE', "$scope%")
                        ->select('sub_categorias.id', 'categoria','sub_categoria','sub_categorias.status');
    }
     public function scopeStatus($query, $scope="")
    {
    	return $query->join('categorias', 'sub_categorias.id_categoria', '=', 'categorias.id')
    				 ->where('sub_categorias.status', "$scope")
    				 ->select('sub_categorias.id', 'categoria','sub_categoria','sub_categorias.status');
    }
     public function scopeCategoria($query, $scope="")
    {
    	return $query->join('categorias', 'sub_categorias.id_categoria', '=', 'categorias.id')
    				 ->where('id_categoria', "$scope")
    				 ->select('sub_categorias.id', 'categoria','sub_categoria','sub_categorias.status');

    }
    public function scopeSearch2($query, $categoria="", $status="", $subcategoria="")
    {
    	return $query->join('categorias', 'sub_categorias.id_categoria', '=', 'categorias.id')
    				 ->where('sub_categoria','LIKE', "$subcategoria%")
    				 ->where('sub_categorias.status', "$status")
    				 ->where('id_categoria', "$categoria")
    				 ->select('sub_categorias.id', 'categoria','sub_categoria','sub_categorias.status');
    }
    public function scopeSearch3($query, $status="", $subcategoria="")
    {
    	return $query->join('categorias', 'sub_categorias.id_categoria', '=', 'categorias.id')
    				 ->where('sub_categoria','LIKE', "$subcategoria%")
    				 ->where('sub_categorias.status', "$status")
    				 ->select('sub_categorias.id', 'categoria','sub_categoria','sub_categorias.status');
    }
    public function scopeSearch4($query, $categoria="", $subcategoria="")
    {
    	return $query->join('categorias', 'sub_categorias.id_categoria', '=', 'categorias.id')
    				 ->where('sub_categoria','LIKE', "$subcategoria%")
    				 ->where('id_categoria', "$categoria")
    				 ->select('sub_categorias.id', 'categoria','sub_categoria','sub_categorias.status');
    }
    public function scopeSearch5($query,  $categoria="", $status="")
    {
    	return $query->join('categorias', 'sub_categorias.id_categoria', '=', 'categorias.id')
    				 ->where('id_categoria', "$categoria")
    				 ->where('sub_categorias.status', "$status")
    				 ->select('sub_categorias.id', 'categoria','sub_categoria','sub_categorias.status');
    }
    

}
