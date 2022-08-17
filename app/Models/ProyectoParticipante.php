<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoParticipante extends Model
{
    use HasFactory;

    protected $table = 'proyecto_participante';
    protected $fillable = ['proyecto_id','usuario_id'];
}
