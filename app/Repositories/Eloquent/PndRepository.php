<?php

namespace App\Repositories\Eloquent;

use App\Models\Pnd;
use App\Models\PndEje;
use App\Models\PndObjetivo;
use App\Models\PndPolitica;
use App\Models\PndEstrategia;
use App\Models\PndMeta;
use App\Repositories\Contracts\PndRepositoryInterface;

class PndRepository implements PndRepositoryInterface
{
    /**
     * Obtiene el Plan Nacional de Desarrollo con toda
     * la estructura necesaria para su visualización.
     */
    public function obtenerConEstructura(): ?Pnd
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
            ->first();
    }

    /**
     * Obtiene los totales generales de la estructura
     * del Plan Nacional de Desarrollo.
     */
    public function obtenerResumen(): array
    {
        return [
            'ejes' => PndEje::count(),
            'objetivos' => PndObjetivo::count(),
            'politicas' => PndPolitica::count(),
            'estrategias' => PndEstrategia::count(),
            'metas' => PndMeta::count(),
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