<?php

namespace App\Services;

use App\Repositories\Contracts\CatalogoRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CatalogoService
{
    public function __construct(
        private readonly CatalogoRepositoryInterface $repository
    ) {
    }

    /**
     * Obtener los datos del catálogo y su contexto.
     */
    public function datos(
        string $recurso,
        ?int $id = null,
        ?int $padreId = null
    ): array {
        $definicion = CatalogoDefinition::obtener($recurso);

        $padre = isset($definicion['padre'])
            ? CatalogoDefinition::obtener(
                $definicion['padre']['recurso']
            )
            : null;

        $registro = $id
            ? $this->repository->buscar($definicion, $id)
            : null;

        $padreId = $registro && $padre
            ? (int) $registro->{$definicion['padre']['campo']}
            : $padreId;

        $seleccionado = $padre && $padreId
            ? $this->repository->buscar($padre, $padreId)
            : null;

        return [
            'recurso' => $recurso,
            'definicion' => $definicion,
            'registro' => $registro,
            'padreSeleccionado' => $seleccionado,
            'retorno' => $this->rutaRetorno(
                $recurso,
                $registro,
                $seleccionado
            ),
            'padre' => $padre,
            'opciones' => $padre
                ? $this->repository->opciones($padre)
                : collect(),
        ];
    }

    /**
     * Obtener los registros del catálogo.
     */
    public function listar(string $recurso): array
    {
        $datos = $this->datos($recurso);

        $datos['registros'] = $this->repository->listar(
            $datos['definicion']
        );

        return $datos;
    }

    /**
     * Registrar o actualizar conservando las relaciones históricas.
     */
    public function guardar(
        string $recurso,
        array $datos,
        ?int $id = null
    ): Model {
        $definicion = CatalogoDefinition::obtener($recurso);

        try {
            return DB::transaction(function () use (
                $definicion,
                $datos,
                $id
            ) {
                $registro = $id
                    ? $this->repository->buscar(
                        $definicion,
                        $id,
                        true
                    )
                    : null;

                $campo = $definicion['padre']['campo'] ?? null;

                if (
                    $registro
                    && $campo
                    && (int) $registro->$campo !== (int) $datos[$campo]
                    && (
                        ($definicion['padre_inmutable'] ?? false)
                        || $this->repository->tieneDependencias(
                            $definicion,
                            $id
                        )
                    )
                ) {
                    throw ValidationException::withMessages([
                        $campo => 'La pertenencia de este registro debe conservarse para mantener su historial y sus relaciones.',
                    ]);
                }

                return $this->repository->guardar(
                    $definicion,
                    $datos,
                    $registro
                );
            });
        } catch (QueryException $exception) {
            $this->errorIntegridad($exception);
        }
    }

    /**
     * Determinar el destino según el catálogo y su nivel.
     */
    public function rutaRetorno(
        string $recurso,
        ?Model $registro = null,
        ?Model $padre = null
    ): string {
        return match ($recurso) {
            'ods-agendas' => route('ods.agendas.index'),

            'ods' => ($registro?->agenda_id ?? $padre?->id)
                ? route('ods.objetivos.index', [
                    'agenda' => $registro?->agenda_id ?? $padre->id,
                ])
                : route('ods.agendas.index'),

            'ods-metas' => ($registro?->ods_id ?? $padre?->id)
                ? route('ods.metas.index', [
                    'ods' => $registro?->ods_id ?? $padre->id,
                ])
                : route('ods.agendas.index'),

            default => route(
                'catalogos.gestion.index',
                $recurso
            ),
        };
    }

    /**
     * Cambiar el estado conservando el registro.
     */
    public function cambiarEstado(
        string $recurso,
        int $id,
        string $estado
    ): void {
        $definicion = CatalogoDefinition::obtener($recurso);

        DB::transaction(function () use (
            $definicion,
            $id,
            $estado
        ) {
            $registro = $this->repository->buscar(
                $definicion,
                $id,
                true
            );

            $this->repository->guardar(
                $definicion,
                ['estado' => $estado],
                $registro
            );
        });
    }

    /**
     * Convertir errores de integridad en mensajes de validación.
     */
    private function errorIntegridad(
        QueryException $exception
    ): never {
        if (
            in_array(
                (string) ($exception->errorInfo[0] ?? ''),
                ['23000', '23503', '23505'],
                true
            )
        ) {
            throw ValidationException::withMessages([
                'catalogo' => 'La operación no se pudo completar: existe un dato duplicado o una relación con otro registro.',
            ]);
        }

        throw $exception;
    }
}