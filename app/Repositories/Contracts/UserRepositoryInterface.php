<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function obtenerTodos(): Collection;
    public function obtenerPorEntidad(int $entidadId): Collection;
    public function obtenerPaginados(?int $entidadId, string $buscar = '', string $estado = '', int $porPagina = 7, bool $sinEntidad = false): LengthAwarePaginator;
    public function buscarPorId(int $id): User;
    public function contarTodos(): int;
    public function contarPorEntidad(int $entidadId): int;
    public function contarPorEstado(string $estado, ?int $entidadId = null): int;
    public function contarAdministradoresGlobalesActivos(): int;
    public function crear(array $datos): User;
    public function actualizar(User $usuario, array $datos): bool;
}
