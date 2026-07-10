<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    /**
     * Tabla asociada.
     */
    protected $table = 'indicadores';

    /**
     * Campos asignables.
     */
    protected $fillable = [

        'meta_id',

        'codigo',

        'nombre',

        'tipo',

        'formula',

        'unidad_medida',

        'frecuencia',

        'responsable_id',

        'estado',

        'usuario_id',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    /**
     * Meta a la que pertenece.
     */
    public function meta()
    {
        return $this->belongsTo(Meta::class);
    }

    /**
     * Responsable del indicador.
     */
    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    /**
     * Usuario que registró.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}