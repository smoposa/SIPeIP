<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;

    protected $table = 'programas';

    protected $fillable = [

        'codigo',

        'nombre',

        'descripcion',

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

    /**
     * Responsable del programa.
     */
    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    /**
     * Usuario que registró el programa.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Objetivos Estratégicos asociados.
     */
    public function objetivos()
    {
        return $this->belongsToMany(
            Objetivo::class,
            'programa_objetivo'
        );
    }

}