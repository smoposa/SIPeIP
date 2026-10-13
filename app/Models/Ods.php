<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ods extends Model
{
    use HasFactory;

    public function scopeDisponibles(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('estado', 'Activo')->whereHas('agenda', fn ($agenda) => $agenda->where('estado', 'Activo'));
    }

    protected $table = 'ods';

    protected $fillable = [
        'agenda_id',
        'codigo',
        'nombre',
        'descripcion',
        'estado',
    ];

    public function agenda(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AgendaOds::class, 'agenda_id');
    }

    // Objetivos Estratégicos Institucionales
    public function objetivos()
    {
        return $this->hasMany(Objetivo::class);
    }

    // Metas ODS
    public function metas()
    {
        return $this->hasMany(OdsMeta::class);
    }


}