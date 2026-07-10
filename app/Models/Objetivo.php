<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Meta;

class Objetivo extends Model
{
    use HasFactory;

    protected $table = 'objetivos';

    protected $fillable = [
        'plan_id',
        'pnd_id',
        'ods_id',
        'codigo',
        'nombre',
        'descripcion',
        'estado',
        'usuario_id',
    ];

    /**
     * Plan al que pertenece el objetivo.
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * Objetivo del Plan Nacional de Desarrollo.
     */
    public function pnd()
    {
        return $this->belongsTo(Pnd::class);
    }

    /**
     * Objetivo de Desarrollo Sostenible.
     */
    public function ods()
    {
        return $this->belongsTo(Ods::class);
    }

    /**
     * Usuario que registró el objetivo.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

/**
 * Metas del objetivo.
 */
public function metas()
{
    return $this->hasMany(Meta::class);
}

}