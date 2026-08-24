<?php

namespace App\Repositories\Contracts;

use App\Models\Pnd;
use App\Models\PndObjetivo;

interface PndRepositoryInterface
{
    /**
     * Obtiene el Plan Nacional de Desarrollo con toda
     * la estructura necesaria para su visualización.
     *
     * PND
     * └── Ejes
     *     └── Objetivos
     *         ├── Políticas
     *         │   └── Estrategias
     *         └── Metas
     */
    public function obtenerConEstructura(): ?Pnd;

    /**
     * Obtiene los totales generales de la estructura
     * del Plan Nacional de Desarrollo.
     *
     * @return array{
     *     ejes: int,
     *     objetivos: int,
     *     politicas: int,
     *     estrategias: int,
     *     metas: int
     * }
     */
    public function obtenerResumen(): array;

    /**
     * Obtiene un Objetivo Nacional con la información
     * necesaria para mostrar su detalle.
     *
     * Objetivo
     * ├── Eje
     * ├── Políticas
     * │   └── Estrategias
     * └── Metas
     */
    public function obtenerObjetivoConDetalle(int $id): ?PndObjetivo;
}