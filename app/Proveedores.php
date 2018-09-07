<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Proveedores extends Model
{
	
    protected $table = 'proveedores';
    protected $fillable = [	'id', 'nombres', 'ruc', 'id_pais', 'direccion', 'email', 'telefono', 'id_estado', 'id_usuario'];

}
