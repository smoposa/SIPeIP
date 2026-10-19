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

class OdsObjetivosTest extends TestCase
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

        $this->actingAs(User::factory()->create([
            'rol_id' => $rol->id,
            'entidad_id' => Entidad::factory()->create([
                'estado' => 'Activo',
            ])->id,
            'estado' => 'Activo',
        ]));
    }

    private function agenda(string $nombre = 'Agenda de prueba'): AgendaOds
    {
        return AgendaOds::create([
            'nombre' => $nombre,
            'periodo_inicio' => 2026,
            'periodo_fin' => 2030,
            'estado' => 'Activo',
        ]);
    }

    private function objetivo(AgendaOds $agenda, array $datos = []): Ods
    {
        return Ods::create([
            'agenda_id' => $agenda->id,
            'codigo' => 'ODS-01',
            'nombre' => 'Objetivo de prueba',
            'descripcion' => 'Descripción del objetivo',
            'estado' => 'Activo',
            ...$datos,
        ]);
    }

    private function datosActualizacion(Ods $ods, array $cambios = []): array
    {
        return [
            'codigo' => $ods->codigo,
            'nombre' => $ods->nombre,
            'descripcion' => $ods->descripcion,
            'estado' => $ods->estado,
            ...$cambios,
        ];
    }

    public function test_listado_muestra_solo_objetivos_de_la_agenda_seleccionada(): void
    {
        $this->ingresar();

        $agenda1 = $this->agenda('Primera agenda');
        $agenda2 = $this->agenda('Segunda agenda');

        $this->objetivo($agenda1, ['nombre' => 'Objetivo exclusivo alfa']);
        $this->objetivo($agenda2, ['nombre' => 'Objetivo exclusivo beta']);

        $this->get(route('ods.objetivos.index', ['agenda' => $agenda1->id]))
            ->assertOk()
            ->assertViewIs('ods.objetivos.index')
            ->assertSeeText('Objetivo exclusivo alfa')
            ->assertDontSeeText('Objetivo exclusivo beta');

        $this->get(route('ods.objetivos.index', ['agenda' => $agenda2->id]))
            ->assertOk()
            ->assertSeeText('Objetivo exclusivo beta')
            ->assertDontSeeText('Objetivo exclusivo alfa');
    }

    public function test_crear_objetivo_genera_codigo_consecutivo_en_el_servidor(): void
    {
        $this->ingresar();
        $agenda = $this->agenda();

        $this->objetivo($agenda, ['codigo' => 'ODS-17']);

        $this->post(
            route('ods.objetivos.store', ['agenda' => $agenda->id]),
            [
                'codigo' => 'ODS-999',
                'nombre' => 'Nuevo objetivo',
                'descripcion' => 'Descripción del nuevo objetivo',
            ]
        )
            ->assertSessionHasNoErrors()
            ->assertRedirect(
                route('ods.objetivos.index', ['agenda' => $agenda->id])
            );

        $this->assertDatabaseHas('ods', [
            'agenda_id' => $agenda->id,
            'codigo' => 'ODS-18',
            'nombre' => 'Nuevo objetivo',
            'estado' => 'Activo',
        ]);

        $this->assertDatabaseMissing('ods', [
            'agenda_id' => $agenda->id,
            'codigo' => 'ODS-999',
        ]);
    }

    public function test_agendas_distintas_pueden_tener_el_mismo_codigo(): void
    {
        $this->ingresar();

        $agenda1 = $this->agenda('Primera agenda');
        $agenda2 = $this->agenda('Segunda agenda');

        foreach ([$agenda1, $agenda2] as $agenda) {
            $this->post(
                route('ods.objetivos.store', ['agenda' => $agenda->id]),
                [
                    'nombre' => 'Objetivo de ' . $agenda->nombre,
                    'descripcion' => 'Descripción de prueba',
                ]
            )
                ->assertSessionHasNoErrors()
                ->assertRedirect();

            $this->assertDatabaseHas('ods', [
                'agenda_id' => $agenda->id,
                'codigo' => 'ODS-01',
                'estado' => 'Activo',
            ]);
        }
    }

    public function test_administrador_puede_editar_objetivo(): void
    {
        $this->ingresar();
        $agenda = $this->agenda();
        $ods = $this->objetivo($agenda);

        $this->put(
            route('ods.objetivos.update', ['ods' => $ods->id]),
            $this->datosActualizacion($ods, [
                'nombre' => 'Objetivo actualizado',
                'descripcion' => 'Descripción actualizada',
            ])
        )
            ->assertSessionHasNoErrors()
            ->assertRedirect(
                route('ods.objetivos.index', ['agenda' => $agenda->id])
            );

        $this->assertDatabaseHas('ods', [
            'id' => $ods->id,
            'agenda_id' => $agenda->id,
            'nombre' => 'Objetivo actualizado',
            'descripcion' => 'Descripción actualizada',
        ]);
    }

    public function test_desactivar_objetivo_conserva_metas_y_excluye_nuevas_alineaciones(): void
    {
        $this->ingresar();
        $agenda = $this->agenda();
        $ods = $this->objetivo($agenda);

        $meta = OdsMeta::create([
            'ods_id' => $ods->id,
            'codigo' => '1.1',
            'nombre' => 'Meta conservada',
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
            route('ods.objetivos.update', ['ods' => $ods->id]),
            $this->datosActualizacion($ods, ['estado' => 'Inactivo'])
        )
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('ods', [
            'id' => $ods->id,
            'estado' => 'Inactivo',
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

        $this->get(route('ods.metas.index', ['ods' => $ods->id]))
            ->assertOk()
            ->assertSeeText('Meta conservada');
    }

    public function test_administrador_puede_reactivar_objetivo(): void
    {
        $this->ingresar();
        $agenda = $this->agenda();
        $ods = $this->objetivo($agenda, ['estado' => 'Inactivo']);

        $this->put(
            route('ods.objetivos.update', ['ods' => $ods->id]),
            $this->datosActualizacion($ods, ['estado' => 'Activo'])
        )
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('ods', [
            'id' => $ods->id,
            'estado' => 'Activo',
        ]);

        $this->assertTrue(
            app(ObjetivoRepositoryInterface::class)
                ->obtenerOdsActivos()
                ->contains('id', $ods->id)
        );
    }

    public function test_objetivo_no_puede_moverse_a_otra_agenda(): void
    {
        $this->ingresar();

        $agenda1 = $this->agenda('Agenda original');
        $agenda2 = $this->agenda('Otra agenda');
        $ods = $this->objetivo($agenda1);

        $this->put(
            route('ods.objetivos.update', ['ods' => $ods->id]),
            $this->datosActualizacion($ods, [
                'agenda_id' => $agenda2->id,
            ])
        )->assertSessionHasErrors('agenda_id');

        $this->assertDatabaseHas('ods', [
            'id' => $ods->id,
            'agenda_id' => $agenda1->id,
        ]);
    }

    public function test_no_permite_duplicar_codigo_en_la_misma_agenda(): void
    {
        $this->ingresar();
        $agenda = $this->agenda();

        $this->objetivo($agenda, ['codigo' => 'ODS-01']);
        $ods = $this->objetivo($agenda, ['codigo' => 'ODS-02']);

        $this->put(
            route('ods.objetivos.update', ['ods' => $ods->id]),
            $this->datosActualizacion($ods, ['codigo' => 'ODS-01'])
        )->assertSessionHasErrors('codigo');

        $this->assertDatabaseHas('ods', [
            'id' => $ods->id,
            'codigo' => 'ODS-02',
        ]);
    }

    public function test_creacion_requiere_nombre_y_descripcion(): void
    {
        $this->ingresar();
        $agenda = $this->agenda();

        $this->post(
            route('ods.objetivos.store', ['agenda' => $agenda->id]),
            []
        )->assertSessionHasErrors(['nombre', 'descripcion']);

        $this->assertDatabaseMissing('ods', [
            'agenda_id' => $agenda->id,
        ]);
    }

    public function test_lector_consulta_pero_no_crea_edita_ni_desactiva(): void
    {
        $this->ingresar('CONSULTA_INSTITUCIONAL');
        $agenda = $this->agenda();
        $ods = $this->objetivo($agenda);

        $this->get(
            route('ods.objetivos.index', ['agenda' => $agenda->id])
        )
            ->assertOk()
            ->assertSeeText($ods->nombre)
            ->assertDontSee('id="editarPanelObjetivo"', false);

        $this->post(
            route('ods.objetivos.store', ['agenda' => $agenda->id]),
            [
                'nombre' => 'Objetivo no autorizado',
                'descripcion' => 'Descripción de prueba',
            ]
        )->assertForbidden();

        $this->put(
            route('ods.objetivos.update', ['ods' => $ods->id]),
            $this->datosActualizacion($ods, [
                'nombre' => 'Cambio no autorizado',
            ])
        )->assertForbidden();

        $this->put(
            route('ods.objetivos.update', ['ods' => $ods->id]),
            $this->datosActualizacion($ods, ['estado' => 'Inactivo'])
        )->assertForbidden();

        $this->assertDatabaseHas('ods', [
            'id' => $ods->id,
            'nombre' => 'Objetivo de prueba',
            'estado' => 'Activo',
        ]);

        $this->assertDatabaseMissing('ods', [
            'agenda_id' => $agenda->id,
            'nombre' => 'Objetivo no autorizado',
        ]);
    }

    public function test_invitado_debe_iniciar_sesion(): void
    {
        $agenda = $this->agenda();
        $ods = $this->objetivo($agenda);

        $this->get(
            route('ods.objetivos.index', ['agenda' => $agenda->id])
        )->assertRedirect(route('login'));

        $this->post(
            route('ods.objetivos.store', ['agenda' => $agenda->id]),
            [
                'nombre' => 'Objetivo sin autenticación',
                'descripcion' => 'Descripción de prueba',
            ]
        )->assertRedirect(route('login'));

        $this->put(
            route('ods.objetivos.update', ['ods' => $ods->id]),
            $this->datosActualizacion($ods, ['estado' => 'Inactivo'])
        )->assertRedirect(route('login'));

        $this->assertDatabaseHas('ods', [
            'id' => $ods->id,
            'estado' => 'Activo',
        ]);

        $this->assertDatabaseMissing('ods', [
            'agenda_id' => $agenda->id,
            'nombre' => 'Objetivo sin autenticación',
        ]);
    }
}