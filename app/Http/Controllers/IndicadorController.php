<?php

namespace App\Http\Controllers;

use App\Http\Requests\Indicadores\StoreIndicadorRequest;
use App\Http\Requests\Indicadores\UpdateIndicadorRequest;
use App\Http\Requests\Indicadores\UpdateIndicadorStatusRequest;
use App\Services\IndicadorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class IndicadorController extends Controller
{
    public function __construct(
        private readonly IndicadorService $indicadorService
    ) {
    }

    /**
     * Listar indicadores de la entidad.
     */
    public function listar(): View
    {
        $this->autorizar('indicadores');

        $usuario = auth()->user();

        $indicadores = $this->indicadorService
            ->listar(
                $usuario
            );

        $resumen = $this->indicadorService
            ->obtenerResumen(
                $usuario
            );

        return view('indicadores.listar', [
            'indicadores' =>
                $indicadores,

            'totalIndicadores' =>
                $resumen['totalIndicadores'],

            'indicadoresActivos' =>
                $resumen['indicadoresActivos'],

            'indicadoresInactivos' =>
                $resumen['indicadoresInactivos'],
        ]);
    }

    /**
     * Mostrar el formulario de creación.
     */
    public function create(): View
    {
        $this->autorizar(
            'indicadores',
            'crear'
        );

        return view(
            'indicadores.create',
            $this->indicadorService
                ->obtenerDatosCreacion(
                    auth()->user(),
                    session('meta_id')
                )
        );
    }

    /**
     * Registrar un indicador institucional.
     */
    public function store(
        StoreIndicadorRequest $request
    ): RedirectResponse {
        $this->autorizar(
            'indicadores',
            'crear'
        );

        $indicador = $this->indicadorService
            ->crear(
                $request->validated(),
                auth()->user()
            );

        session([
            'meta_id' =>
                $indicador->meta_id,

            'indicador_id' =>
                $indicador->id,
        ]);

        return redirect()
            ->route('indicadores.create')
            ->with(
                'indicador_registrado',
                true
            );
    }

    /**
     * Mostrar el detalle del indicador.
     */
    public function detalle(
        int $id
    ): View {
        $this->autorizar('indicadores');

        $indicador = $this->indicadorService
            ->obtenerAccesible(
                $id,
                auth()->user()
            );

        return view(
            'indicadores.detalle',
            compact('indicador')
        );
    }

    /**
     * Mostrar el formulario de edición.
     */
    public function edit(
        int $id
    ): View {
        $this->autorizar(
            'indicadores',
            'editar'
        );

        return view(
            'indicadores.edit',
            $this->indicadorService
                ->obtenerDatosEdicion(
                    $id,
                    auth()->user()
                )
        );
    }

    /**
     * Actualizar un indicador institucional.
     */
    public function update(
        UpdateIndicadorRequest $request,
        int $id
    ): RedirectResponse {
        $this->autorizar(
            'indicadores',
            'editar'
        );

        $indicador = $this->indicadorService
            ->actualizar(
                $id,
                $request->validated(),
                auth()->user()
            );

        return redirect()
            ->route(
                'indicadores.detalle',
                $indicador->id
            )
            ->with(
                'success',
                'Indicador actualizado correctamente.'
            );
    }

    /**
     * Mostrar el formulario para cambiar el estado.
     */
    public function editarEstado(
        int $id
    ): View {
        $this->autorizar(
            'indicadores',
            'estado'
        );

        $indicador = $this->indicadorService
            ->obtenerAccesible(
                $id,
                auth()->user()
            );

        return view(
            'indicadores.editarestado',
            compact('indicador')
        );
    }

    /**
     * Actualizar el estado administrativo.
     */
    public function actualizarEstado(
        UpdateIndicadorStatusRequest $request,
        int $id
    ): RedirectResponse {
        $this->autorizar(
            'indicadores',
            'estado'
        );

        $indicador = $this->indicadorService
            ->cambiarEstado(
                $id,
                $request->boolean('estado'),
                auth()->user()
            );

        return redirect()
            ->route(
                'indicadores.detalle',
                $indicador->id
            )
            ->with(
                'success',
                'Estado del indicador actualizado correctamente.'
            );
    }
}