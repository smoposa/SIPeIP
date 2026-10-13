<?php

namespace App\Services;

class CatalogoDefinition
{
    public static function obtener(string $recurso): array
    {
        $definiciones = config('catalogos', []);
        abort_unless(array_key_exists($recurso, $definiciones), 404);

        return $definiciones[$recurso];
    }
}
