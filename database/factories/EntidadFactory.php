<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entidad>
 */
class EntidadFactory extends Factory
{
    public function definition(): array
    {
    return [

        'codigoInstitucional' => fake()->unique()->numerify('ENT###'),

        'ruc' => fake()->unique()->numerify('##########001'),

        'nombre' => fake()->company(),

        'siglas' => fake()->unique()->lexify('???'),

        'tipoEntidad' => 'Ministerio',

        'nivelGobierno' => 'Nacional',

        'provincia' => 'Pichincha',

        'canton' => 'Quito',

        'parroquia' => 'Iñaquito',

        'direccion' => fake()->address(),

        'telefono' => fake()->numerify('09########'),

        'estado' => 'Activo',

    ];
    }
}