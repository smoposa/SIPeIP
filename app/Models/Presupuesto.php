<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Presupuesto extends Model
{
    use HasFactory;

    protected $fillable = [
        'proyecto_id', 'entidad_id', 'anio', 'periodo', 'fecha_corte',
        'monto_programado', 'presupuesto_vigente', 'monto_ejecutado',
        'observaciones', 'estado', 'created_by', 'updated_by',
    ];

    protected $casts = [
        'anio' => 'integer',
        'fecha_corte' => 'date',
        'monto_programado' => 'decimal:2',
        'presupuesto_vigente' => 'decimal:2',
        'monto_ejecutado' => 'decimal:2',
    ];

    protected $appends = ['porcentaje_ejecucion', 'alerta'];

    public function proyecto(): BelongsTo { return $this->belongsTo(Proyecto::class); }
    public function entidad(): BelongsTo { return $this->belongsTo(Entidad::class); }
    public function creador(): BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
    public function editor(): BelongsTo { return $this->belongsTo(User::class, 'updated_by'); }

    public function getPorcentajeEjecucionAttribute(): float
    {
        $programado = (float) $this->monto_programado;
        return $programado > 0 ? round(((float) $this->monto_ejecutado / $programado) * 100, 2) : 0.0;
    }

    public function getAlertaAttribute(): string
    {
        return match (true) {
            $this->porcentaje_ejecucion >= 100 => 'Cumplido',
            $this->porcentaje_ejecucion >= 80 => 'En riesgo',
            default => 'Desviado',
        };
    }
}
