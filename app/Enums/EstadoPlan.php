<?php

namespace App\Enums;

enum EstadoPlan: string
{
    case BORRADOR = 'Borrador';
    case EN_REVISION = 'En revisión';
    case OBSERVADO = 'Observado';
    case APROBADO = 'Aprobado';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}