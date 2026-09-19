<?php

namespace App\Http\Controllers;

use App\Http\Requests\Programas\StoreProgramaRequest;
use App\Http\Requests\Programas\UpdateProgramaProcessStatusRequest;
use App\Http\Requests\Programas\UpdateProgramaRequest;
use App\Http\Requests\Programas\UpdateProgramaStatusRequest;
use App\Models\User;
use App\Services\ProgramaService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProgramaController extends Controller
{
    public function __construct(
        private readonly ProgramaService $service
    ) {
    }

    /**
     * Mostrar los programas de la entidad.
     */
    public function index(): View
    {
        $this->autorizar('programas');

        $usuario = $this->usuarioAutenticado();

        return view(
            'programas.listar',
            array_merge(
                [
                    'programas' => $this->service->listar(
                        $usuario
                    ),
                ],
                $this->service->obtenerResumen(
                    $usuario
                )
            )
        );
    }

    /**
     * Mostrar el formulario de creación.
     */
    public function create(): View
    {
        $this->autorizar(
            'programas',
            'crear'
        );

        return view(
            'programas.create',
            $this->service->obtenerDatosFormulario(
                $this->usuarioAutenticado()
            )
        );
    }

    /**
     * Registrar un programa.
     */
    public function store(
        StoreProgramaRequest $request
    ): RedirectResponse {
        $this->autorizar(
            'programas',
            'crear'
        );

        $programa = $this->service->crear(
            $this->usuarioAutenticado(),
            $request->validated()
        );

        return redirect()
            ->route(
                'programas.detalle',
                $programa->id
            )
            ->with(
                'success',
                'Programa registrado correctamente.'
            );
    }

    /**
     * Mostrar el detalle de un programa.
     */
    public function detalle(
        int $programa
    ): View {
        $this->autorizar('programas');

        return view(
            'programas.detalle',
            [
                'programa' => $this->service
                    ->obtenerPorId(
                        $this->usuarioAutenticado(),
                        $programa
                    ),
            ]
        );
    }

    /**
     * Mostrar el formulario de edición.
     */
    public function edit(
        int $programa
    ): View {
        $this->autorizar(
            'programas',
            'editar'
        );

        return view(
            'programas.edit',
            $this->service->obtenerDatosEdicion(
                $this->usuarioAutenticado(),
                $programa
            )
        );
    }

    /**
     * Actualizar un programa.
     */
    public function update(
        UpdateProgramaRequest $request,
        int $programa
    ): RedirectResponse {
        $this->autorizar(
            'programas',
            'editar'
        );

        $this->service->actualizar(
            $this->usuarioAutenticado(),
            $programa,
            $request->validated()
        );

        return redirect()
            ->route(
                'programas.detalle',
                $programa
            )
            ->with(
                'success',
                'Programa actualizado correctamente.'
            );
    }

    /**
     * Actualizar el estado administrativo.
     */
    public function actualizarEstado(
        UpdateProgramaStatusRequest $request,
        int $programa
    ): RedirectResponse {
        $this->autorizar(
            'programas',
            'estado'
        );

        $this->service->actualizarEstado(
            $this->usuarioAutenticado(),
            $programa,
            $request->boolean('estado')
        );

        return redirect()
            ->route('programas.listar')
            ->with(
                'success',
                'Estado del programa actualizado correctamente.'
            );
    }

    /**
     * Actualizar el estado del proceso.
     */
    public function actualizarEstadoProceso(
        UpdateProgramaProcessStatusRequest $request,
        int $programa
    ): RedirectResponse {
        $this->autorizar(
            'programas',
            'proceso'
        );

        $this->service->actualizarEstadoProceso(
            $this->usuarioAutenticado(),
            $programa,
            $request->validated('estado_proceso')
        );

        return redirect()
            ->route(
                'programas.detalle',
                $programa
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

        if (!$usuario instanceof User) {
            throw new AuthenticationException(
                'Debe iniciar sesión para acceder al módulo.'
            );
        }

        return $usuario;
    }
}