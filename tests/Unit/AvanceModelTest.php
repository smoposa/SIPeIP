<?php

namespace Tests\Unit;

use App\Models\Avance;
use PHPUnit\Framework\TestCase;

class AvanceModelTest extends TestCase
{
    public function test_calcula_porcentaje_y_alerta_de_cumplimiento(): void
    {
        $avance = new Avance([
            'valor_programado' => 100,
            'valor_ejecutado' => 85,
        ]);

        $this->assertSame(85.0, $avance->porcentaje_cumplimiento);
        $this->assertSame('En riesgo', $avance->alerta);
    }

    public function test_identifica_desviacion_cuando_el_cumplimiento_es_menor_al_ochenta_por_ciento(): void
    {
        $avance = new Avance([
            'valor_programado' => 100,
            'valor_ejecutado' => 60,
        ]);

        $this->assertSame('Desviado', $avance->alerta);
    }
}
