<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'planes';

    protected $fillable = [

        'codigo',

        'nombre',

        'tipo',

        'fecha_inicio',

        'fecha_fin',

        'descripcion',

        'estado'

    ];

}