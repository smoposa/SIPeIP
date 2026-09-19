<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sector extends Model
{
    use HasFactory;

    /**
     * Tabla asociada al modelo.
     */
    protected $table = 'sectores';

    /**
     * Campos que pueden asignarse masivamente.
     */
    protected $fillable = [
        'macrosector_id',
        'nombre',
        'estado',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    /**
     * Un sector pertenece a un macrosector.
     */
    public function macrosector(): BelongsTo
    {
        return $this->belongsTo(
            Macrosector::class,
            'macrosector_id'
        );
    }

    /**
     * Un sector tiene varios subsectores.
     */
    public function subsectores(): HasMany
    {
        return $this->hasMany(
            Subsector::class,
            'sector_id'
        );
    }
}