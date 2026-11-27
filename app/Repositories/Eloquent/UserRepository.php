<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Models\Entidad;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{
    public function obtenerTodos(): Collection
    {
        return User::with(['rol', 'entidad'])->orderBy('apellidos')->orderBy('nombres')->get();
    }

    public function obtenerPorEntidad(int $entidadId): Collection
    {
        return User::with(['rol', 'entidad'])->where('entidad_id', $entidadId)->orderBy('apellidos')->orderBy('nombres')->get();
    }

    /** Consultar usuarios agrupados por entidad, con filtros y paginación. */
    public function obtenerPaginados(?int $entidadId, string $buscar = '', string $estado = '', int $porPagina = 7, bool $sinEntidad = false): LengthAwarePaginator
    {
        return User::with(['rol', 'entidad'])
            ->when($entidadId !== null, fn ($q) => $q->where('entidad_id', $entidadId))
            ->when($sinEntidad, fn ($q) => $q->whereNull('entidad_id'))
            ->when($estado !== '', fn ($q) => $q->where('estado', $estado))
            ->when($buscar !== '', function ($q) use ($buscar) {
                $texto = "%{$buscar}%";
                $q->where(function ($q) use ($texto) {
                    $q->where('name', 'like', $texto)
                        ->orWhere('nombres', 'like', $texto)
                        ->orWhere('apellidos', 'like', $texto)
                        ->orWhere('email', 'like', $texto)
                        ->orWhere('identificacion', 'like', $texto)
                        ->orWhere('cargo', 'like', $texto)
                        ->orWhereHas('rol', fn ($r) => $r->where('nombre', 'like', $texto))
                        ->orWhereHas('entidad', fn ($e) => $e->where('nombre', 'like', $texto));
                });
            })
            ->orderByRaw('CASE WHEN entidad_id IS NULL THEN 1 ELSE 0 END')
            ->orderBy(Entidad::query()->select('nombre')->whereColumn('entidades.id', 'users.entidad_id')->limit(1))
            ->orderBy('entidad_id')->orderBy('apellidos')->orderBy('nombres')->orderBy('id')
            ->paginate($porPagina)->withQueryString();
    }

    public function buscarPorId(int $id): User
    {
        return User::with(['rol', 'entidad'])->findOrFail($id);
    }

    public function contarTodos(): int { return User::count(); }
    public function contarPorEntidad(int $entidadId): int { return User::where('entidad_id', $entidadId)->count(); }
    public function contarPorEstado(string $estado, ?int $entidadId = null): int
    {
        return User::where('estado', $estado)->when($entidadId !== null, fn ($q) => $q->where('entidad_id', $entidadId))->count();
    }
    public function contarAdministradoresGlobalesActivos(): int
    {
        return User::where('estado', 'Activo')->whereHas('rol', fn ($q) => $q->where('codigo', 'ADMIN_GLOBAL'))->count();
    }
    public function crear(array $datos): User { return User::create($datos); }
    public function actualizar(User $usuario, array $datos): bool { return $usuario->update($datos); }
}
