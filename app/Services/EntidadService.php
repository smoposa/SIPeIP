<?php

namespace App\Services;

use App\Enums\EstadoEntidad;
use App\Models\Entidad;
use App\Models\User;
use App\Repositories\Contracts\EntidadRepositoryInterface;

class EntidadService
{
    public function __construct(
        private readonly EntidadRepositoryInterface $entidadRepository
    ) {
    }

    public function obtenerResumen(User $usuarioAutenticado): array
    {
        $global = $this->esAdministradorGlobal($usuarioAutenticado);
        // Un usuario sin entidad nunca recibe acceso global.
        $entidadId = $global ? null : (int) $usuarioAutenticado->entidad_id;
        $buscar = trim(request()->string('buscar')->toString());
        $estado = request()->string('estado')->toString();
        $porPagina = request()->integer('per_page', 7);

        if (!in_array($estado, ['Activo', 'Inactivo'], true)) {
            $estado = '';
        }
        if (!in_array($porPagina, [7, 10, 15], true)) {
            $porPagina = 7;
        }

        $activas = $global
            ? $this->entidadRepository->contarPorEstado(EstadoEntidad::ACTIVO->value)
            : $this->entidadRepository->contarPorEstadoYEntidad(EstadoEntidad::ACTIVO->value, $entidadId);
        $inactivas = $global
            ? $this->entidadRepository->contarPorEstado(EstadoEntidad::INACTIVO->value)
            : $this->entidadRepository->contarPorEstadoYEntidad(EstadoEntidad::INACTIVO->value, $entidadId);

        return [
            'totalEntidades' => $global ? $this->entidadRepository->contarTodas() : $activas + $inactivas,
            'entidadesActivas' => $activas,
            'entidadesInactivas' => $inactivas,
            'entidades' => $this->entidadRepository->obtenerPaginadas($entidadId, $buscar, $estado, $porPagina),
        ];
    }

    public function obtenerPorId(int $id, User $usuarioAutenticado): Entidad
    {
        $entidad = $this->entidadRepository->obtenerPorId($id);
        if ($this->esAdministradorGlobal($usuarioAutenticado)) {
            return $entidad;
        }
        if ($entidad->id !== $usuarioAutenticado->entidad_id) {
            abort(403, 'No tiene autorización para acceder a esta entidad.');
        }
        return $entidad;
    }

    public function crear(array $datos): Entidad
    {
        return $this->entidadRepository->crear([
            ...$datos,
            'estado' => EstadoEntidad::ACTIVO->value,
        ]);
    }

    public function actualizar(Entidad $entidad, array $datos): Entidad
    {
        return $this->entidadRepository->actualizar($entidad, $datos);
    }

    public function actualizarEstado(Entidad $entidad, bool $activo): Entidad
    {
        return $this->entidadRepository->actualizar($entidad, [
            'estado' => $activo ? EstadoEntidad::ACTIVO->value : EstadoEntidad::INACTIVO->value,
        ]);
    }

    private function esAdministradorGlobal(User $usuario): bool
    {
        return $usuario->rol?->codigo === 'ADMIN_GLOBAL';
    }
}
