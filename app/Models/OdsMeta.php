<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OdsMeta extends Model
{
    use HasFactory;

    public function scopeDisponibles(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('estado', 'Activo')->whereHas('ods', fn ($ods) => $ods->disponibles());
    }

    protected $table = 'ods_metas';

    protected $fillable = [
        'ods_id',
        'codigo',
        'nombre',
        'descripcion',
        'estado'
    ];

    public function ods()
    {
        return $this->belongsTo(Ods::class);
    }
}