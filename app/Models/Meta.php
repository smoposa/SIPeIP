<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
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

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    // Objetivo al que pertenece
    public function objetivo()
    {
        return $this->belongsTo(Objetivo::class);
    }

    // Responsable de la meta
    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    // Usuario que registró la meta
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    // Indicadores de la meta
    public function indicadores()
    {
        return $this->hasMany(Indicador::class);
    }
}