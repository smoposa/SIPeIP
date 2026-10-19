<?php

namespace App\Services;

use App\Models\Pnd;
use App\Models\PndEje;
use App\Models\PndObjetivo;
use App\Models\PndPolitica;
use App\Models\PndEstrategia;
use App\Models\PndMeta;
use App\Repositories\Contracts\PndRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;

class PndService
{
    public function __construct(
        private readonly PndRepositoryInterface $pndRepository
    ) {
    }

    // Planes nacionales

    /**
     * Listar los planes nacionales registrados.
     */
    public function listarPlanes(): LengthAwarePaginator
    {
        return $this->pndRepository->listarPlanes();
    }

    /**
     * Obtener un plan nacional.
     */
    public function obtenerPlan(int $id): Pnd
    {
        return $this->pndRepository->obtenerPlan($id);
    }

    /**
     * Registrar un plan con estado inicial Activo.
     */
    public function crearPlan(array $datos): Pnd
    {
        return $this->pndRepository->crearPlan([
            'nombre' => $datos['nombre'],
            'periodo_inicio' => $datos['periodo_inicio'],
            'periodo_fin' => $datos['periodo_fin'],
            'descripcion' => $datos['descripcion'] ?? null,
            'estado' => 'Activo',
        ]);
    }

    /**
     * Actualizar los campos validados y autorizados del plan.
     */
    public function actualizarPlan(int $id, array $datos): Pnd
    {
        $pnd = $this->obtenerPlan($id);

        $campos = array_intersect_key($datos, array_flip([
            'nombre',
            'periodo_inicio',
            'periodo_fin',
            'descripcion',
            'estado',
        ]));

        if (
            array_key_exists('estado', $campos)
            && !in_array($campos['estado'], ['Activo', 'Inactivo'], true)
        ) {
            throw ValidationException::withMessages([
                'estado' => 'El estado seleccionado no es válido.',
            ]);
        }

        return $this->pndRepository->actualizarPlan(
            $pnd,
            $campos
        );
    }

    /**
     * Obtener el plan seleccionado con sus ejes.
     */
    public function obtenerPlanConEjes(int $id): Pnd
    {
        return $this->pndRepository->obtenerPlanConEjes($id);
    }

    /**
     * Obtener la estructura completa de un plan.
     */
    public function obtenerEstructura(?int $id = null): ?Pnd
    {
        return $this->pndRepository->obtenerConEstructura($id);
    }

 /**
     * Registrar una política con su relación fija y estado inicial Activo.
     */
    public function crearPolitica(PndObjetivo $objetivo, array $datos): PndPolitica
    {
        return $this->pndRepository->crearPolitica([
            'pnd_objetivo_id' => $objetivo->id,
            'codigo' => $datos['codigo'],
            'nombre' => $datos['nombre'],
            'estado' => 'Activo',
        ]);
    }

    /**
     * Actualizar únicamente los campos validados y autorizados.
     */
    public function actualizarPolitica(PndObjetivo $objetivo, PndPolitica $registro, array $datos): PndPolitica
    {
        abort_unless((int) $registro->pnd_objetivo_id === (int) $objetivo->id, 404);

        $campos = array_intersect_key($datos, array_flip([
            'codigo',
            'nombre',
            'estado',
        ]));

        if (
            array_key_exists('estado', $campos)
            && !in_array($campos['estado'], ['Activo', 'Inactivo'], true)
        ) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'estado' => 'El estado seleccionado no es válido.',
            ]);
        }

        return $this->pndRepository->actualizarPolitica($registro, $campos);
    }

    /**
     * Registrar una estrategia con su relación fija y estado inicial Activo.
     */
    public function crearEstrategia(PndObjetivo $objetivo, PndPolitica $politica, array $datos): PndEstrategia
    {
        abort_unless((int) $politica->pnd_objetivo_id === (int) $objetivo->id, 404);

        return $this->pndRepository->crearEstrategia([
            'pnd_politica_id' => $politica->id,
            'codigo' => $datos['codigo'],
            'descripcion' => $datos['descripcion'],
            'estado' => 'Activo',
        ]);
    }

    /**
     * Actualizar únicamente los campos validados y autorizados.
     */
    public function actualizarEstrategia(PndObjetivo $objetivo, PndPolitica $politica, PndEstrategia $registro, array $datos): PndEstrategia
    {
        abort_unless((int) $politica->pnd_objetivo_id === (int) $objetivo->id, 404);

        abort_unless((int) $registro->pnd_politica_id === (int) $politica->id, 404);

        $campos = array_intersect_key($datos, array_flip([
            'codigo',
            'descripcion',
            'estado',
        ]));

        if (
            array_key_exists('estado', $campos)
            && !in_array($campos['estado'], ['Activo', 'Inactivo'], true)
        ) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'estado' => 'El estado seleccionado no es válido.',
            ]);
        }

        return $this->pndRepository->actualizarEstrategia($registro, $campos);
    }

    /**
     * Registrar una meta con su relación fija y estado inicial Activo.
     */
    public function crearMeta(PndObjetivo $objetivo, array $datos): PndMeta
    {
        return $this->pndRepository->crearMeta([
            'pnd_objetivo_id' => $objetivo->id,
            'numero' => $datos['numero'],
            'descripcion' => $datos['descripcion'],
            'estado' => 'Activo',
        ]);
    }

    /**
     * Actualizar únicamente los campos validados y autorizados.
     */
    public function actualizarMeta(PndObjetivo $objetivo, PndMeta $registro, array $datos): PndMeta
    {
        abort_unless((int) $registro->pnd_objetivo_id === (int) $objetivo->id, 404);

        $campos = array_intersect_key($datos, array_flip([
            'numero',
            'descripcion',
            'estado',
        ]));

        if (
            array_key_exists('estado', $campos)
            && !in_array($campos['estado'], ['Activo', 'Inactivo'], true)
        ) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'estado' => 'El estado seleccionado no es válido.',
            ]);
        }

        return $this->pndRepository->actualizarMeta($registro, $campos);
    }

    /**
     * Obtener los totales de la estructura de un plan.
     */
    public function obtenerResumen(?int $id = null): array
    {
        return $this->pndRepository->obtenerResumen($id);
    }

    /**
     * Obtener el plan y su resumen para la pantalla de inicio.
     */
    public function obtenerDatosIndex(?int $id = null): array
    {
        return [
            'pnd' => $this->obtenerEstructura($id),
            'resumen' => $this->obtenerResumen($id),
        ];
    }

    // Ejes

    /**
     * Obtener los datos para listar los objetivos de un eje.
     */
    public function obtenerEjeConObjetivos(int $id): PndEje
    {
        return $this->pndRepository->obtenerEjeConObjetivos($id);
    }

    /**
     * Registrar un eje dentro del plan seleccionado.
     */
    public function crearEje(int $pndId, array $datos): PndEje
    {
        $pnd = $this->pndRepository->obtenerPlan($pndId);

        return $this->pndRepository->crearEje([
            'pnd_id' => $pnd->id,
            'numero' => $datos['numero'],
            'nombre' => $datos['nombre'],
            'descripcion' => $datos['descripcion'] ?? null,
            'estado' => 'Activo',
        ]);
    }

    /**
     * Actualizar la información y el estado del eje.
     */
    public function actualizarEje(PndEje $eje, array $datos): PndEje
    {
        $campos = array_intersect_key($datos, array_flip([
            'numero',
            'nombre',
            'descripcion',
            'estado',
        ]));

        if (
            array_key_exists('estado', $campos)
            && !in_array($campos['estado'], ['Activo', 'Inactivo'], true)
        ) {
            throw ValidationException::withMessages([
                'estado' => 'El estado seleccionado no es válido.',
            ]);
        }

        return $this->pndRepository->actualizarEje($eje, $campos);
    }

    // Objetivos

    /**
     * Obtener un objetivo con su eje, políticas, estrategias y metas.
     */
    public function obtenerObjetivoConDetalle(int $id): ?PndObjetivo
    {
        return $this->pndRepository->obtenerObjetivoConDetalle($id);
    }

    /**
     * Registrar un objetivo dentro del eje seleccionado.
     */
    public function crearObjetivo(
        PndEje $eje,
        array $datos
    ): PndObjetivo {
        return $this->pndRepository->crearObjetivo([
            'pnd_eje_id' => $eje->id,
            'numero' => $datos['numero'],
            'nombre' => $datos['nombre'],
            'descripcion' => $datos['descripcion'] ?? null,
            'estado' => 'Activo',
        ]);
    }

    /**
     * Actualizar la información y el estado del objetivo.
     */
    public function actualizarObjetivo(
        PndObjetivo $objetivo,
        array $datos
    ): PndObjetivo {
        $campos = array_intersect_key($datos, array_flip([
            'numero',
            'nombre',
            'descripcion',
            'estado',
        ]));

        if (
            array_key_exists('estado', $campos)
            && !in_array($campos['estado'], ['Activo', 'Inactivo'], true)
        ) {
            throw ValidationException::withMessages([
                'estado' => 'El estado seleccionado no es válido.',
            ]);
        }

        return $this->pndRepository->actualizarObjetivo(
            $objetivo,
            $campos
        );
    }
}