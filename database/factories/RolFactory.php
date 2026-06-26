<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rol>
 */
class RolFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => fake()->unique()->jobTitle(),
            'descripcion' => fake()->sentence(),
            'estado' => 'Activo',
        ];
    }
}