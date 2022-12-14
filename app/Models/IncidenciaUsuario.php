<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidenciaUsuario extends Model
{
    use HasFactory;

    protected $table = 'incidencia_usuario';
    protected $fillable = ['incidencia_id','usuario_id'];
}
