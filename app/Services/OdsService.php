<?php

namespace App\Services;

use App\Models\Ods;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\OdsRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class OdsService
{
    public function __construct(
        private readonly OdsRepositoryInterface $odsRepository
    ) {
    }

    public function listarAgendas(): LengthAwarePaginator
    {
        return $this->odsRepository->listarAgendas();
    }

    public function datosAgenda(int $id): array
    {
        return [
            'agenda' => $this->odsRepository->obtenerAgenda($id),
            'ods' => $this->odsRepository->obtenerTodosOrdenados($id),
        ];
    }

    /**
     * Obtener todos los ODS ordenados.
     */
    public function obtenerTodos(): Collection
    {
        return $this->odsRepository->obtenerTodosOrdenados();
    }

    /**
     * Obtener un ODS con sus metas asociadas.
     */
    public function obtenerConMetas(Ods $ods): Ods
    {
        return $this->odsRepository->obtenerConMetas($ods);
    }
}