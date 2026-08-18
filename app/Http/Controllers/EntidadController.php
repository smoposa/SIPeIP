<?php

namespace App\Http\Controllers;

use App\Http\Requests\Entidades\StoreEntidadRequest;
use App\Http\Requests\Entidades\UpdateEntidadRequest;
use App\Http\Requests\Entidades\UpdateEntidadStatusRequest;
use App\Services\EntidadService;

class EntidadController extends Controller
{
    public function __construct(
        private readonly EntidadService $entidadService
    ) {
    }

    /**
     * Panel principal del módulo de entidades.
     */
    public function index()
    {
        $this->autorizar('entidades');

        $resumen = $this->entidadService->obtenerResumen();

        return view('entidades.index', $resumen);
    }

    /**
     * Mostrar formulario para crear una entidad.
     */
    public function create()
    {
        $this->autorizar('entidades', 'crear');

        return view('entidades.create');
    }

    /**
     * Registrar una nueva entidad.
     */
    public function store(StoreEntidadRequest $request)
    {
        $this->autorizar('entidades', 'crear');

        $this->entidadService->crear($request->validated());

        return redirect()
            ->route('entidades.index')
            ->with('success', 'Entidad registrada correctamente.');
    }

    /**
     * Mostrar detalle de una entidad.
     */
    public function detalle(int $id)
    {
        $this->autorizar('entidades');

        $entidad = $this->entidadService->obtenerPorId($id);

        return view('entidades.detalle', compact('entidad'));
    }

    /**
     * Mostrar formulario para editar una entidad.
     */
    public function edit(int $id)
    {
        $this->autorizar('entidades', 'editar');

        $entidad = $this->entidadService->obtenerPorId($id);

        return view('entidades.editar', compact('entidad'));
    }

    /**
     * Actualizar una entidad.
     */
    public function update(UpdateEntidadRequest $request, int $id)
    {
        $this->autorizar('entidades', 'editar');

        $entidad = $this->entidadService->obtenerPorId($id);

        $this->entidadService->actualizar(
            $entidad,
            $request->validated()
        );

        return redirect()
            ->route('entidades.detalle', $entidad->id)
            ->with('success', 'Entidad actualizada correctamente.');
    }

    /**
     * Mostrar formulario para modificar el estado.
     */
    public function editarEstado(int $id)
    {
        $this->autorizar('entidades', 'estado');

        $entidad = $this->entidadService->obtenerPorId($id);

        return view('entidades.editarestado', compact('entidad'));
    }

    /**
     * Actualizar estado de la entidad.
     */
    public function actualizarEstado(
        UpdateEntidadStatusRequest $request,
        int $id
    ) {
        $this->autorizar('entidades', 'estado');

        $entidad = $this->entidadService->obtenerPorId($id);

        $this->entidadService->actualizarEstado(
            $entidad,
            $request->boolean('estado')
        );

        return redirect()
            ->route('entidades.detalle', $entidad->id)
            ->with('success', 'Estado de la entidad actualizado correctamente.');
    }
}