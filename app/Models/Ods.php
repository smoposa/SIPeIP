<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ods extends Model
{
    use HasFactory;

    protected $table = 'ods';

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'estado',
    ];

    /**
     * Objetivos Estratégicos Institucionales
     */
    public function objetivos()
    {
        return $this->hasMany(Objetivo::class);
    }
}