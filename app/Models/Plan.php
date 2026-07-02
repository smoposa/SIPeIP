<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'planes';

    protected $fillable = [

        'codigo',

        'nombre',

        'descripcion',

        'periodo_inicio',

        'periodo_fin',

        'fecha_inicio',

        'fecha_fin',

        'estado',

        'entidad_id',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    public function objetivos()
    {
        return $this->hasMany(Objetivo::class);
    }
}