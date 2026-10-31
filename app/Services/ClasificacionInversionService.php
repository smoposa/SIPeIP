<?php

namespace App\Services;

use App\Models\Macrosector;
use App\Models\Sector;
use App\Models\Subsector;
use App\Repositories\Contracts\ClasificacionInversionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class ClasificacionInversionService
{
    public function __construct(
        private readonly ClasificacionInversionRepositoryInterface $repository,
        private readonly CatalogoService $catalogos
    ) {
    }

    // Consultas generales

    // Obtener el resumen y la clasificación según los permisos del usuario.
    public function obtenerResumen(): array
    {
        $soloActivos = !$this->puedeConsultarHistorial();

        return [
            'totalMacrosectores' => $this->repository
                ->contarMacrosectores(
                    soloActivos: $soloActivos
                ),

            'totalSectores' => $this->repository
                ->contarSectores(
                    soloActivos: $soloActivos
                ),

            'totalSubsectores' => $this->repository
                ->contarSubsectores(
                    soloActivos: $soloActivos
                ),

            'macrosectores' => $this->repository
                ->obtenerJerarquia(
                    soloActivos: $soloActivos
                ),
        ];
    }

    // Obtener la clasificación jerárquica según los permisos del usuario.
    public function obtenerJerarquia(): Collection
    {
        return $this->repository->obtenerJerarquia(
            soloActivos: !$this->puedeConsultarHistorial()
        );
    }

    // Macrosector

    // Obtener los macrosectores activos para los selectores.
    public function obtenerMacrosectoresActivos(): Collection
    {
        return $this->repository->obtenerMacrosectoresActivos();
    }

    // Obtener un macrosector y validar su visibilidad.
    public function obtenerMacrosectorPorId(int $id): Macrosector
    {
        $macrosector = $this->repository->obtenerMacrosectorPorId($id);

        $this->validarEstadoVisible($macrosector->estado);

        return $macrosector;
    }

    // Registrar un macrosector con estado inicial Activo.
    public function crearMacrosector(array $datos): Macrosector
    {
        return $this->repository->crearMacrosector([
            ...$datos,
            'estado' => 'Activo',
        ]);
    }

    // Actualizar la información del macrosector.
    public function actualizarMacrosector(
        Macrosector $macrosector,
        array $datos
    ): Macrosector {
        return $this->repository->actualizarMacrosector(
            $macrosector,
            $datos
        );
    }

    // Actualizar el estado administrativo del macrosector.
    public function actualizarEstadoMacrosector(
        Macrosector $macrosector,
        bool $activo
    ): Macrosector {
        return $this->repository->actualizarMacrosector(
            $macrosector,
            [
                'estado' => $activo
                    ? 'Activo'
                    : 'Inactivo',
            ]
        );
    }

    // Sector

    // Obtener los sectores activos de un macrosector visible.
    public function obtenerSectoresActivosPorMacrosector(
        int $macrosectorId
    ): Collection {
        $this->obtenerMacrosectorPorId($macrosectorId);

        return $this->repository
            ->obtenerSectoresActivosPorMacrosector(
                $macrosectorId
            );
    }

    // Obtener un sector y validar su estado y el de su macrosector.
    public function obtenerSectorPorId(int $id): Sector
    {
        $sector = $this->repository->obtenerSectorPorId($id);

        $this->validarEstadoVisible($sector->estado);

        $this->obtenerMacrosectorPorId(
            (int) $sector->macrosector_id
        );

        return $sector;
    }

    // Registrar un sector con estado inicial Activo.
    public function crearSector(array $datos): Sector
    {
        return $this->repository->crearSector([
            ...$datos,
            'estado' => 'Activo',
        ]);
    }

    // Actualizar la información del sector.
    public function actualizarSector(
        Sector $sector,
        array $datos
    ): Sector {
        return $this->catalogos->guardar(
            'sectores',
            $datos,
            $sector->id
        );
    }

    // Actualizar el estado administrativo del sector.
    public function actualizarEstadoSector(
        Sector $sector,
        bool $activo
    ): Sector {
        return $this->repository->actualizarSector(
            $sector,
            [
                'estado' => $activo
                    ? 'Activo'
                    : 'Inactivo',
            ]
        );
    }

    // Subsector

    // Obtener los subsectores activos de un sector visible.
    public function obtenerSubsectoresActivosPorSector(
        int $sectorId
    ): Collection {
        $this->obtenerSectorPorId($sectorId);

        return $this->repository
            ->obtenerSubsectoresActivosPorSector(
                $sectorId
            );
    }

    // Obtener un subsector y validar su estado y el de sus niveles superiores.
    public function obtenerSubsectorPorId(int $id): Subsector
    {
        $subsector = $this->repository->obtenerSubsectorPorId($id);

        $this->validarEstadoVisible($subsector->estado);

        $this->obtenerSectorPorId(
            (int) $subsector->sector_id
        );

        return $subsector;
    }

    // Registrar un subsector con estado inicial Activo.
    public function crearSubsector(array $datos): Subsector
    {
        return $this->repository->crearSubsector([
            ...$datos,
            'estado' => 'Activo',
        ]);
    }

    // Actualizar la información del subsector.
    public function actualizarSubsector(
        Subsector $subsector,
        array $datos
    ): Subsector {
        return $this->catalogos->guardar(
            'subsectores',
            $datos,
            $subsector->id
        );
    }

    // Actualizar el estado administrativo del subsector.
    public function actualizarEstadoSubsector(
        Subsector $subsector,
        bool $activo
    ): Subsector {
        return $this->repository->actualizarSubsector(
            $subsector,
            [
                'estado' => $activo
                    ? 'Activo'
                    : 'Inactivo',
            ]
        );
    }

    // Listados del catálogo

    // Obtener los macrosectores según los permisos del usuario.
    public function datosListadoMacrosectores(): array
    {
        return [
            'nivel' => 'macrosector',
            'titulo' => 'Clasificación de la inversión',
            'registros' => $this->repository->listarMacrosectoresCatalogo(
                soloActivos: !$this->puedeConsultarHistorial()
            ),
        ];
    }

    // Obtener los sectores de un macrosector visible.
    public function datosListadoSectores(int $macrosectorId): array
    {
        $macrosector = $this->obtenerMacrosectorPorId($macrosectorId);

        return [
            'nivel' => 'sector',
            'titulo' => 'Sectores',
            'macrosector' => $macrosector,
            'registros' => $this->repository->listarSectoresCatalogo(
                $macrosectorId,
                soloActivos: !$this->puedeConsultarHistorial()
            ),
        ];
    }

    // Obtener los subsectores de un sector y macrosector visibles.
    public function datosListadoSubsectores(int $sectorId): array
    {
        $sector = $this->obtenerSectorPorId($sectorId);

        return [
            'nivel' => 'subsector',
            'titulo' => 'Subsectores',
            'sector' => $sector,
            'registros' => $this->repository->listarSubsectoresCatalogo(
                $sectorId,
                soloActivos: !$this->puedeConsultarHistorial()
            ),
        ];
    }

    // Gestión desde el panel

    // Registrar un macrosector desde el panel con estado inicial Activo.
    public function registrarMacrosectorPanel(array $datos): Macrosector
    {
        return $this->repository->crearMacrosector([
            'nombre' => $datos['nombre'],
            'estado' => 'Activo',
        ]);
    }

    // Actualizar los campos permitidos del macrosector desde el panel.
    public function guardarMacrosectorPanel(
        Macrosector $macrosector,
        array $datos
    ): Macrosector {
        return $this->repository->actualizarMacrosector(
            $macrosector,
            $this->camposPanel($datos, ['nombre', 'estado'])
        );
    }

    // Registrar un sector conservando el macrosector fijado desde la ruta.
    public function registrarSectorPanel(
        Macrosector $macrosector,
        array $datos
    ): Sector {
        if ($macrosector->estado !== 'Activo') {
            throw ValidationException::withMessages([
                'nombre' => 'Active el macrosector antes de registrar nuevos sectores.',
            ]);
        }

        return $this->repository->crearSector([
            'macrosector_id' => $macrosector->id,
            'nombre' => $datos['nombre'],
            'estado' => 'Activo',
        ]);
    }

    // Actualizar los campos permitidos del sector desde el panel.
    public function guardarSectorPanel(
        Sector $sector,
        array $datos
    ): Sector {
        return $this->repository->actualizarSector(
            $sector,
            $this->camposPanel($datos, ['nombre', 'estado'])
        );
    }

    // Registrar un subsector conservando el sector de la ruta y el nivel Nacional.
    public function registrarSubsectorPanel(
        Sector $sector,
        array $datos
    ): Subsector {
        $macrosector = $this->repository->obtenerMacrosectorPorId(
            $sector->macrosector_id
        );

        if (
            $sector->estado !== 'Activo'
            || $macrosector->estado !== 'Activo'
        ) {
            throw ValidationException::withMessages([
                'nombre' => 'Active el sector y su macrosector antes de registrar nuevos subsectores.',
            ]);
        }

        return $this->repository->crearSubsector([
            'sector_id' => $sector->id,
            'codigo' => $datos['codigo'],
            'nombre' => $datos['nombre'],
            'nivel_gobierno' => 'Nacional',
            'estado' => 'Activo',
        ]);
    }

    // Actualizar los campos permitidos del subsector desde el panel.
    public function guardarSubsectorPanel(
        Subsector $subsector,
        array $datos
    ): Subsector {
        return $this->repository->actualizarSubsector(
            $subsector,
            $this->camposPanel($datos, ['codigo', 'nombre', 'estado'])
        );
    }

    // Validaciones internas

    // Recibir solo campos permitidos y preservar los campos no enviados.
    private function camposPanel(array $datos, array $permitidos): array
    {
        $campos = array_intersect_key($datos, array_flip($permitidos));

        if (
            array_key_exists('estado', $campos)
            && !in_array($campos['estado'], ['Activo', 'Inactivo'], true)
        ) {
            throw ValidationException::withMessages([
                'estado' => 'El estado seleccionado no es válido.',
            ]);
        }

        return $campos;
    }

    // Bloquear la consulta de registros inactivos para los demás roles.
    private function validarEstadoVisible(?string $estado): void
    {
        abort_unless(
            $this->puedeConsultarHistorial()
                || $estado === 'Activo',
            404
        );
    }

    // Determinar si el usuario puede consultar registros inactivos.
    private function puedeConsultarHistorial(): bool
    {
        return in_array(
            auth()->user()?->rol?->codigo,
            ['ADMIN_GLOBAL', 'ADMIN_SISTEMA'],
            true
        );
    }
}