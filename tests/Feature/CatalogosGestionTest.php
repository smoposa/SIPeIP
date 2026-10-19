<?php

namespace Tests\Feature;

use App\Models\AgendaOds;
use App\Models\Entidad;
use App\Models\Objetivo;
use App\Models\Ods;
use App\Models\OdsMeta;
use App\Models\Plan;
use App\Models\Pnd;
use App\Models\PndEje;
use App\Models\PndObjetivo;
use App\Models\PndPolitica;
use App\Models\Rol;
use App\Models\User;
use App\Repositories\Contracts\ObjetivoRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogosGestionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    /**
     * Crear un usuario activo con entidad y rol.
     */
    private function usuario(
        string $codigo = 'ADMIN_SISTEMA'
    ): User {
        $rol = Rol::query()->firstOrCreate(
            ['codigo' => $codigo],
            [
                'nombre' => $codigo,
                'descripcion' => 'Prueba',
                'estado' => 'Activo',
            ]
        );

        return User::factory()->create([
            'rol_id' => $rol->id,
            'entidad_id' => Entidad::factory()->create([
                'estado' => 'Activo',
            ])->id,
            'estado' => 'Activo',
        ]);
    }

    /**
     * La gestión general permite registrar, editar y desactivar
     * sin eliminar los registros.
     */
    public function test_gestion_de_todos_los_catalogos_conserva_los_registros_al_desactivarlos(): void
    {
        $this->actingAs($this->usuario());

        $registros = [];

        foreach (config('catalogos') as $recurso => $definicion) {
            $datos = [];

            foreach ($definicion['campos'] as $campo => $configuracion) {
                $datos[$campo] = match ($campo) {
                    'codigo' => 'TEST-01',
                    'numero' => 1,
                    'periodo_inicio' => 2026,
                    'periodo_fin' => 2030,
                    'estado' => 'Activo',
                    default => 'Registro de prueba',
                };
            }

            if (isset($definicion['padre'])) {
                $datos[$definicion['padre']['campo']] =
                    $registros[$definicion['padre']['recurso']]->id;
            }

            $this->get(
                route('catalogos.gestion.create', $recurso)
            )->assertOk();

            $this->post(
                route('catalogos.gestion.store', $recurso),
                $datos
            )
                ->assertSessionHasNoErrors()
                ->assertRedirect();

            $modelo = $definicion['modelo'];

            $registros[$recurso] = $modelo::query()
                ->latest('id')
                ->firstOrFail();

            $parametros = [
                $recurso,
                $registros[$recurso]->id,
            ];

            $this->get(
                route('catalogos.gestion.index', $recurso)
            )
                ->assertOk()
                ->assertDontSee('Eliminar');

            $this->get(
                route('catalogos.gestion.show', $parametros)
            )->assertOk();

            $this->get(
                route('catalogos.gestion.edit', $parametros)
            )->assertOk();

            $campo = isset($definicion['campos']['nombre'])
                ? 'nombre'
                : 'descripcion';

            $datos[$campo] = 'Texto actualizado';

            $this->put(
                route('catalogos.gestion.update', $parametros),
                $datos
            )
                ->assertSessionHasNoErrors()
                ->assertRedirect();

            $this->assertDatabaseHas(
                $registros[$recurso]->getTable(),
                [
                    'id' => $registros[$recurso]->id,
                    $campo => 'Texto actualizado',
                ]
            );
        }

        foreach ($registros as $recurso => $registro) {
            $this->put(
                route('catalogos.gestion.estado', [
                    $recurso,
                    $registro->id,
                ]),
                ['estado' => 'Inactivo']
            )
                ->assertSessionHasNoErrors()
                ->assertRedirect();

            $this->assertDatabaseHas(
                $registro->getTable(),
                [
                    'id' => $registro->id,
                    'estado' => 'Inactivo',
                ]
            );
        }
    }

    /**
     * La navegación mantiene el contexto de agenda, objetivo y metas.
     */
public function test_navegacion_macro_micro_y_creacion_contextual(): void
{
    $this->actingAs($this->usuario());

    $agenda = AgendaOds::create([
        'nombre' => 'Agenda de prueba 2035',
        'periodo_inicio' => 2031,
        'periodo_fin' => 2035,
    ]);

    // El administrador puede consultar y crear agendas.
    $this->get(route('ods.agendas.index'))
        ->assertOk()
        ->assertSeeText('Agenda de prueba 2035')
        ->assertSee('id="crearAgenda"', false);

    // El formulario general conserva la agenda seleccionada.
    $this->get(
        route('catalogos.gestion.create', [
            'recurso' => 'ods',
            'padre' => $agenda->id,
        ])
    )
        ->assertOk()
        ->assertViewHas(
            'padreSeleccionado',
            fn ($padre) => $padre->id === $agenda->id
        );

    // Registrar un objetivo dentro de esa agenda.
    $this->post(
        route('catalogos.gestion.store', 'ods'),
        [
            'agenda_id' => $agenda->id,
            'codigo' => 'ODS-01',
            'nombre' => 'Objetivo de prueba',
            'descripcion' => 'Descripción',
            'estado' => 'Activo',
        ]
    )
        ->assertSessionHasNoErrors()
        ->assertRedirect(
            route('ods.objetivos.index', [
                'agenda' => $agenda->id,
            ])
        );

    $ods = Ods::query()
        ->where('agenda_id', $agenda->id)
        ->where('codigo', 'ODS-01')
        ->firstOrFail();

    $this->get(
        route('ods.objetivos.index', [
            'agenda' => $agenda->id,
        ])
    )
        ->assertOk()
        ->assertSeeText('Objetivo de prueba')
        ->assertSeeText('Registrar objetivo');

    // Registrar una meta dentro del objetivo.
    $this->post(
        route('catalogos.gestion.store', 'ods-metas'),
        [
            'ods_id' => $ods->id,
            'codigo' => '1.1',
            'nombre' => 'Meta de prueba',
            'estado' => 'Activo',
        ]
    )
        ->assertSessionHasNoErrors()
        ->assertRedirect(
            route('ods.metas.index', [
                'ods' => $ods->id,
            ])
        );

    $this->get(
        route('ods.metas.index', [
            'ods' => $ods->id,
        ])
    )
        ->assertOk()
        ->assertSeeText('Meta de prueba')
        ->assertSeeText('Registrar meta');
}

    /**
     * Los códigos pueden repetirse entre agendas,
     * pero no dentro de la misma agenda.
     */
    public function test_no_se_mezclan_agendas_y_los_codigos_pueden_repetirse_entre_agendas(): void
    {
        $this->actingAs($this->usuario());

        $agenda1 = AgendaOds::query()->firstOrFail();

        $agenda2 = AgendaOds::create([
            'nombre' => 'Otra agenda',
            'periodo_inicio' => 2031,
            'periodo_fin' => 2035,
        ]);

        $datos = [
            'codigo' => 'ODS-01',
            'nombre' => 'Primero',
            'descripcion' => 'Descripción',
            'estado' => 'Activo',
        ];

        $this->post(
            route('catalogos.gestion.store', 'ods'),
            [
                ...$datos,
                'agenda_id' => $agenda1->id,
            ]
        )
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->post(
            route('catalogos.gestion.store', 'ods'),
            [
                ...$datos,
                'agenda_id' => $agenda2->id,
                'nombre' => 'Segundo',
            ]
        )
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->get(
            route('ods.objetivos.index', [
                'agenda' => $agenda1->id,
            ])
        )
            ->assertOk()
            ->assertSee('Primero')
            ->assertDontSee('Segundo');

        $this->get(
            route('ods.objetivos.index', [
                'agenda' => $agenda2->id,
            ])
        )
            ->assertOk()
            ->assertSee('Segundo')
            ->assertDontSee('Primero');

        $this->post(
            route('catalogos.gestion.store', 'ods'),
            [
                ...$datos,
                'agenda_id' => $agenda1->id,
            ]
        )->assertSessionHasErrors('codigo');
    }

    /**
     * Desactivar una agenda conserva sus registros,
     * pero los excluye de nuevas alineaciones.
     */
    public function test_desactivar_agenda_conserva_objetivos_y_metas_y_los_retira_de_nuevas_alineaciones(): void
    {
        $this->actingAs($this->usuario());

        $agenda = AgendaOds::query()->firstOrFail();

        $ods = Ods::create([
            'agenda_id' => $agenda->id,
            'codigo' => 'ODS-01',
            'nombre' => 'Histórico',
            'descripcion' => 'Descripción',
            'estado' => 'Activo',
        ]);

        $meta = OdsMeta::create([
            'ods_id' => $ods->id,
            'codigo' => '1.1',
            'nombre' => 'Meta histórica',
            'estado' => 'Activo',
        ]);

        $repository = app(ObjetivoRepositoryInterface::class);

        $this->assertCount(
            1,
            $repository->obtenerOdsActivos()
        );

        $this->put(
            route('catalogos.gestion.estado', [
                'ods-agendas',
                $agenda->id,
            ]),
            ['estado' => 'Inactivo']
        )
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('ods_agendas', [
            'id' => $agenda->id,
            'estado' => 'Inactivo',
        ]);

        $this->assertDatabaseHas('ods', [
            'id' => $ods->id,
            'estado' => 'Activo',
        ]);

        $this->assertDatabaseHas('ods_metas', [
            'id' => $meta->id,
            'estado' => 'Activo',
        ]);

        $this->assertCount(
            0,
            $repository->obtenerOdsActivos()
        );

        $this->assertCount(
            0,
            $repository->obtenerMetasActivasPorOds($ods->id)
        );

        $this->get(
            route('ods.objetivos.index', [
                'agenda' => $agenda->id,
            ])
        )
            ->assertOk()
            ->assertSee('Histórico');

        $this->get(
            route('ods.metas.index', [
                'ods' => $ods->id,
            ])
        )
            ->assertOk()
            ->assertSee('Meta histórica');

        $this->put(
            route('catalogos.gestion.estado', [
                'ods-agendas',
                $agenda->id,
            ]),
            ['estado' => 'Activo']
        )
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertCount(
            1,
            $repository->obtenerOdsActivos()
        );
    }

    /**
     * El lector puede consultar, pero no modificar ni eliminar.
     */
    public function test_lector_solo_consulta_y_no_existe_eliminacion(): void
    {
        $this->actingAs(
            $this->usuario('CONSULTA_INSTITUCIONAL')
        );

$this->get(route('ods.agendas.index'))
    ->assertOk()
    ->assertDontSee('id="crearAgenda"', false)
    ->assertDontSee('id="editarPanelAgenda"', false);

        foreach (array_keys(config('catalogos')) as $recurso) {
            $this->get(
                route('catalogos.gestion.index', $recurso)
            )
                ->assertOk()
                ->assertDontSee('Crear registro');

            $this->get(
                route('catalogos.gestion.create', $recurso)
            )->assertForbidden();

            $this->post(
                route('catalogos.gestion.store', $recurso),
                []
            )->assertForbidden();

            $this->put(
                route('catalogos.gestion.update', [
                    $recurso,
                    1,
                ]),
                []
            )->assertForbidden();

            $this->put(
                route('catalogos.gestion.estado', [
                    $recurso,
                    1,
                ]),
                ['estado' => 'Inactivo']
            )->assertForbidden();

            $this->delete(
                url('/catalogos/gestion/' . $recurso . '/1')
            )->assertStatus(405);
        }
    }

    /**
     * Un objetivo ODS conserva su agenda de origen.
     */
    public function test_ods_no_se_pueden_mover_a_otra_agenda_para_conservar_historial(): void
    {
        $this->actingAs($this->usuario());

        $agenda1 = AgendaOds::query()->firstOrFail();

        $agenda2 = AgendaOds::create([
            'nombre' => 'Otra agenda',
            'periodo_inicio' => 2031,
            'periodo_fin' => 2035,
        ]);

        $datos = [
            'agenda_id' => $agenda1->id,
            'codigo' => 'ODS-01',
            'nombre' => 'Primero',
            'descripcion' => 'Descripción',
            'estado' => 'Activo',
        ];

        $ods = Ods::create($datos);

        $this->put(
            route('catalogos.gestion.update', [
                'ods',
                $ods->id,
            ]),
            [
                ...$datos,
                'agenda_id' => $agenda2->id,
            ]
        )->assertSessionHasErrors('agenda_id');

        $this->assertDatabaseHas('ods', [
            'id' => $ods->id,
            'agenda_id' => $agenda1->id,
        ]);
    }

    /**
     * Cada plan muestra sus propios ejes.
     * Desactivar un eje impide nuevas alineaciones.
     */
    public function test_pnd_seleccionado_y_estado_de_sus_niveles(): void
    {
        $this->actingAs($this->usuario());

        $plan1 = Pnd::create([
            'nombre' => 'Anterior',
            'periodo_inicio' => 2021,
            'periodo_fin' => 2025,
        ]);

        $plan2 = Pnd::create([
            'nombre' => 'Nuevo',
            'periodo_inicio' => 2026,
            'periodo_fin' => 2030,
        ]);

        $eje = PndEje::create([
            'pnd_id' => $plan1->id,
            'numero' => 1,
            'nombre' => 'Eje',
        ]);

        $objetivo = PndObjetivo::create([
            'pnd_eje_id' => $eje->id,
            'numero' => 1,
            'nombre' => 'Objetivo',
        ]);

        PndPolitica::create([
            'pnd_objetivo_id' => $objetivo->id,
            'codigo' => '1.1',
            'nombre' => 'Política',
        ]);

        $this->get(
            route('pnd.ejes.index', [
                'pnd' => $plan1->id,
            ])
        )
            ->assertOk()
            ->assertViewHas(
                'pnd',
                function ($pnd) use ($plan1, $eje) {
                    return $pnd->id === $plan1->id
                        && $pnd->ejes->count() === 1
                        && $pnd->ejes->first()->id === $eje->id
                        && (int) $pnd->ejes->first()->objetivos_count === 1;
                }
            );

        $this->get(
            route('pnd.ejes.index', [
                'pnd' => $plan2->id,
            ])
        )
            ->assertOk()
            ->assertViewHas(
                'pnd',
                function ($pnd) use ($plan2) {
                    return $pnd->id === $plan2->id
                        && $pnd->ejes->isEmpty();
                }
            );

        $this->put(
            route('catalogos.gestion.estado', [
                'pnd-ejes',
                $eje->id,
            ]),
            ['estado' => 'Inactivo']
        )
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('pnd_ejes', [
            'id' => $eje->id,
            'estado' => 'Inactivo',
        ]);

        $this->assertCount(
            0,
            app(ObjetivoRepositoryInterface::class)
                ->obtenerPndActivos()
        );

        $this->assertDatabaseHas('pnd_objetivos', [
            'id' => $objetivo->id,
            'pnd_eje_id' => $eje->id,
        ]);
    }

    /**
     * Una alineación histórica puede conservarse al editar,
     * pero no utilizarse en un objetivo institucional nuevo.
     */
    public function test_alineacion_historica_se_puede_conservar_pero_no_usar_en_un_oei_nuevo(): void
    {
        $usuario = $this->usuario();

        $this->actingAs($usuario);

        $plan = Plan::create([
            'codigo' => 'PEI-TEST',
            'nombre' => 'Plan institucional',
            'entidad_id' => $usuario->entidad_id,
            'tipo' => 'Institucional',
            'periodo_inicio' => 2026,
            'periodo_fin' => 2030,
            'estado' => 'Activo',
            'usuario_id' => $usuario->id,
        ]);

        $pnd = Pnd::create([
            'nombre' => 'PND',
            'periodo_inicio' => 2026,
            'periodo_fin' => 2030,
        ]);

        $eje = PndEje::create([
            'pnd_id' => $pnd->id,
            'numero' => 1,
            'nombre' => 'Eje',
        ]);

        $nacional = PndObjetivo::create([
            'pnd_eje_id' => $eje->id,
            'numero' => 1,
            'nombre' => 'Objetivo nacional',
        ]);

        $politica = PndPolitica::create([
            'pnd_objetivo_id' => $nacional->id,
            'codigo' => '1.1',
            'nombre' => 'Política',
        ]);

        $agenda = AgendaOds::query()->firstOrFail();

        $ods = Ods::create([
            'agenda_id' => $agenda->id,
            'codigo' => 'ODS-01',
            'nombre' => 'ODS histórico',
            'descripcion' => 'Descripción',
            'estado' => 'Activo',
        ]);

        $meta = OdsMeta::create([
            'ods_id' => $ods->id,
            'codigo' => '1.1',
            'nombre' => 'Meta histórica',
            'estado' => 'Activo',
        ]);

        $datos = [
            'plan_id' => $plan->id,
            'pnd_id' => $nacional->id,
            'pnd_politica_id' => $politica->id,
            'ods_id' => $ods->id,
            'ods_meta_id' => $meta->id,
            'nombre' => 'OEI histórico',
        ];

        $objetivo = Objetivo::create([
            ...$datos,
            'codigo' => 'OEI-01',
            'usuario_id' => $usuario->id,
            'estado' => 'Activo',
        ]);

        $agenda->update([
            'estado' => 'Inactivo',
        ]);

        $meta->update([
            'estado' => 'Inactivo',
        ]);

        $this->get(
            route('objetivos.edit', $objetivo->id)
        )
            ->assertOk()
            ->assertSee('ODS histórico');

        $this->get(
            route('objetivos.ods.metas', [
                'ods' => $ods->id,
                'objetivo_id' => $objetivo->id,
            ])
        )
            ->assertOk()
            ->assertJsonFragment([
                'id' => $meta->id,
            ]);

        $this->put(
            route('objetivos.update', $objetivo->id),
            [
                ...$datos,
                'nombre' => 'OEI actualizado',
            ]
        )->assertSessionHasNoErrors();

        $this->post(
            route('objetivos.store'),
            $datos
        )->assertSessionHasErrors([
            'ods_id',
            'ods_meta_id',
        ]);

        $this->assertDatabaseHas('objetivos', [
            'id' => $objetivo->id,
            'ods_id' => $ods->id,
            'ods_meta_id' => $meta->id,
        ]);

        // Otra entidad no puede utilizar el contexto histórico ajeno.
        $this->actingAs(
            $this->usuario('ANALISTA_PLANIFICACION')
        )
            ->get(
                route('objetivos.ods.metas', [
                    'ods' => $ods->id,
                    'objetivo_id' => $objetivo->id,
                ])
            )
            ->assertNotFound();
    }

    /**
     * Validar recurso, pertenencia, período y estado.
     */
    public function test_validacion_de_recurso_padre_periodo_y_estado(): void
    {
        $this->actingAs($this->usuario());

        $this->get(
            route('catalogos.gestion.index', 'users')
        )->assertNotFound();

        $this->post(
            route('catalogos.gestion.store', 'ods'),
            [
                'agenda_id' => 99999,
                'codigo' => 'ODS-01',
                'nombre' => 'Nombre',
                'descripcion' => 'Descripción',
                'estado' => 'Activo',
            ]
        )->assertSessionHasErrors('agenda_id');

        $this->post(
            route('catalogos.gestion.store', 'ods-agendas'),
            [
                'nombre' => 'Agenda',
                'periodo_inicio' => 2035,
                'periodo_fin' => 2030,
                'estado' => 'Activo',
            ]
        )->assertSessionHasErrors('periodo_fin');

        $agenda = AgendaOds::query()->firstOrFail();

        $this->put(
            route('catalogos.gestion.estado', [
                'ods-agendas',
                $agenda->id,
            ]),
            ['estado' => 'Otro']
        )->assertSessionHasErrors('estado');
    }

    /**
     * Los invitados deben iniciar sesión.
     */
    public function test_invitado_debe_autenticarse(): void
    {
        $this->get(
            route('ods.agendas.index')
        )->assertRedirect(route('login'));

        $this->put(
            route('catalogos.gestion.estado', [
                'ods-agendas',
                1,
            ]),
            ['estado' => 'Inactivo']
        )->assertRedirect(route('login'));
    }
}