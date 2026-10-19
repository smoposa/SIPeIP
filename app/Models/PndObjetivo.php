<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



class PndObjetivo extends Model
{
    use HasFactory;

    public function scopeDisponibles(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('estado', 'Activo')->whereHas('eje', fn ($eje) => $eje->where('estado', 'Activo')->whereHas('pnd', fn ($pnd) => $pnd->where('estado', 'Activo')));
    }

    protected $table = 'pnd_objetivos';

    protected $fillable = [
        'estado',
        'pnd_eje_id',
        'numero',
        'nombre',
        'descripcion',
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