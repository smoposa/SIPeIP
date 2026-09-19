<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Macrosector extends Model
{
    use HasFactory;

    /**
     * Tabla asociada al modelo.
     */
    protected $table = 'macrosectores';

    /**
     * Campos que pueden asignarse masivamente.
     */
    protected $fillable = [
        'nombre',
        'estado',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    /**
     * Un macrosector tiene varios sectores.
     */
    public function sectores(): HasMany
    {
        return $this->hasMany(
            Sector::class,
            'macrosector_id'
        );
    }
}