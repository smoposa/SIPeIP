<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    protected $table = 'entidades';

    protected $fillable = [
        'codigoInstitucional',
        'ruc',
        'nombre',
        'tipoEntidad',
        'nivelGobierno',
        'provincia',
        'canton',
        'parroquia',
        'direccion',
        'telefono',
        'estado'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}