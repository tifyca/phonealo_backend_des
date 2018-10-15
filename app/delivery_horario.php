<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class delivery_horario extends Model
{
       protected $table = 'delivery_horario';
       protected $fillable = ['id','entrada','salida', 'pagado'];

}
