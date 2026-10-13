<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CatalogoDisponible implements ValidationRule
{
    public function __construct(private readonly string $modelo, private readonly ?int $actual = null)
    {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Se puede conservar una alineación histórica, pero no crear otra con datos inactivos.
        if ($this->actual !== null && (int) $value === $this->actual) {
            return;
        }
        $modelo = $this->modelo;
        if (!$modelo::query()->disponibles()->whereKey($value)->exists()) {
            $fail('El catálogo seleccionado o uno de sus niveles superiores está inactivo.');
        }
    }
}
