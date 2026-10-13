<?php

namespace App\Repositories\Eloquent;

use App\Models\Pnd;
use App\Models\PndObjetivo;
use App\Repositories\Contracts\PndRepositoryInterface;

class PndRepository implements PndRepositoryInterface
{
    /**
     * Obtiene el Plan Nacional de Desarrollo con toda
     * la estructura necesaria para su visualización.
     */
    public function obtenerConEstructura(?int $id = null): ?Pnd
    {
        return Pnd::query()
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
            ->when($id, fn ($query) => $query->whereKey($id))
            ->orderByDesc('periodo_inicio')
            ->orderByDesc('id')
            ->first();
    }

    /**
     * Obtiene los totales generales de la estructura
     * del Plan Nacional de Desarrollo.
     */
    public function obtenerResumen(?int $id = null): array
    {
        $pnd = $this->obtenerConEstructura($id);
        $ejes = $pnd?->ejes ?? collect();
        $objetivos = $ejes->flatMap(fn ($eje) => $eje->objetivos);
        $politicas = $objetivos->flatMap(fn ($objetivo) => $objetivo->politicas);

        return [
            'ejes' => $ejes->count(),
            'objetivos' => $objetivos->count(),
            'politicas' => $politicas->count(),
            'estrategias' => $politicas->sum(fn ($politica) => $politica->estrategias->count()),
            'metas' => $objetivos->sum(fn ($objetivo) => $objetivo->metas->count()),
        ];
    }

    /**
     * Obtiene un Objetivo Nacional con sus políticas,
     * estrategias, metas y el eje al que pertenece.
     */
    public function obtenerObjetivoConDetalle(int $id): ?PndObjetivo
    {
        return PndObjetivo::query()
            ->with([
                'eje',
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
}