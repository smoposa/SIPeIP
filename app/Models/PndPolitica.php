<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PndPolitica extends Model
{
    use HasFactory;

    protected $table = 'pnd_politicas';

    protected $fillable = [
        'pnd_objetivo_id',
        'codigo',
        'nombre',
    ];

    /**
     * Objetivo nacional al que pertenece la política.
     */
    public function objetivo(): BelongsTo
    {
        return $this->belongsTo(PndObjetivo::class, 'pnd_objetivo_id');
    }

    /**
     * Estrategias que pertenecen a la política.
     */
    public function estrategias(): HasMany
    {
        return $this->hasMany(PndEstrategia::class, 'pnd_politica_id');
    }
}