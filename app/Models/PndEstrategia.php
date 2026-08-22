<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PndEstrategia extends Model
{
    use HasFactory;

    protected $table = 'pnd_estrategias';

    protected $fillable = [
        'pnd_politica_id',
        'codigo',
        'descripcion',
    ];

    /**
     * Política a la que pertenece la estrategia.
     */
    public function politica(): BelongsTo
    {
        return $this->belongsTo(PndPolitica::class, 'pnd_politica_id');
    }
}