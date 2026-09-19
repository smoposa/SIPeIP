<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subsector extends Model
{
    use HasFactory;

    /**
     * Tabla asociada al modelo.
     */
    protected $table = 'subsectores';

    /**
     * Campos que pueden asignarse masivamente.
     */
    protected $fillable = [
        'sector_id',
        'codigo',
        'nombre',
        'nivel_gobierno',
        'estado',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    /**
     * Un subsector pertenece a un sector.
     */
    public function sector(): BelongsTo
    {
        return $this->belongsTo(
            Sector::class,
            'sector_id'
        );
    }
}