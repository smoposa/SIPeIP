<?php

namespace Tests\Feature;

use App\Models\Entidad;
use App\Models\Macrosector;
use App\Models\Programa;
use App\Models\Proyecto;
use App\Models\Rol;
use App\Models\Sector;
use App\Models\Subsector;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProyectoAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_autorizado_puede_acceder_a_proyectos(): void
    {
        $usuario = $this->crearUsuario(
            'DIRECTOR_INVERSION',
            'Director de Inversión Pública'
        );

        $response = $this
            ->actingAs($usuario)
            ->get(route('proyectos.listar'));

        $response->assertOk();
    }

    public function test_usuario_sin_permiso_no_puede_acceder_a_proyectos(): void
    {
        $usuario = $this->crearUsuario(
            'ADMIN_INSTITUCIONAL',
            'Administrador Institucional'
        );

        $response = $this
            ->actingAs($usuario)
            ->get(route('proyectos.listar'));

        $response->assertForbidden();
    }

    public function test_listado_solo_muestra_proyectos_de_la_entidad(): void
    {
        $usuarioEntidadUno = $this->crearUsuario(
            'DIRECTOR_INVERSION',
            'Director de Inversión Pública'
        );

        $usuarioEntidadDos = $this->crearUsuario(
            'DIRECTOR_INVERSION',
            'Director de Inversión Pública'
        );

        $proyectoEntidadUno = $this->crearProyecto(
            $usuarioEntidadUno,
            'Proyecto visible'
        );

        $proyectoEntidadDos = $this->crearProyecto(
            $usuarioEntidadDos,
            'Proyecto no visible'
        );

        $response = $this
            ->actingAs($usuarioEntidadUno)
            ->get(route('proyectos.listar'));

        $response->assertOk();
        $response->assertSee($proyectoEntidadUno->nombre);
        $response->assertDontSee($proyectoEntidadDos->nombre);
    }

    public function test_usuario_no_puede_consultar_proyecto_de_otra_entidad(): void
    {
        $usuarioEntidadUno = $this->crearUsuario(
            'DIRECTOR_INVERSION',
            'Director de Inversión Pública'
        );

        $usuarioEntidadDos = $this->crearUsuario(
            'DIRECTOR_INVERSION',
            'Director de Inversión Pública'
        );

        $proyectoAjeno = $this->crearProyecto(
            $usuarioEntidadDos,
            'Proyecto de otra entidad'
        );

        $response = $this
            ->actingAs($usuarioEntidadUno)
            ->get(
                route(
                    'proyectos.detalle',
                    $proyectoAjeno->id
                )
            );

        $response->assertNotFound();
    }

    private function crearUsuario(
        string $codigoRol,
        string $nombreRol
    ): User {
        $entidad = Entidad::factory()->create([
            'estado' => 'Activo',
        ]);

        $rol = Rol::query()->firstOrCreate(
            [
                'codigo' => $codigoRol,
            ],
            [
                'nombre' => $nombreRol,
                'descripcion' => 'Rol creado para pruebas.',
                'estado' => 'Activo',
            ]
        );

        return User::factory()->create([
            'rol_id' => $rol->id,
            'entidad_id' => $entidad->id,
            'estado' => 'Activo',
        ]);
    }

    private function crearProyecto(
        User $usuario,
        string $nombre
    ): Proyecto {
        $programa = Programa::create([
            'entidad_id' => $usuario->entidad_id,
            'codigo' => 'PROG-' . $usuario->entidad_id,
            'nombre' => 'Programa de prueba',
            'descripcion' => 'Programa para pruebas.',
            'periodo_inicio' => 2026,
            'periodo_fin' => 2029,
            'responsable_id' => $usuario->id,
            'estado' => 'Activo',
            'estado_proceso' => 'Borrador',
            'usuario_id' => $usuario->id,
        ]);

        $macrosector = Macrosector::create([
            'nombre' => 'Macrosector ' . $usuario->entidad_id,
            'estado' => 'Activo',
        ]);

        $sector = Sector::create([
            'macrosector_id' => $macrosector->id,
            'nombre' => 'Sector ' . $usuario->entidad_id,
            'estado' => 'Activo',
        ]);

        $subsector = Subsector::create([
            'sector_id' => $sector->id,
            'codigo' => 'SUB-' . $usuario->entidad_id,
            'nombre' => 'Subsector ' . $usuario->entidad_id,
            'nivel_gobierno' => 'Nacional',
            'estado' => 'Activo',
        ]);

        return Proyecto::create([
            'programa_id' => $programa->id,
            'entidad_id' => $usuario->entidad_id,
            'subsector_id' => $subsector->id,
            'codigo' => 'PRY-' . $usuario->entidad_id,
            'nombre' => $nombre,
            'descripcion' => 'Proyecto creado para pruebas.',
            'fecha_inicio' => '2027-01-01',
            'fecha_fin' => '2028-12-31',
            'presupuesto_aprobado' => 250000,
            'responsable_id' => $usuario->id,
            'estado' => 'Planificado',
            'estado_administrativo' => 'Activo',
            'estado_proceso' => 'Borrador',
            'usuario_id' => $usuario->id,
        ]);
    }
}