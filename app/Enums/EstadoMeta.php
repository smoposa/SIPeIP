<?php

namespace App\Enums;

enum EstadoMeta: string
{
    case ACTIVO = 'Activo';
    case INACTIVO = 'Inactivo';

    public static function valores(): array
    {
        return array_column(
            self::cases(),
            'value'
        );
    }
}
