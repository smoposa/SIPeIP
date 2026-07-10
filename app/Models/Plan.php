<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'planes';

    protected $fillable = [

        'codigo',

        'nombre',

        'entidad_id',

        'tipo',

        'periodo_inicio',

        'periodo_fin',

        'descripcion',

        'estado',

        'usuario_id',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    /**
     * Un plan pertenece a una entidad.
     */
    public function entidad()
    {
        return $this->belongsTo(Entidad::class);
    }

    /**
     * Un plan fue registrado por un usuario.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Un plan tiene muchos objetivos estratégicos.
     */
    public function objetivos()
    {
        return $this->hasMany(Objetivo::class);
    }
}