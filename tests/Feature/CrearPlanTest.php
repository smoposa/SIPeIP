<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Plan;
use App\Models\Rol;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class CrearPlanTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_usuario_puede_crear_un_plan(): void
    {
        $rol = Rol::factory()->create([
            'nombre' => 'Administrador del Sistema',
        ]);

        $usuario = User::factory()->create([
            'rol_id' => $rol->id,
        ]);

        $this->actingAs($usuario);

        $response = $this->post(route('planes.store'), [
            'nombre' => 'Plan Estratégico Institucional',
            'periodo_inicio' => 2026,
            'periodo_fin' => 2029,
            'descripcion' => 'Plan creado desde PHPUnit',
        ]);

        $response->assertRedirect(route('planes.create'));

        $this->assertDatabaseHas('planes', [
            'nombre' => 'Plan Estratégico Institucional',
        ]);
    }
}