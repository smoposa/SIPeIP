<?php

namespace App\Http\Controllers;

use App\Enums\EstadoProcesoProyecto;
use App\Enums\EstadoProyecto;
use App\Http\Requests\Proyectos\StoreProyectoRequest;
use App\Http\Requests\Proyectos\UpdateProyectoProcessStatusRequest;
use App\Http\Requests\Proyectos\UpdateProyectoRequest;
use App\Http\Requests\Proyectos\UpdateProyectoStatusRequest;
use App\Models\User;
use App\Services\ProyectoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProyectoController extends Controller
{
    public function __construct(
        private readonly ProyectoService $service
    ) {
    }

    /**
     * Listar los proyectos de la entidad.
     */
    public function index(): View
    {
        $this->autorizar('proyectos');

        $usuario = $this->usuarioAutenticado();

        return view(
            'proyectos.listar',
            [
                'proyectos' => $this->service
                    ->listar($usuario),

                ...$this->service
                    ->obtenerResumen($usuario),
            ]
        );
    }

    /**
     * Mostrar el formulario de creación.
     */
    public function create(): View
    {
        $this->autorizar(
            'proyectos',
            'crear'
        );

        return view(
            'proyectos.create',
            $this->service->obtenerDatosFormulario(
                $this->usuarioAutenticado()
            )
        );
    }

    /**
     * Registrar un proyecto.
     */
    public function store(
        StoreProyectoRequest $request
    ): RedirectResponse {
        $this->autorizar(
            'proyectos',
            'crear'
        );

        $proyecto = $this->service->crear(
            $this->usuarioAutenticado(),
            $request->validated()
        );

        return redirect()
            ->route(
                'proyectos.detalle',
                $proyecto->id
            )
            ->with(
                'success',
                'Proyecto registrado correctamente.'
            );
    }

    /**
     * Mostrar el detalle de un proyecto.
     */
    public function detalle(
        int $proyecto
    ): View {
        $this->autorizar('proyectos');

        return view(
            'proyectos.detalle',
            [
                'proyecto' => $this->service
                    ->obtenerPorId(
                        $this->usuarioAutenticado(),
                        $proyecto
                    ),

                'estadosProceso' =>
                    EstadoProcesoProyecto::cases(),
            ]
        );
    }

    /**
     * Mostrar el formulario de edición.
     */
    public function edit(
        int $proyecto
    ): View {
        $this->autorizar(
            'proyectos',
            'editar'
        );

        $usuario = $this->usuarioAutenticado();

        $registro = $this->service
            ->obtenerPorId(
                $usuario,
                $proyecto
            );

        return view(
            'proyectos.edit',
            [
                ...$this->service
                    ->obtenerDatosFormulario(
                        $usuario,
                        $registro
                    ),

                'estadosEjecucion' =>
                    EstadoProyecto::cases(),
            ]
        );
    }

    /**
     * Actualizar la información de un proyecto.
     */
    public function update(
        UpdateProyectoRequest $request,
        int $proyecto
    ): RedirectResponse {
        $this->autorizar(
            'proyectos',
            'editar'
        );

        $this->service->actualizar(
            $this->usuarioAutenticado(),
            $proyecto,
            $request->validated()
        );

        return redirect()
            ->route(
                'proyectos.detalle',
                $proyecto
            )
            ->with(
                'success',
                'Proyecto actualizado correctamente.'
            );
    }

    /**
     * Activar o inactivar administrativamente un proyecto.
     */
    public function actualizarEstado(
        UpdateProyectoStatusRequest $request,
        int $proyecto
    ): RedirectResponse {
        $this->autorizar(
            'proyectos',
            'estado'
        );

        $this->service
            ->actualizarEstadoAdministrativo(
                $this->usuarioAutenticado(),
                $proyecto,
                $request->boolean('estado')
            );

        return redirect()
            ->route(
                'proyectos.detalle',
                $proyecto
            )
            ->with(
                'success',
                'Estado administrativo actualizado correctamente.'
            );
    }

    /**
     * Actualizar el estado del proceso de priorización.
     */
    public function actualizarEstadoProceso(
        UpdateProyectoProcessStatusRequest $request,
        int $proyecto
    ): RedirectResponse {
        $this->autorizar(
            'proyectos',
            'proceso'
        );

        $this->service
            ->actualizarEstadoProceso(
                $this->usuarioAutenticado(),
                $proyecto,
                $request->validated()[
                    'estado_proceso'
                ]
            );

        return redirect()
            ->route(
                'proyectos.detalle',
                $proyecto
            )
            ->with(
                'success',
                'Estado del proceso actualizado correctamente.'
            );
    }

    /**
     * Obtener el usuario autenticado.
     */
    private function usuarioAutenticado(): User
    {
        $usuario = Auth::user();

        abort_unless(
            $usuario instanceof User,
            401
        );

        return $usuario;
    }
}