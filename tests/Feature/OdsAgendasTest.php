<?php

namespace Tests\Feature;

use App\Models\AgendaOds;
use App\Models\Entidad;
use App\Models\Ods;
use App\Models\OdsMeta;
use App\Models\Rol;
use App\Models\User;
use App\Repositories\Contracts\ObjetivoRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OdsAgendasTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    private function ingresar(string $codigo = 'ADMIN_SISTEMA'): void
    {
        $rol = Rol::query()->firstOrCreate(
            ['codigo' => $codigo],
            [
                'nombre' => $codigo,
                'descripcion' => 'Rol de prueba',
                'estado' => 'Activo',
            ]
        );

        $usuario = User::factory()->create([
            'rol_id' => $rol->id,
            'entidad_id' => Entidad::factory()->create([
                'estado' => 'Activo',
            ])->id,
            'estado' => 'Activo',
        ]);

        $this->actingAs($usuario);
    }

    private function agenda(array $datos = []): AgendaOds
    {
        return AgendaOds::create([
            'nombre' => 'Agenda de prueba',
            'periodo_inicio' => 2026,
            'periodo_fin' => 2030,
            'descripcion' => 'Descripción de prueba',
            'estado' => 'Activo',
            ...$datos,
        ]);
    }

    private function datosActualizacion(
        AgendaOds $agenda,
        array $cambios = []
    ): array {
        return [
            'nombre' => $agenda->nombre,
            'periodo_inicio' => $agenda->periodo_inicio,
            'periodo_fin' => $agenda->periodo_fin,
            'descripcion' => $agenda->descripcion,
            'estado' => $agenda->estado,
            ...$cambios,
        ];
    }

    public function test_administrador_puede_consultar_agendas(): void
    {
        $this->ingresar();
        $agenda = $this->agenda();

        $this->get(route('ods.agendas.index'))
            ->assertOk()
            ->assertViewIs('ods.agendas.index')
            ->assertSeeText($agenda->nombre)
            ->assertSee('id="crearAgenda"', false);
    }

    public function test_administrador_puede_crear_agenda(): void
    {
        $this->ingresar();

        $this->post(route('ods.agendas.store'), [
            'nombre' => 'Nueva agenda de prueba',
            'periodo_inicio' => 2031,
            'periodo_fin' => 2035,
            'descripcion' => 'Agenda registrada desde la prueba',
        ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('ods.agendas.index'));

        $this->assertDatabaseHas('ods_agendas', [
            'nombre' => 'Nueva agenda de prueba',
            'periodo_inicio' => 2031,
            'periodo_fin' => 2035,
            'estado' => 'Activo',
        ]);
    }

    public function test_administrador_puede_editar_agenda(): void
    {
        $this->ingresar();
        $agenda = $this->agenda();

        $this->put(
            route('ods.agendas.update', ['agenda' => $agenda->id]),
            $this->datosActualizacion($agenda, [
                'nombre' => 'Agenda actualizada',
                'descripcion' => 'Descripción actualizada',
            ])
        )
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('ods.agendas.index'));

        $this->assertDatabaseHas('ods_agendas', [
            'id' => $agenda->id,
            'nombre' => 'Agenda actualizada',
            'descripcion' => 'Descripción actualizada',
            'estado' => 'Activo',
        ]);
    }

    public function test_desactivar_agenda_conserva_historial_y_excluye_nuevas_alineaciones(): void
    {
        $this->ingresar();
        $agenda = $this->agenda();

        $ods = Ods::create([
            'agenda_id' => $agenda->id,
            'codigo' => 'ODS-01',
            'nombre' => 'Objetivo histórico',
            'descripcion' => 'Descripción del objetivo',
            'estado' => 'Activo',
        ]);

        $meta = OdsMeta::create([
            'ods_id' => $ods->id,
            'codigo' => '1.1',
            'nombre' => 'Meta histórica',
            'estado' => 'Activo',
        ]);

        $repository = app(ObjetivoRepositoryInterface::class);

        $this->assertTrue(
            $repository->obtenerOdsActivos()->contains('id', $ods->id)
        );

        $this->assertTrue(
            $repository->obtenerMetasActivasPorOds($ods->id)
                ->contains('id', $meta->id)
        );

        $this->put(
            route('ods.agendas.update', ['agenda' => $agenda->id]),
            $this->datosActualizacion($agenda, [
                'estado' => 'Inactivo',
            ])
        )
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('ods.agendas.index'));

        $this->assertDatabaseHas('ods_agendas', [
            'id' => $agenda->id,
            'estado' => 'Inactivo',
        ]);

        $this->assertDatabaseHas('ods', [
            'id' => $ods->id,
            'agenda_id' => $agenda->id,
            'estado' => 'Activo',
        ]);

        $this->assertDatabaseHas('ods_metas', [
            'id' => $meta->id,
            'ods_id' => $ods->id,
            'estado' => 'Activo',
        ]);

        $this->assertFalse(
            $repository->obtenerOdsActivos()->contains('id', $ods->id)
        );

        $this->assertFalse(
            $repository->obtenerMetasActivasPorOds($ods->id)
                ->contains('id', $meta->id)
        );

        $this->get(
            route('ods.objetivos.index', ['agenda' => $agenda->id])
        )
            ->assertOk()
            ->assertSeeText('Objetivo histórico');

        $this->get(
            route('ods.metas.index', ['ods' => $ods->id])
        )
            ->assertOk()
            ->assertSeeText('Meta histórica');
    }

    public function test_administrador_puede_reactivar_agenda(): void
    {
        $this->ingresar();
        $agenda = $this->agenda(['estado' => 'Inactivo']);

        $this->put(
            route('ods.agendas.update', ['agenda' => $agenda->id]),
            $this->datosActualizacion($agenda, [
                'estado' => 'Activo',
            ])
        )
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('ods.agendas.index'));

        $this->assertDatabaseHas('ods_agendas', [
            'id' => $agenda->id,
            'estado' => 'Activo',
        ]);
    }

    public function test_no_permite_periodo_final_anterior_al_inicial(): void
    {
        $this->ingresar();

        $this->post(route('ods.agendas.store'), [
            'nombre' => 'Agenda con período inválido',
            'periodo_inicio' => 2035,
            'periodo_fin' => 2030,
        ])->assertSessionHasErrors('periodo_fin');

        $this->assertDatabaseMissing('ods_agendas', [
            'nombre' => 'Agenda con período inválido',
        ]);
    }

    public function test_lector_consulta_pero_no_crea_edita_ni_desactiva(): void
    {
        $this->ingresar('CONSULTA_INSTITUCIONAL');
        $agenda = $this->agenda();

        $this->get(route('ods.agendas.index'))
            ->assertOk()
            ->assertSeeText($agenda->nombre)
            ->assertDontSee('id="crearAgenda"', false)
            ->assertDontSee('id="editarPanelAgenda"', false);

        $this->post(route('ods.agendas.store'), [
            'nombre' => 'Registro no autorizado',
            'periodo_inicio' => 2031,
            'periodo_fin' => 2035,
        ])->assertForbidden();

        $this->put(
            route('ods.agendas.update', ['agenda' => $agenda->id]),
            $this->datosActualizacion($agenda, [
                'nombre' => 'Cambio no autorizado',
            ])
        )->assertForbidden();

        $this->put(
            route('ods.agendas.update', ['agenda' => $agenda->id]),
            $this->datosActualizacion($agenda, [
                'estado' => 'Inactivo',
            ])
        )->assertForbidden();

        $this->assertDatabaseHas('ods_agendas', [
            'id' => $agenda->id,
            'nombre' => 'Agenda de prueba',
            'estado' => 'Activo',
        ]);

        $this->assertDatabaseMissing('ods_agendas', [
            'nombre' => 'Registro no autorizado',
        ]);
    }

    public function test_invitado_debe_iniciar_sesion(): void
    {
        $agenda = $this->agenda();

        $this->get(route('ods.agendas.index'))
            ->assertRedirect(route('login'));

        $this->post(route('ods.agendas.store'), [
            'nombre' => 'Agenda sin autenticación',
            'periodo_inicio' => 2031,
            'periodo_fin' => 2035,
        ])->assertRedirect(route('login'));

        $this->put(
            route('ods.agendas.update', ['agenda' => $agenda->id]),
            $this->datosActualizacion($agenda, [
                'estado' => 'Inactivo',
            ])
        )->assertRedirect(route('login'));

        $this->assertDatabaseHas('ods_agendas', [
            'id' => $agenda->id,
            'estado' => 'Activo',
        ]);

        $this->assertDatabaseMissing('ods_agendas', [
            'nombre' => 'Agenda sin autenticación',
        ]);
    }
}