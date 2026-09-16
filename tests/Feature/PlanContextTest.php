<?php

namespace Tests\Feature;

use App\Models\Entidad;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlanContextTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_sin_entidad_recibe_mensaje_comprensible(): void
    {
        $rol = Rol::factory()->create([
            'nombre' => 'Administrador del Sistema',
            'codigo' => 'ADMIN_SISTEMA',
        ]);

        $usuario = User::factory()->create([
            'rol_id' => $rol->id,
            'entidad_id' => null,
        ]);

        $response = $this->actingAs($usuario)
            ->get(route('planes.index'));

        $response
            ->assertOk()
            ->assertViewIs('planes.index')
            ->assertViewHas('totalPlanes', 0)
            ->assertSee(
                'El usuario no tiene una entidad institucional asignada.'
            );
    }

    public function test_usuario_con_entidad_inactiva_recibe_mensaje_comprensible(): void
    {
        $rol = Rol::factory()->create([
            'nombre' => 'Administrador del Sistema',
            'codigo' => 'ADMIN_SISTEMA',
        ]);

        $entidad = Entidad::factory()->create([
            'estado' => 'Inactivo',
        ]);

        $usuario = User::factory()->create([
            'rol_id' => $rol->id,
            'entidad_id' => $entidad->id,
        ]);

        $response = $this->actingAs($usuario)
            ->get(route('planes.index'));

        $response
            ->assertOk()
            ->assertViewIs('planes.index')
            ->assertViewHas('totalPlanes', 0)
            ->assertSee(
                'La entidad institucional asignada al usuario se encuentra inactiva.'
            );
    }

    public function test_entidad_sin_siglas_no_puede_iniciar_creacion_de_plan(): void
    {
        $rol = Rol::factory()->create([
            'nombre' => 'Administrador del Sistema',
            'codigo' => 'ADMIN_SISTEMA',
        ]);

        $entidad = Entidad::factory()->create([
            'siglas' => null,
            'estado' => 'Activo',
        ]);

        $usuario = User::factory()->create([
            'rol_id' => $rol->id,
            'entidad_id' => $entidad->id,
        ]);

        $response = $this->actingAs($usuario)
            ->followingRedirects()
            ->get(route('planes.create'));

        $response
            ->assertOk()
            ->assertViewIs('planes.index')
            ->assertSee(
                'La entidad del usuario no tiene siglas institucionales registradas.'
            );
    }
}