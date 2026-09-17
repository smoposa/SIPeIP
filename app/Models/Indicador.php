<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Indicador extends Model
{
    use HasFactory;

    protected $table = 'indicadores';

    protected $fillable = [
        'meta_id',
        'codigo',
        'nombre',
        'tipo',
        'formula',
        'unidad_medida',
        'frecuencia',
        'responsable_id',
        'estado',
        'usuario_id',
    ];

    /**
     * Meta institucional a la que pertenece.
     */
    public function meta(): BelongsTo
    {
        return $this->belongsTo(
            Meta::class
        );
    }

    /**
     * Usuario responsable del indicador.
     */
    public function responsable(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'responsable_id'
        );
    }

    /**
     * Usuario que registró el indicador.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'usuario_id'
        );
    }
}