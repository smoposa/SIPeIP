<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'estado_proceso',
        'version',
        'usuario_id',
    ];

    protected $casts = [
        'periodo_inicio' => 'integer',
        'periodo_fin' => 'integer',
        'version' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    /**
     * Entidad propietaria del plan institucional.
     */
    public function entidad(): BelongsTo
    {
        return $this->belongsTo(
            Entidad::class,
            'entidad_id'
        );
    }

    /**
     * Usuario que registró el plan.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'usuario_id'
        );
    }

    /**
     * Objetivos Estratégicos Institucionales
     * pertenecientes al plan.
     */
    public function objetivos(): HasMany
    {
        return $this->hasMany(
            Objetivo::class,
            'plan_id'
        );
    }
}