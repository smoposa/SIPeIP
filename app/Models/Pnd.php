<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pnd extends Model
{
    use HasFactory;

    protected $table = 'pnd';

    protected $fillable = [
        'nombre',
        'periodo_inicio',
        'periodo_fin',
        'descripcion',
        'estado',
    ];

    /**
     * Ejes que pertenecen al PND.
     */
    public function ejes(): HasMany
    {
        return $this->hasMany(PndEje::class, 'pnd_id');
    }
}