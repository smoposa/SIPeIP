<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Objetivo extends Model
{
    protected $table = 'objetivos';

    protected $fillable = [

        'tipo',
        'entidad_id',
        'plan_id',
        'codigo',
        'eje',
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'estado',

    ];

    protected $casts = [

        'fecha_inicio' => 'date',
        'fecha_fin'    => 'date',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    public function entidad(): BelongsTo
    {
        return $this->belongsTo(Entidad::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function metas(): HasMany
    {
        return $this->hasMany(Meta::class);
    }
}