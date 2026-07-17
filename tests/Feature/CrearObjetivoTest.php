<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Rol;
use App\Models\Plan;
use App\Models\Pnd;
use App\Models\Ods;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CrearObjetivoTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_usuario_puede_crear_un_objetivo(): void
    {
        // Rol autorizado
        $rol = Rol::factory()->create([
            'nombre' => 'Administrador del Sistema',
        ]);

        // Usuario
        $usuario = User::factory()->create([
            'rol_id' => $rol->id,
        ]);

        // Autenticación
        $this->actingAs($usuario);

        // Plan
        $plan = Plan::create([
            'codigo' => 'PEI-' . $usuario->entidad->siglas . '-001',
            'nombre' => 'Plan Estratégico',
            'entidad_id' => $usuario->entidad_id,
            'tipo' => 'Plan Estratégico Institucional',
            'periodo_inicio' => 2026,
            'periodo_fin' => 2029,
            'descripcion' => 'Plan para pruebas',
            'estado' => 'Activo',
            'usuario_id' => $usuario->id,
        ]);

        // PND
        $pnd = Pnd::create([
            'eje' => 'Eje Social',
            'codigo' => 'PND-01',
            'nombre' => 'Garantizar derechos',
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

        // Registrar objetivo
        $response = $this->post(route('objetivos.store'), [
            'plan_id' => $plan->id,
            'pnd_id' => $pnd->id,
            'ods_id' => $ods->id,
            'nombre' => 'Objetivo de prueba',
            'descripcion' => 'Creado desde PHPUnit',
        ]);

        $response->assertRedirect(route('objetivos.create'));

        $this->assertDatabaseHas('objetivos', [
            'codigo' => 'OEI-01',
            'nombre' => 'Objetivo de prueba',
        ]);
    }
}