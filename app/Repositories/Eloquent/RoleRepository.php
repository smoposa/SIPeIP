<?php

namespace App\Repositories\Eloquent;

use App\Models\Rol;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository implements RoleRepositoryInterface
{
    /**
     * Obtener todos los roles ordenados por nombre.
     */
    public function obtenerTodosOrdenados(): Collection
    {
        return Rol::query()
            ->withCount('users')
            ->orderBy('nombre')
            ->get();
    }

    /**
     * Obtener los roles activos permitidos
     * para administradores institucionales.
     */
    public function obtenerAsignablesInstitucion(): Collection
    {
        return Rol::query()
            ->where('estado', 'Activo')
            ->where('asignable_institucion', true)
            ->orderBy('nombre')
            ->get();
    }

    /**
     * Obtener un rol por su ID.
     */
    public function obtenerPorId(int $id): Rol
    {
        return Rol::findOrFail($id);
    }

    /**
     * Obtener el total de roles registrados.
     */
    public function contarTodos(): int
    {
        return Rol::count();
    }

    /**
     * Obtener el total de roles según su estado.
     */
    public function contarPorEstado(string $estado): int
    {
        return Rol::where('estado', $estado)->count();
    }

    /**
     * Crear un nuevo rol.
     */
    public function crear(array $datos): Rol
    {
        return Rol::create($datos);
    }

    /**
     * Actualizar un rol existente.
     */
    public function actualizar(Rol $rol, array $datos): Rol
    {
        $rol->update($datos);

        return $rol->refresh();
    }

    /**
     * Actualizar los roles permitidos
     * para administradores institucionales.
     *
     * Los roles inactivos nunca pueden quedar
     * habilitados para instituciones.
     */
    public function actualizarAsignacionInstitucional(
        array $rolesSeleccionados
    ): void {

        /*
        * Obtener únicamente los IDs seleccionados
        * que correspondan a roles activos.
        */
        $rolesActivosSeleccionados = Rol::query()
            ->where('estado', 'Activo')
            ->whereIn('id', $rolesSeleccionados)
            ->pluck('id')
            ->all();

        /*
        * Deshabilitar la asignación institucional
        * para todos los roles.
        */
        Rol::query()->update([
            'asignable_institucion' => false,
        ]);

        /*
        * Habilitar únicamente los roles activos
        * seleccionados por el Administrador Global.
        */
        if (!empty($rolesActivosSeleccionados)) {

            Rol::query()
                ->whereIn('id', $rolesActivosSeleccionados)
                ->update([
                    'asignable_institucion' => true,
                ]);
        }
    }
}