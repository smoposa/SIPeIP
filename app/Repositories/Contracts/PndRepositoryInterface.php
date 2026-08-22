<?php

namespace App\Repositories\Contracts;

use App\Models\Pnd;
use Illuminate\Database\Eloquent\Collection;

interface PndRepositoryInterface
{
    /**
     * Obtener todos los PND.
     */
    public function obtenerTodos(): Collection;

    /**
     * Obtener un PND por su ID.
     */
    public function obtenerPorId(int $id): ?Pnd;

    /**
     * Obtener un PND con toda su estructura jerárquica.
     */
    public function obtenerConEstructura(int $id): ?Pnd;
}