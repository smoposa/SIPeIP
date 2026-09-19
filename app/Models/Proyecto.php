<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';

    protected $fillable = [
        'programa_id',
        'entidad_id',
        'subsector_id',
        'codigo',
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'presupuesto_aprobado',
        'responsable_id',
        'estado',
        'estado_administrativo',
        'estado_proceso',
        'usuario_id',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'presupuesto_aprobado' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    /**
     * Programa de inversión al que pertenece el proyecto.
     */
    public function programa(): BelongsTo
    {
        return $this->belongsTo(
            Programa::class,
            'programa_id'
        );
    }

    /**
     * Entidad propietaria del proyecto.
     */
    public function entidad(): BelongsTo
    {
        return $this->belongsTo(
            Entidad::class,
            'entidad_id'
        );
    }

    /**
     * Subsector de intervención del proyecto.
     */
    public function subsector(): BelongsTo
    {
        return $this->belongsTo(
            Subsector::class,
            'subsector_id'
        );
    }

    /**
     * Responsable institucional del proyecto.
     */
    public function responsable(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'responsable_id'
        );
    }

    /**
     * Usuario que registró el proyecto.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'usuario_id'
        );
    }
}