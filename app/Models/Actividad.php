<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $table = 'actividad';
    protected $fillable = ['nombre','proyecto_id'];
    
    /**
     * Relación de una Actividad con su proyecto.
     *
     * @return \Illuminate\Http\Response
     */
    public function proyecto() {
        return $this->belongsTo(Proyecto::class);
    }

    /**
     * Relación de una Actividad con multiples incidencias
     *
     * @return \Illuminate\Http\Response
     */
    public function incidencias() {
        return $this->hasMany(Incidencia::class);
    }

    /**
     * Relación de un Aviso con sus Operarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class,'actividad_usuario')->withPivot('responsable','usuario_id','actividad_id');
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
