<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Rol;
use App\Models\Plan;
use App\Models\Pnd;
use App\Models\Ods;
use App\Models\Objetivo;
use App\Models\Meta;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CrearIndicadorTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_usuario_puede_crear_un_indicador(): void
    {
        // Rol autorizado
        $rol = Rol::factory()->create([
            'nombre' => 'Administrador del Sistema',
        ]);

        // Usuario
        $usuario = User::factory()->create([
            'rol_id' => $rol->id,
        ]);

        $this->actingAs($usuario);

        // Plan
        $plan = Plan::create([
            'codigo' => 'PEI-' . $usuario->entidad->siglas . '-001',
            'nombre' => 'Plan Estratégico',
            'entidad_id' => $usuario->entidad_id,
            'tipo' => 'Plan Estratégico Institucional',
            'periodo_inicio' => 2026,
            'periodo_fin' => 2029,
            'descripcion' => 'Plan de prueba',
            'estado' => 'Activo',
            'usuario_id' => $usuario->id,
        ]);

        // PND
        $pnd = Pnd::create([
            'eje' => 'Eje Social',
            'codigo' => 'PND-01',
            'nombre' => 'Objetivo PND',
            'descripcion' => 'Prueba',
            'estado' => 'Activo',
        ]);

        // ODS
        $ods = Ods::create([
            'codigo' => 'ODS-01',
            'nombre' => 'Fin de la pobreza',
            'descripcion' => 'Prueba',
            'estado' => 'Activo',
        ]);

        // Objetivo
        $objetivo = Objetivo::create([
            'plan_id' => $plan->id,
            'pnd_id' => $pnd->id,
            'ods_id' => $ods->id,
            'codigo' => 'OEI-01',
            'nombre' => 'Objetivo de prueba',
            'descripcion' => 'Prueba',
            'estado' => 'Activo',
            'usuario_id' => $usuario->id,
        ]);

        // Meta
        $meta = Meta::create([
            'objetivo_id' => $objetivo->id,
            'codigo' => 'META-01',
            'nombre' => 'Meta de prueba',
            'descripcion' => 'Prueba',
            'linea_base' => 10,
            'valor_meta' => 100,
            'unidad_medida' => 'Porcentaje',
            'periodo_inicio' => 2026,
            'periodo_fin' => 2029,
            'responsable_id' => $usuario->id,
            'estado' => 'Activo',
            'usuario_id' => $usuario->id,
        ]);

        // Registrar indicador
        $response = $this->post(route('indicadores.store'), [
            'meta_id' => $meta->id,
            'nombre' => 'Indicador de prueba',
            'tipo' => 'Resultado',
            'formula' => 'A/B*100',
            'unidad_medida' => 'Porcentaje',
            'frecuencia' => 'Mensual',
            'responsable_id' => $usuario->id,
            'estado' => 'Activo',
        ]);

        $response->assertRedirect(route('planes.finalizado'));

        $this->assertDatabaseHas('indicadores', [
            'codigo' => 'IND-01',
            'nombre' => 'Indicador de prueba',
        ]);
    }
}