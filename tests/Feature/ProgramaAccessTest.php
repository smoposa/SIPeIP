<?php

namespace Tests\Feature;

use App\Models\Entidad;
use App\Models\Programa;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProgramaAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_autorizado_puede_acceder_a_programas(): void
    {
        $rol = Rol::factory()->create([
            'nombre' => 'Director de Inversión Pública',
            'codigo' => 'DIRECTOR_INVERSION',
            'estado' => 'Activo',
        ]);

        $entidad = Entidad::factory()->create([
            'estado' => 'Activo',
        ]);

        $usuario = User::factory()->create([
            'rol_id' => $rol->id,
            'entidad_id' => $entidad->id,
            'estado' => 'Activo',
        ]);

        $response = $this
            ->actingAs($usuario)
            ->get(route('programas.listar'));

        $response->assertOk();
    }

    public function test_usuario_sin_permiso_no_puede_acceder_a_programas(): void
    {
        $rol = Rol::factory()->create([
            'nombre' => 'Administrador Institucional',
            'codigo' => 'ADMIN_INSTITUCIONAL',
            'estado' => 'Activo',
        ]);

        $entidad = Entidad::factory()->create([
            'estado' => 'Activo',
        ]);

        $usuario = User::factory()->create([
            'rol_id' => $rol->id,
            'entidad_id' => $entidad->id,
            'estado' => 'Activo',
        ]);

        $response = $this
            ->actingAs($usuario)
            ->get(route('programas.listar'));

        $response->assertForbidden();
    }

    public function test_listado_solo_muestra_programas_de_la_entidad(): void
    {
        $rol = Rol::factory()->create([
            'nombre' => 'Director de Inversión Pública',
            'codigo' => 'DIRECTOR_INVERSION',
            'estado' => 'Activo',
        ]);

        $entidadUsuario = Entidad::factory()->create([
            'estado' => 'Activo',
        ]);

        $otraEntidad = Entidad::factory()->create([
            'estado' => 'Activo',
        ]);

        $usuario = User::factory()->create([
            'rol_id' => $rol->id,
            'entidad_id' => $entidadUsuario->id,
            'estado' => 'Activo',
        ]);

        $usuarioOtraEntidad = User::factory()->create([
            'rol_id' => $rol->id,
            'entidad_id' => $otraEntidad->id,
            'estado' => 'Activo',
        ]);

        Programa::query()->create([
            'entidad_id' => $entidadUsuario->id,
            'codigo' => 'PROG-001',
            'nombre' => 'Programa de la entidad autenticada',
            'descripcion' => 'Registro visible para el usuario.',
            'periodo_inicio' => 2026,
            'periodo_fin' => 2029,
            'responsable_id' => $usuario->id,
            'estado' => 'Activo',
            'estado_proceso' => 'Borrador',
            'usuario_id' => $usuario->id,
        ]);

        Programa::query()->create([
            'entidad_id' => $otraEntidad->id,
            'codigo' => 'PROG-001',
            'nombre' => 'Programa de otra entidad',
            'descripcion' => 'Este registro no debe ser visible.',
            'periodo_inicio' => 2026,
            'periodo_fin' => 2029,
            'responsable_id' => $usuarioOtraEntidad->id,
            'estado' => 'Activo',
            'estado_proceso' => 'Borrador',
            'usuario_id' => $usuarioOtraEntidad->id,
        ]);

        $response = $this
            ->actingAs($usuario)
            ->get(route('programas.listar'));

        $response->assertOk();

        $response->assertSee(
            'Programa de la entidad autenticada'
        );

        $response->assertDontSee(
            'Programa de otra entidad'
        );
    }

    public function test_usuario_no_puede_consultar_programa_de_otra_entidad(): void
    {
        $rol = Rol::factory()->create([
            'nombre' => 'Director de Inversión Pública',
            'codigo' => 'DIRECTOR_INVERSION',
            'estado' => 'Activo',
        ]);

        $entidadUsuario = Entidad::factory()->create([
            'estado' => 'Activo',
        ]);

        $otraEntidad = Entidad::factory()->create([
            'estado' => 'Activo',
        ]);

        $usuario = User::factory()->create([
            'rol_id' => $rol->id,
            'entidad_id' => $entidadUsuario->id,
            'estado' => 'Activo',
        ]);

        $usuarioOtraEntidad = User::factory()->create([
            'rol_id' => $rol->id,
            'entidad_id' => $otraEntidad->id,
            'estado' => 'Activo',
        ]);

        $programaOtraEntidad = Programa::query()->create([
            'entidad_id' => $otraEntidad->id,
            'codigo' => 'PROG-001',
            'nombre' => 'Programa restringido',
            'descripcion' => null,
            'periodo_inicio' => 2026,
            'periodo_fin' => 2029,
            'responsable_id' => $usuarioOtraEntidad->id,
            'estado' => 'Activo',
            'estado_proceso' => 'Borrador',
            'usuario_id' => $usuarioOtraEntidad->id,
        ]);

        $response = $this
            ->actingAs($usuario)
            ->get(
                route(
                    'programas.detalle',
                    $programaOtraEntidad->id
                )
            );

        $response->assertNotFound();
    }
}