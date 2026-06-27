<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plan extends Model
{
    protected $table = 'planes';

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'periodo_inicio',
        'periodo_fin',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'entidad_id',
    ];

    public function entidad(): BelongsTo
    {
        return $this->belongsTo(Entidad::class);
    }
}