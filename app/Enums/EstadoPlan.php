<?php

namespace App\Enums;

enum EstadoPlan: string
{
    case ACTIVO = 'Activo';
    case INACTIVO = 'Inactivo';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}