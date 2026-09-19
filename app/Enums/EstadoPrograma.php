<?php

namespace App\Enums;

enum EstadoPrograma: string
{
    case ACTIVO = 'Activo';
    case INACTIVO = 'Inactivo';

    /**
     * Obtener todos los valores permitidos.
     */
    public static function values(): array
    {
        return array_column(
            self::cases(),
            'value'
        );
    }
}