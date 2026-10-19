<?php

namespace App\Repositories\Contracts;

use App\Models\Pnd;
use App\Models\PndEje;
use App\Models\PndPolitica;
use App\Models\PndObjetivo;
use App\Models\PndEstrategia;
use App\Models\PndMeta;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PndRepositoryInterface
{
    // Planes nacionales

    /**
     * Listar los planes nacionales con su cantidad de ejes.
     */
    public function listarPlanes(): LengthAwarePaginator;

    /**
     * Obtener un plan nacional.
     */
    public function obtenerPlan(int $id): Pnd;

    /**
     * Registrar un plan nacional.
     */
    public function crearPlan(array $datos): Pnd;

    /**
     * Actualizar información y estado de un plan nacional.
     */
    public function actualizarPlan(Pnd $pnd, array $datos): Pnd;

  public function crearPolitica(array $datos): PndPolitica;

    public function actualizarPolitica(PndPolitica $registro, array $datos): PndPolitica;

    public function crearEstrategia(array $datos): PndEstrategia;

    public function actualizarEstrategia(PndEstrategia $registro, array $datos): PndEstrategia;

    public function crearMeta(array $datos): PndMeta;

    public function actualizarMeta(PndMeta $registro, array $datos): PndMeta;

    /**
     * Obtener un plan con sus ejes y la cantidad de objetivos por eje.
     */
    public function obtenerPlanConEjes(int $id): Pnd;

    /**
     * Obtener un plan con su estructura completa.
     */
    public function obtenerConEstructura(?int $id = null): ?Pnd;

    /**
     * Obtener los totales de la estructura de un plan.
     *
     * @return array{
     *     ejes: int,
     *     objetivos: int,
     *     politicas: int,
     *     estrategias: int,
     *     metas: int
     * }
     */
    public function obtenerResumen(?int $id = null): array;

    // Ejes

    /**
     * Obtener un eje con sus objetivos.
     */
    public function obtenerEjeConObjetivos(int $id): PndEje;

    /**
     * Registrar un eje.
     */
    public function crearEje(array $datos): PndEje;

    /**
     * Actualizar un eje.
     */
    public function actualizarEje(PndEje $eje, array $datos): PndEje;

    // Objetivos

    /**
     * Obtener un objetivo con su eje, políticas, estrategias y metas.
     */
    public function obtenerObjetivoConDetalle(int $id): ?PndObjetivo;

    /**
     * Registrar un objetivo.
     */
    public function crearObjetivo(array $datos): PndObjetivo;

    /**
     * Actualizar un objetivo.
     */
    public function actualizarObjetivo(
        PndObjetivo $objetivo,
        array $datos
    ): PndObjetivo;
}