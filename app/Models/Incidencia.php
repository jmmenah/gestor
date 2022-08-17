<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $table = 'incidencia';
    protected $fillable = ['nombre','actividad_id'];

    /**
     * Relación de una Incidencia con su actividad.
     *
     * @return \Illuminate\Http\Response
     */
    public function actividad() {
        return $this->belongsTo(Actividad::class);
    }

    /**
     * Relación de un Aviso con sus Operarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class,'incidencia_usuario')->withPivot('responsable','usuario_id','incidencia_id');
    }

    /**
     * Relación de un Aviso con sus responsable.
     *
     * @return \Illuminate\Http\Response
     */
    public function responsable()
    {
        return $this->usuarios()->where('responsable',1);
    }
}
