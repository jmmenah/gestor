<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadUsuario extends Model
{
    use HasFactory;

    protected $table = 'actividad_usuario';
    protected $fillable = ['actividad_id','usuario_id'];
}
