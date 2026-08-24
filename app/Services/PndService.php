<?php

namespace App\Services;

use App\Models\Pnd;
use App\Models\PndObjetivo;
use App\Repositories\Contracts\PndRepositoryInterface;

class PndService
{
    public function __construct(
        private readonly PndRepositoryInterface $pndRepository
    ) {
    }

    /**
     * Obtener la estructura completa del
     * Plan Nacional de Desarrollo.
     */
    public function obtenerEstructura(): ?Pnd
    {
        return $this->pndRepository->obtenerConEstructura();
    }

    /**
     * Obtener los totales generales del
     * Plan Nacional de Desarrollo.
     */
    public function obtenerResumen(): array
    {
        return $this->pndRepository->obtenerResumen();
    }

    /**
     * Obtener toda la información necesaria
     * para la pantalla principal del PND.
     */
    public function obtenerDatosIndex(): array
    {
        return [
            'pnd' => $this->obtenerEstructura(),
            'resumen' => $this->obtenerResumen(),
        ];
    }

    /**
     * Obtener un Objetivo Nacional con su
     * eje, políticas, estrategias y metas.
     */
    public function obtenerObjetivoConDetalle(int $id): ?PndObjetivo
    {
        return $this->pndRepository->obtenerObjetivoConDetalle($id);
    }
}