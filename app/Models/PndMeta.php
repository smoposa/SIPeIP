<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PndMeta extends Model
{
    use HasFactory;

    protected $table = 'pnd_metas';

    protected $fillable = [
        'pnd_objetivo_id',
        'numero',
        'descripcion',
        'estado',
    ];

    /**
     * Objetivo nacional al que pertenece la meta.
     */
    public function objetivo(): BelongsTo
    {
        return $this->belongsTo(PndObjetivo::class, 'pnd_objetivo_id');
    }
}