<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    protected $table = 'objetivos';

    protected $fillable = [
        'tipo',
        'objetivo_padre_id',
        'codigo',
        'nombre',
        'descripcion',
        'color',
        'icono',
        'numero_metas',
        'documento',
        'estado',
    ];

    // Relaciones

    public function padre()
    {
        return $this->belongsTo(Objetivo::class, 'objetivo_padre_id');
    }

    public function hijos()
    {
        return $this->hasMany(Objetivo::class, 'objetivo_padre_id');
    }
}