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

    // Listar planes nacionales según los permisos del usuario.
    public function listarPlanes(): LengthAwarePaginator
    {
        return $this->pndRepository->listarPlanes(
            soloActivos: !$this->puedeConsultarHistorial()
        );
    }

    // Obtener un plan nacional y validar su visibilidad.
    public function obtenerPlan(int $id): Pnd
    {
        $pnd = $this->pndRepository->obtenerPlan($id);

        $this->validarVisibilidadPlan($pnd);

        return $pnd;
    }

    // Registrar un plan con estado inicial Activo.
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

    // Actualizar los campos validados y autorizados del plan.
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

    // Obtener el plan visible con sus ejes.
    public function obtenerPlanConEjes(int $id): Pnd
    {
        $this->obtenerPlan($id);

        return $this->pndRepository->obtenerPlanConEjes($id);
    }

    // Obtener la estructura completa de un plan visible.
    public function obtenerEstructura(?int $id = null): ?Pnd
    {
        if ($id !== null) {
            $this->obtenerPlan($id);
        }

        return $this->pndRepository->obtenerConEstructura(
            $id,
            soloActivos: !$this->puedeConsultarHistorial()
        );
    }

    // Registrar una política con su relación fija y estado inicial Activo.
    public function crearPolitica(
        PndObjetivo $objetivo,
        array $datos
    ): PndPolitica {
        return $this->pndRepository->crearPolitica([
            'pnd_objetivo_id' => $objetivo->id,
            'codigo' => $datos['codigo'],
            'nombre' => $datos['nombre'],
            'estado' => 'Activo',
        ]);
    }

    // Actualizar los campos validados y autorizados de la política.
    public function actualizarPolitica(
        PndObjetivo $objetivo,
        PndPolitica $registro,
        array $datos
    ): PndPolitica {
        abort_unless(
            (int) $registro->pnd_objetivo_id === (int) $objetivo->id,
            404
        );

        $campos = array_intersect_key($datos, array_flip([
            'codigo',
            'nombre',
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

        return $this->pndRepository->actualizarPolitica(
            $registro,
            $campos
        );
    }

    // Registrar una estrategia con su relación fija y estado inicial Activo.
    public function crearEstrategia(
        PndObjetivo $objetivo,
        PndPolitica $politica,
        array $datos
    ): PndEstrategia {
        abort_unless(
            (int) $politica->pnd_objetivo_id === (int) $objetivo->id,
            404
        );

        return $this->pndRepository->crearEstrategia([
            'pnd_politica_id' => $politica->id,
            'codigo' => $datos['codigo'],
            'descripcion' => $datos['descripcion'],
            'estado' => 'Activo',
        ]);
    }

    // Actualizar los campos validados y autorizados de la estrategia.
    public function actualizarEstrategia(
        PndObjetivo $objetivo,
        PndPolitica $politica,
        PndEstrategia $registro,
        array $datos
    ): PndEstrategia {
        abort_unless(
            (int) $politica->pnd_objetivo_id === (int) $objetivo->id,
            404
        );

        abort_unless(
            (int) $registro->pnd_politica_id === (int) $politica->id,
            404
        );

        $campos = array_intersect_key($datos, array_flip([
            'codigo',
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

        return $this->pndRepository->actualizarEstrategia(
            $registro,
            $campos
        );
    }

    // Registrar una meta con su relación fija y estado inicial Activo.
    public function crearMeta(
        PndObjetivo $objetivo,
        array $datos
    ): PndMeta {
        return $this->pndRepository->crearMeta([
            'pnd_objetivo_id' => $objetivo->id,
            'numero' => $datos['numero'],
            'descripcion' => $datos['descripcion'],
            'estado' => 'Activo',
        ]);
    }

    // Actualizar los campos validados y autorizados de la meta.
    public function actualizarMeta(
        PndObjetivo $objetivo,
        PndMeta $registro,
        array $datos
    ): PndMeta {
        abort_unless(
            (int) $registro->pnd_objetivo_id === (int) $objetivo->id,
            404
        );

        $campos = array_intersect_key($datos, array_flip([
            'numero',
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

        return $this->pndRepository->actualizarMeta(
            $registro,
            $campos
        );
    }

    // Obtener los totales de la estructura de un plan visible.
    public function obtenerResumen(?int $id = null): array
    {
        if ($id !== null) {
            $this->obtenerPlan($id);
        }

        return $this->pndRepository->obtenerResumen(
            $id,
            soloActivos: !$this->puedeConsultarHistorial()
        );
    }

    // Obtener el plan y su resumen para la pantalla de inicio.
    public function obtenerDatosIndex(?int $id = null): array
    {
        return [
            'pnd' => $this->obtenerEstructura($id),
            'resumen' => $this->obtenerResumen($id),
        ];
    }

    // Ejes

    // Obtener un eje con sus objetivos y validar el plan.
    public function obtenerEjeConObjetivos(int $id): PndEje
    {
        $eje = $this->pndRepository->obtenerEjeConObjetivos($id);

        $this->obtenerPlan((int) $eje->pnd_id);

        return $eje;
    }

    // Registrar un eje dentro del plan seleccionado.
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

    // Actualizar la información y el estado del eje.
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

        return $this->pndRepository->actualizarEje(
            $eje,
            $campos
        );
    }

    // Objetivos

    // Obtener un objetivo con su detalle y validar el plan.
    public function obtenerObjetivoConDetalle(int $id): ?PndObjetivo
    {
        $objetivo = $this->pndRepository->obtenerObjetivoConDetalle($id);

        if ($objetivo === null) {
            return null;
        }

        abort_if($objetivo->eje === null, 404);

        $this->obtenerPlan((int) $objetivo->eje->pnd_id);

        return $objetivo;
    }

    // Registrar un objetivo dentro del eje seleccionado.
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

    // Actualizar la información y el estado del objetivo.
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

    // Validar si el usuario puede consultar el plan seleccionado.
    private function validarVisibilidadPlan(Pnd $pnd): void
    {
        abort_unless(
            $this->puedeConsultarHistorial()
                || $pnd->estado === 'Activo',
            404
        );
    }

    // Determinar si el usuario puede consultar planes inactivos.
    private function puedeConsultarHistorial(): bool
    {
        return in_array(
            auth()->user()?->rol?->codigo,
            ['ADMIN_GLOBAL', 'ADMIN_SISTEMA'],
            true
        );
    }
}