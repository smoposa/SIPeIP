<?php

namespace App\Enums;

enum EstadoProcesoProyecto: string
{
    case BORRADOR = 'Borrador';
    case EN_REVISION = 'En revisión';
    case OBSERVADO = 'Observado';
    case PRIORIZADO = 'Priorizado';
    case NEGADO = 'Negado';

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