<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyectos';

    protected $fillable = [

        'programa_id',

        'codigo',

        'nombre',

        'descripcion',

        'fecha_inicio',

        'fecha_fin',

        'presupuesto_aprobado',

        'responsable_id',

        'estado',

        'usuario_id',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    // Programa
    public function programa()
    {
        return $this->belongsTo(Programa::class);
    }

    // Responsable
    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    // Usuario que registra
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

}