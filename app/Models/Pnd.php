<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pnd extends Model
{
    use HasFactory;

    protected $table = 'pnd';

    protected $fillable = [
        'eje',
        'codigo',
        'nombre',
        'descripcion',
        'estado',
    ];
}