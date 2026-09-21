<?php

namespace App\Enums;

enum PeriodoSeguimiento: string
{
    case PRIMER_TRIMESTRE = 'Primer trimestre';
    case SEGUNDO_TRIMESTRE = 'Segundo trimestre';
    case TERCER_TRIMESTRE = 'Tercer trimestre';
    case CUARTO_TRIMESTRE = 'Cuarto trimestre';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
