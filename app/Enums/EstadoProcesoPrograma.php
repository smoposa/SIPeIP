<?php

namespace App\Enums;

enum EstadoProcesoPrograma: string
{
    case BORRADOR = 'Borrador';
    case EN_REVISION = 'En revisión';
    case OBSERVADO = 'Observado';
    case PRIORIZADO = 'Priorizado';
    case NEGADO = 'Negado';

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