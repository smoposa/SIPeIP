<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Programa extends Model
{
    use HasFactory;

    protected $table = 'programas';

    protected $fillable = [
        'entidad_id',
        'codigo',
        'nombre',
        'descripcion',
        'periodo_inicio',
        'periodo_fin',
        'responsable_id',
        'estado',
        'estado_proceso',
        'usuario_id',
    ];

    protected $casts = [
        'periodo_inicio' => 'integer',
        'periodo_fin' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    /**
     * Entidad propietaria del programa.
     */
    public function entidad(): BelongsTo
    {
        return $this->belongsTo(
            Entidad::class,
            'entidad_id'
        );
    }

    /**
     * Responsable institucional del programa.
     */
    public function responsable(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'responsable_id'
        );
    }

    /**
     * Usuario que registró el programa.
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
     * asociados con el programa.
     */
    public function objetivos(): BelongsToMany
    {
        return $this->belongsToMany(
            Objetivo::class,
            'programa_objetivo',
            'programa_id',
            'objetivo_id'
        )->withTimestamps();
    }

    /**
     * Proyectos pertenecientes al programa.
     */
    public function proyectos(): HasMany
    {
        return $this->hasMany(
            Proyecto::class,
            'programa_id'
        );
    }
}