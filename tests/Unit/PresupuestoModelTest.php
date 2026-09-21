<?php

namespace Tests\Unit;

use App\Models\Presupuesto;
use PHPUnit\Framework\TestCase;

class PresupuestoModelTest extends TestCase
{
    public function test_calcula_porcentaje_y_alerta_de_ejecucion(): void
    {
        $presupuesto = new Presupuesto([
            'monto_programado' => 200000,
            'monto_ejecutado' => 200000,
        ]);

        $this->assertSame(100.0, $presupuesto->porcentaje_ejecucion);
        $this->assertSame('Cumplido', $presupuesto->alerta);
    }

    public function test_evitar_division_para_programacion_en_cero(): void
    {
        $presupuesto = new Presupuesto([
            'monto_programado' => 0,
            'monto_ejecutado' => 100,
        ]);

        $this->assertSame(0.0, $presupuesto->porcentaje_ejecucion);
    }
}
