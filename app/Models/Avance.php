<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Avance extends Model
{
    use HasFactory;

    protected $fillable = [
        'proyecto_id', 'entidad_id', 'indicador_id', 'anio', 'periodo',
        'fecha_corte', 'valor_programado', 'valor_ejecutado', 'resultado',
        'observaciones', 'estado', 'created_by', 'updated_by',
    ];

    protected $casts = [
        'anio' => 'integer',
        'fecha_corte' => 'date',
        'valor_programado' => 'decimal:4',
        'valor_ejecutado' => 'decimal:4',
    ];

    protected $appends = ['porcentaje_cumplimiento', 'alerta'];

    public function proyecto(): BelongsTo { return $this->belongsTo(Proyecto::class); }
    public function entidad(): BelongsTo { return $this->belongsTo(Entidad::class); }
    public function indicador(): BelongsTo { return $this->belongsTo(Indicador::class); }
    public function creador(): BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
    public function editor(): BelongsTo { return $this->belongsTo(User::class, 'updated_by'); }

    public function getPorcentajeCumplimientoAttribute(): float
    {
        $programado = (float) $this->valor_programado;
        return $programado > 0 ? round(((float) $this->valor_ejecutado / $programado) * 100, 2) : 0.0;
    }

    public function getAlertaAttribute(): string
    {
        return match (true) {
            $this->porcentaje_cumplimiento >= 100 => 'Cumplido',
            $this->porcentaje_cumplimiento >= 80 => 'En riesgo',
            default => 'Desviado',
        };
    }
}
