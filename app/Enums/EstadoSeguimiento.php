<?php

namespace App\Enums;

enum EstadoSeguimiento: string
{
    case BORRADOR = 'Borrador';
    case CERRADO = 'Cerrado';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
