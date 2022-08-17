<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyecto';
    protected $fillable = ['nombre'];

    /**
     * Relación de un Proyecto con multiples actividades
     *
     * @return \Illuminate\Http\Response
     */
    public function actividades() {
        return $this->hasMany(Actividad::class);
    }

    /**
     * Relación de un Aviso con sus Operarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function participantes()
    {
        return $this->belongsToMany(Usuario::class,'proyecto_participante');
    }

    /**
     * Relación de un Aviso con sus Operarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function responsable()
    {
        return $this->belongsToMany(Usuario::class,'proyecto_responsable');
    }
}
