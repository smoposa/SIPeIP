<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meta extends Model
{
    use HasFactory;

    protected $table = 'metas';

    protected $fillable = [
        'objetivo_id',
        'codigo',
        'nombre',
        'descripcion',
        'linea_base',
        'valor_meta',
        'unidad_medida',
        'periodo_inicio',
        'periodo_fin',
        'responsable_id',
        'estado',
        'usuario_id',
    ];

    protected function casts(): array
    {
        return [
            'linea_base' => 'decimal:2',
            'valor_meta' => 'decimal:2',
            'periodo_inicio' => 'integer',
            'periodo_fin' => 'integer',
        ];
    }

    public function objetivo(): BelongsTo
    {
        return $this->belongsTo(
            Objetivo::class
        );
    }

    public function responsable(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'responsable_id'
        );
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'usuario_id'
        );
    }

    public function indicadores(): HasMany
    {
        return $this->hasMany(
            Indicador::class
        );
    }
}