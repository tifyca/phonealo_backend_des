<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Empleados extends Model
{
	
    protected $table = 'empleados';
    protected $fillable = [	'id', 'id_cargo', 'usuario',  'ci', 'clave', 'nombres',  'direccion', 'email', 'telefono', 'id_estado', 'id_usuario'];

}
