<?php

namespace App\Repositories\Eloquent;

use App\Models\Pnd;
use App\Models\PndEje;
use App\Models\PndObjetivo;
use App\Models\PndEstrategia;
use App\Models\PndMeta;
use App\Models\PndPolitica;
use App\Repositories\Contracts\PndRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PndRepository implements PndRepositoryInterface
{
    // Planes nacionales

    // Listar los planes nacionales con filtro opcional de estado.
    public function listarPlanes(
        bool $soloActivos = true
    ): LengthAwarePaginator {
        return Pnd::query()
            ->when(
                $soloActivos,
                fn ($query) => $query->where('estado', 'Activo')
            )
            ->withCount('ejes')
            ->with([
                'ejes' => function ($query) {
                    $query
                        ->select('id', 'pnd_id')
                        ->withCount('objetivos');
                },
            ])
            ->orderByDesc('periodo_inicio')
            ->orderByDesc('id')
            ->paginate(10);
    }

    // Obtener un plan nacional.
    public function obtenerPlan(int $id): Pnd
    {
        return Pnd::query()->findOrFail($id);
    }

    // Registrar un plan nacional.
    public function crearPlan(array $datos): Pnd
    {
        return Pnd::query()->create($datos);
    }

    // Registrar una política.
    public function crearPolitica(array $datos): PndPolitica
    {
        return PndPolitica::query()->create($datos);
    }

    // Actualizar una política.
    public function actualizarPolitica(
        PndPolitica $registro,
        array $datos
    ): PndPolitica {
        $registro->update($datos);

        return $registro;
    }

    // Registrar una estrategia.
    public function crearEstrategia(array $datos): PndEstrategia
    {
        return PndEstrategia::query()->create($datos);
    }

    // Actualizar una estrategia.
    public function actualizarEstrategia(
        PndEstrategia $registro,
        array $datos
    ): PndEstrategia {
        $registro->update($datos);

        return $registro;
    }

    // Registrar una meta.
    public function crearMeta(array $datos): PndMeta
    {
        return PndMeta::query()->create($datos);
    }

    // Actualizar una meta.
    public function actualizarMeta(
        PndMeta $registro,
        array $datos
    ): PndMeta {
        $registro->update($datos);

        return $registro;
    }

    // Actualizar los campos del plan recibidos del servicio.
    public function actualizarPlan(Pnd $pnd, array $datos): Pnd
    {
        $pnd->update($datos);

        return $pnd;
    }

    // Obtener los ejes del plan con sus objetivos y conteos de políticas y metas.
    public function obtenerPlanConEjes(int $id): Pnd
    {
        return Pnd::query()
            ->with([
                'ejes' => function ($query) {
                    $query
                        ->withCount('objetivos')
                        ->with([
                            'objetivos' => function ($query) {
                                $query
                                    ->select('id', 'pnd_eje_id')
                                    ->withCount([
                                        'politicas',
                                        'metas',
                                    ]);
                            },
                        ])
                        ->orderBy('numero');
                },
            ])
            ->findOrFail($id);
    }

    // Obtener un plan con toda su estructura y filtro opcional de estado.
    public function obtenerConEstructura(
        ?int $id = null,
        bool $soloActivos = true
    ): ?Pnd {
        return Pnd::query()
            ->when(
                $soloActivos,
                fn ($query) => $query->where('estado', 'Activo')
            )
            ->with([
                'ejes' => function ($query) {
                    $query->orderBy('numero');
                },
                'ejes.objetivos' => function ($query) {
                    $query->orderBy('numero');
                },
                'ejes.objetivos.politicas' => function ($query) {
                    $query->orderBy('codigo');
                },
                'ejes.objetivos.politicas.estrategias' => function ($query) {
                    $query->orderBy('codigo');
                },
                'ejes.objetivos.metas' => function ($query) {
                    $query->orderBy('numero');
                },
            ])
            ->when(
                $id !== null,
                fn ($query) => $query->whereKey($id)
            )
            ->orderByDesc('periodo_inicio')
            ->orderByDesc('id')
            ->first();
    }

    // Obtener los totales de la estructura respetando el filtro de estado.
    public function obtenerResumen(
        ?int $id = null,
        bool $soloActivos = true
    ): array {
        $pnd = $this->obtenerConEstructura(
            $id,
            $soloActivos
        );

        $ejes = $pnd?->ejes ?? collect();

        $objetivos = $ejes->flatMap(
            fn ($eje) => $eje->objetivos
        );

        $politicas = $objetivos->flatMap(
            fn ($objetivo) => $objetivo->politicas
        );

        return [
            'ejes' => $ejes->count(),
            'objetivos' => $objetivos->count(),
            'politicas' => $politicas->count(),
            'estrategias' => $politicas->sum(
                fn ($politica) => $politica->estrategias->count()
            ),
            'metas' => $objetivos->sum(
                fn ($objetivo) => $objetivo->metas->count()
            ),
        ];
    }

    // Ejes

    // Obtener un eje con su plan y sus objetivos.
    public function obtenerEjeConObjetivos(int $id): PndEje
    {
        return PndEje::query()
            ->with([
                'pnd',
                'objetivos' => function ($query) {
                    $query
                        ->withCount([
                            'politicas',
                            'metas',
                        ])
                        ->with([
                            'politicas' => function ($query) {
                                $query
                                    ->select('id', 'pnd_objetivo_id')
                                    ->withCount('estrategias');
                            },
                        ])
                        ->orderBy('numero');
                },
            ])
            ->findOrFail($id);
    }

    // Registrar un eje.
    public function crearEje(array $datos): PndEje
    {
        return PndEje::query()->create($datos);
    }

    // Actualizar los campos autorizados del eje.
    public function actualizarEje(PndEje $eje, array $datos): PndEje
    {
        $eje->update($datos);

        return $eje;
    }

    // Objetivos

    // Obtener un objetivo nacional con sus relaciones.
    public function obtenerObjetivoConDetalle(int $id): ?PndObjetivo
    {
        return PndObjetivo::query()
            ->with([
                'eje.pnd',
                'politicas' => function ($query) {
                    $query->orderBy('codigo');
                },
                'politicas.estrategias' => function ($query) {
                    $query->orderBy('codigo');
                },
                'metas' => function ($query) {
                    $query->orderBy('numero');
                },
            ])
            ->find($id);
    }

    // Registrar un objetivo nacional.
    public function crearObjetivo(array $datos): PndObjetivo
    {
        return PndObjetivo::query()->create($datos);
    }

    // Actualizar los campos autorizados del objetivo.
    public function actualizarObjetivo(
        PndObjetivo $objetivo,
        array $datos
    ): PndObjetivo {
        $objetivo->update($datos);

        return $objetivo;
    }
}