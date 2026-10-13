<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AgendaOds extends Model
{
    protected $table = 'ods_agendas';

    protected $fillable = ['nombre', 'periodo_inicio', 'periodo_fin', 'descripcion', 'estado'];

    public function ods(): HasMany
    {
        return $this->hasMany(Ods::class, 'agenda_id');
    }
}
