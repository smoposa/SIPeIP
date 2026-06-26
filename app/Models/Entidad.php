<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    use HasFactory;

    protected $table = 'entidades';

    protected $fillable = [
        'codigoInstitucional',
        'ruc',
        'nombre',
        'siglas',
        'tipoEntidad',
        'nivelGobierno',
        'provincia',
        'canton',
        'parroquia',
        'direccion',
        'telefono',
        'correoInstitucional',
        'estado'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}