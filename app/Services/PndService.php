<?php

namespace App\Services;

use App\Models\Pnd;
use App\Repositories\Contracts\PndRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PndService
{
    public function __construct(
        protected PndRepositoryInterface $pndRepository
    ) {
    }

    /**
     * Obtener todos los PND.
     */
    public function obtenerTodos(): Collection
    {
        return $this->pndRepository->obtenerTodos();
    }

    /**
     * Obtener un PND por su ID.
     */
    public function obtenerPorId(int $id): ?Pnd
    {
        return $this->pndRepository->obtenerPorId($id);
    }

    /**
     * Obtener un PND con toda su estructura.
     */
    public function obtenerConEstructura(int $id): ?Pnd
    {
        return $this->pndRepository->obtenerConEstructura($id);
    }
}