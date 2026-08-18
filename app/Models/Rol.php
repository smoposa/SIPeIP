<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'nombre',
        'codigo',
        'descripcion',
        'estado',
        'asignable_institucion',
    ];

    /**
     * Conversión de tipos de atributos.
     */
    protected function casts(): array
    {
        return [
            'asignable_institucion' => 'boolean',
        ];
    }

    /**
     * Usuarios que tienen asignado este rol.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}