<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meta extends Model
{
    protected $table = 'metas';

    protected $fillable = [

        'objetivo_id',

        'codigo',

        'nombre',

        'descripcion',

        'valor_meta',

        'unidad_medida',

        'fecha_inicio',

        'fecha_fin',

        'estado',

    ];

    protected $casts = [

        'valor_meta'   => 'decimal:2',

        'fecha_inicio' => 'date',

        'fecha_fin'    => 'date',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    public function objetivo(): BelongsTo
    {
        return $this->belongsTo(Objetivo::class);
    }

    public function indicadores(): HasMany
    {
        return $this->hasMany(Indicador::class);
    }
}