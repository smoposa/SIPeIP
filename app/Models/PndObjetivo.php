<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PndObjetivo extends Model
{
    use HasFactory;

    protected $table = 'pnd_objetivos';

    protected $fillable = [
        'pnd_eje_id',
        'numero',
        'nombre',
        'descripcion',
        'estado',
    ];

    /**
     * Eje al que pertenece el objetivo nacional.
     */
    public function eje(): BelongsTo
    {
        return $this->belongsTo(PndEje::class, 'pnd_eje_id');
    }

    /**
     * Políticas que pertenecen al objetivo nacional.
     */
    public function politicas(): HasMany
    {
        return $this->hasMany(PndPolitica::class, 'pnd_objetivo_id');
    }

    /**
     * Metas que pertenecen al objetivo nacional.
     */
    public function metas(): HasMany
    {
        return $this->hasMany(PndMeta::class, 'pnd_objetivo_id');
    }
}