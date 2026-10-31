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

    // Listar los planes nacionales con filtro opcional de estado.
    public function listarPlanes(
        bool $soloActivos = true
    ): LengthAwarePaginator;

    // Obtener un plan nacional.
    public function obtenerPlan(int $id): Pnd;

    // Registrar un plan nacional.
    public function crearPlan(array $datos): Pnd;

    // Actualizar información y estado de un plan nacional.
    public function actualizarPlan(Pnd $pnd, array $datos): Pnd;

    // Registrar una política.
    public function crearPolitica(array $datos): PndPolitica;

    // Actualizar una política.
    public function actualizarPolitica(
        PndPolitica $registro,
        array $datos
    ): PndPolitica;

    // Registrar una estrategia.
    public function crearEstrategia(array $datos): PndEstrategia;

    // Actualizar una estrategia.
    public function actualizarEstrategia(
        PndEstrategia $registro,
        array $datos
    ): PndEstrategia;

    // Registrar una meta.
    public function crearMeta(array $datos): PndMeta;

    // Actualizar una meta.
    public function actualizarMeta(
        PndMeta $registro,
        array $datos
    ): PndMeta;

    // Obtener un plan con sus ejes y la cantidad de objetivos por eje.
    public function obtenerPlanConEjes(int $id): Pnd;

    // Obtener un plan con su estructura completa y filtro opcional de estado.
    public function obtenerConEstructura(
        ?int $id = null,
        bool $soloActivos = true
    ): ?Pnd;

    // Obtener los totales de ejes, objetivos, políticas, estrategias y metas.
    public function obtenerResumen(
        ?int $id = null,
        bool $soloActivos = true
    ): array;

    // Ejes

    // Obtener un eje con sus objetivos.
    public function obtenerEjeConObjetivos(int $id): PndEje;

    // Registrar un eje.
    public function crearEje(array $datos): PndEje;

    // Actualizar un eje.
    public function actualizarEje(PndEje $eje, array $datos): PndEje;

    // Objetivos

    // Obtener un objetivo con su eje, políticas, estrategias y metas.
    public function obtenerObjetivoConDetalle(int $id): ?PndObjetivo;

    // Registrar un objetivo.
    public function crearObjetivo(array $datos): PndObjetivo;

    // Actualizar un objetivo.
    public function actualizarObjetivo(
        PndObjetivo $objetivo,
        array $datos
    ): PndObjetivo;
}