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

    // Mostrar el listado de entidades.
    public function index()
    {
        $this->autorizar('entidades');

        $resumen = $this->entidadService->obtenerResumen(
            auth()->user()
        );

        return view('entidades.index', $resumen);
    }

    // Mostrar el formulario de creación.
    public function create()
    {
        $this->autorizar('entidades', 'crear');

        return view('entidades.create');
    }

    // Registrar una nueva entidad.
    public function store(StoreEntidadRequest $request)
    {
        $this->autorizar('entidades', 'crear');

        $this->entidadService->crear(
            $request->validated()
        );

        return redirect()
            ->route('entidades.index')
            ->with(
                'success',
                'Entidad registrada correctamente.'
            );
    }

    // Mostrar el detalle de una entidad accesible para el usuario.
    public function detalle(int $id)
    {
        $this->autorizar('entidades');

        $entidad = $this->entidadService->obtenerPorId(
            $id,
            auth()->user()
        );

        return view(
            'entidades.detalle',
            compact('entidad')
        );
    }

    // Redirigir al detalle y abrir el panel de información.
    public function edit(int $id)
    {
        $this->autorizar('entidades', 'editar');

        $entidad = $this->entidadService->obtenerPorId(
            $id,
            auth()->user()
        );

        return redirect()
            ->route('entidades.detalle', $entidad->id)
            ->with('abrir_panel_entidad', 'informacion');
    }

    // Actualizar la información de una entidad.
    public function update(
        UpdateEntidadRequest $request,
        int $id
    ) {
        $this->autorizar('entidades', 'editar');

        $entidad = $this->entidadService->obtenerPorId(
            $id,
            auth()->user()
        );

        $this->entidadService->actualizar(
            $entidad,
            $request->validated()
        );

        return redirect()
            ->route('entidades.detalle', $entidad->id)
            ->with(
                'success',
                'Entidad actualizada correctamente.'
            );
    }

    // Redirigir al detalle y abrir el panel de estado.
    public function editarEstado(int $id)
    {
        $this->autorizar('entidades', 'estado');

        $entidad = $this->entidadService->obtenerPorId(
            $id,
            auth()->user()
        );

        return redirect()
            ->route('entidades.detalle', $entidad->id)
            ->with('abrir_panel_entidad', 'estado');
    }

    // Actualizar el estado de una entidad.
    public function actualizarEstado(
        UpdateEntidadStatusRequest $request,
        int $id
    ) {
        $this->autorizar('entidades', 'estado');

        $entidad = $this->entidadService->obtenerPorId(
            $id,
            auth()->user()
        );

        $this->entidadService->actualizarEstado(
            $entidad,
            $request->boolean('estado')
        );

        return redirect()
            ->route('entidades.detalle', $entidad->id)
            ->with(
                'success',
                'Estado de la entidad actualizado correctamente.'
            );
    }
}