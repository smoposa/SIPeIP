<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


use App\Models\Rol;
use App\Models\Entidad;
use App\Models\Plan;
use App\Models\Meta;

#[Fillable([
    'name',
    'email',
    'password',

    'rol_id',
    'entidad_id',

    'identificacion',
    'nombres',
    'apellidos',

    'cargo',
    'estado'
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    public function entidad()
    {
        return $this->belongsTo(Entidad::class);
    }

    public function planes()
    {
        return $this->hasMany(Plan::class, 'usuario_id');
    }

    public function objetivos()
    {
        return $this->hasMany(Objetivo::class, 'usuario_id');
    }


/**
 * Metas registradas por el usuario.
 */
public function metasRegistradas()
{
    return $this->hasMany(Meta::class, 'usuario_id');
}

/**
 * Metas bajo responsabilidad del usuario.
 */
public function metasResponsables()
{
    return $this->hasMany(Meta::class, 'responsable_id');
}

/**
 * Indicadores bajo su responsabilidad.
 */
public function indicadoresResponsables()
{
    return $this->hasMany(Indicador::class, 'responsable_id');
}

/**
 * Indicadores registrados por el usuario.
 */
public function indicadoresRegistrados()
{
    return $this->hasMany(Indicador::class, 'usuario_id');
}


}