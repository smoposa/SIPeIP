<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Indicador extends Model
{
    protected $table = 'indicadores';

    protected $fillable = [

        'meta_id',

        'codigo',

        'nombre',

        'descripcion',

        'formula',

        'linea_base',

        'meta',

        'valor_actual',

        'unidad_medida',

        'frecuencia',

        'estado',

    ];

    protected $casts = [

        'linea_base'   => 'decimal:2',

        'meta'         => 'decimal:2',

        'valor_actual' => 'decimal:2',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    public function meta(): BelongsTo
    {
        return $this->belongsTo(Meta::class);
    }

}