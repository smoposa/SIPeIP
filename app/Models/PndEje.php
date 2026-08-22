<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PndEje extends Model
{
    use HasFactory;

    protected $table = 'pnd_ejes';

    protected $fillable = [
        'pnd_id',
        'numero',
        'nombre',
        'descripcion',
        'estado',
    ];

    /**
     * PND al que pertenece el eje.
     */
    public function pnd(): BelongsTo
    {
        return $this->belongsTo(Pnd::class, 'pnd_id');
    }

    /**
     * Objetivos nacionales que pertenecen al eje.
     */
    public function objetivos(): HasMany
    {
        return $this->hasMany(PndObjetivo::class, 'pnd_eje_id');
    }
}