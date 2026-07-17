<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PermisosTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_con_rol_autorizado_puede_acceder_a_planes(): void
    {
        $rol = Rol::factory()->create([
            'nombre' => 'Administrador del Sistema',
        ]);

        $usuario = User::factory()->create([
            'rol_id' => $rol->id,
        ]);

        $response = $this->actingAs($usuario)
            ->get(route('planes.listar'));

        $response->assertStatus(200);
    }

    public function test_usuario_sin_permiso_no_puede_acceder_a_planes(): void
    {
        $rol = Rol::factory()->create([
            'nombre' => 'Administrador Institucional',
        ]);

        $usuario = User::factory()->create([
            'rol_id' => $rol->id,
        ]);

        $response = $this->actingAs($usuario)
            ->get(route('planes.listar'));

        $response->assertForbidden();
    }
}