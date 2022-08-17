<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Model
{
    use HasApiTokens;
    
    protected $table = 'usuario';
    protected $fillable = ['usuario', 'password', 'email', 'activo'];
    protected $hidden = ['password', 'remember_token'];

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'usuario_rol');
    }

    /**
     * Relación de un Usuario con su Ficha Personal.
     *
     * @return \Illuminate\Http\Response
     */
    public function personal() {
        return $this->hasOne('App\Models\Personal');
    }

    /**
     * Añade valores a la sesion.
     *
     * @param array $roles
     * @return \Illuminate\Http\Response
     */
    public function setSession($roles)
    {
        Session::put(
            [
                'rol' => $roles,
                'rol_id' => $roles[0]['id'],
                'rol_nombre' => $roles[0]['nombre'],
                'usuario' => $this->usuario,
                'usuario_id' => $this->id
            ]
        );
    }

    /**
     * Cifra el password.
     *
     * @param string $pass
     * @return \Illuminate\Http\Response
     */
    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = Hash::make($pass);
    }
}
