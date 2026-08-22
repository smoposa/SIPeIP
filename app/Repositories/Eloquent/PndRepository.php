<?php

namespace App\Repositories\Eloquent;

use App\Models\Pnd;
use App\Repositories\Contracts\PndRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PndRepository implements PndRepositoryInterface
{
    /**
     * Obtener todos los PND.
     */
    public function obtenerTodos(): Collection
    {
        return Pnd::query()
            ->orderByDesc('periodo_inicio')
            ->get();
    }

    /**
     * Obtener un PND por su ID.
     */
    public function obtenerPorId(int $id): ?Pnd
    {
        return Pnd::find($id);
    }

    /**
     * Obtener un PND con toda su estructura jerárquica.
     */
    public function obtenerConEstructura(int $id): ?Pnd
    {
        return Pnd::query()
            ->with([
                'ejes' => fn ($query) => $query->orderBy('numero'),

                'ejes.objetivos' => fn ($query) => $query->orderBy('numero'),

                'ejes.objetivos.politicas' => fn ($query) =>
                    $query->orderBy('codigo'),

                'ejes.objetivos.politicas.estrategias' => fn ($query) =>
                    $query->orderBy('codigo'),

                'ejes.objetivos.metas' => fn ($query) =>
                    $query->orderBy('numero'),
            ])
            ->find($id);
    }
}