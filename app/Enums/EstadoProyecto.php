<?php

namespace App\Enums;

enum EstadoProyecto: string
{
    case PLANIFICADO = 'Planificado';
    case EN_EJECUCION = 'En ejecución';
    case FINALIZADO = 'Finalizado';
    case SUSPENDIDO = 'Suspendido';

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