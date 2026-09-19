<?php

namespace App\Enums;

enum EstadoAdministrativoProyecto: string
{
    case ACTIVO = 'Activo';
    case INACTIVO = 'Inactivo';

    /**
     * Obtener todos los valores disponibles.
     */
    public static function values(): array
    {
        return array_column(
            self::cases(),
            'value'
        );
    }
}