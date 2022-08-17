<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoResponsable extends Model
{
    use HasFactory;

    protected $table = 'proyecto_responsable';
    protected $fillable = ['proyecto_id','usuario_id'];
}
