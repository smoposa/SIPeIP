<?php

namespace App\Http\Controllers;

use App\Enums\EstadoSeguimiento;
use App\Enums\PeriodoSeguimiento;
use App\Http\Requests\Seguimiento\PresupuestoRequest;
use App\Models\User;
use App\Services\PresupuestoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PresupuestoController extends Controller
{
    public function __construct(
        private readonly PresupuestoService $service
    ) {
    }

    // Mostrar el listado de presupuestos.
    public function index(): View
    {
        $this->autorizar('presupuestos');

        return view('presupuestos.listar', [
            'presupuestos' => $this->service->listar(
                $this->usuario()
            ),
        ]);
    }

    // Mostrar el formulario de registro.
    public function create(): View
    {
        $this->autorizar('presupuestos', 'crear');

        return view('presupuestos.create', [
            ...$this->service->datosFormulario(
                $this->usuario()
            ),
            'periodos' => PeriodoSeguimiento::cases(),
            'estados' => EstadoSeguimiento::cases(),
        ]);
    }

    // Registrar el seguimiento presupuestario.
    public function store(
        PresupuestoRequest $request
    ): RedirectResponse {
        $this->autorizar('presupuestos', 'crear');

        $registro = $this->service->crear(
            $this->usuario(),
            $request->validated()
        );

        return redirect()
            ->route('presupuestos.detalle', $registro)
            ->with(
                'success',
                'Seguimiento presupuestario registrado correctamente.'
            );
    }

    // Mostrar el detalle de un presupuesto de la entidad del usuario.
    public function detalle(int $presupuesto): View
    {
        $this->autorizar('presupuestos');

        return view('presupuestos.detalle', [
            'presupuesto' => $this->service->obtener(
                $this->usuario(),
                $presupuesto
            ),
        ]);
    }

    // Mostrar la edición únicamente para presupuestos no cerrados.
    public function edit(int $presupuesto): View
    {
        $this->autorizar('presupuestos', 'editar');

        $registro = $this->service->obtener(
            $this->usuario(),
            $presupuesto
        );

        abort_if(
            $registro->estado === EstadoSeguimiento::CERRADO->value,
            403,
            'El presupuesto está cerrado.'
        );

        return view('presupuestos.edit', [
            ...$this->service->datosFormulario(
                $this->usuario(),
                $registro
            ),
            'periodos' => PeriodoSeguimiento::cases(),
            'estados' => EstadoSeguimiento::cases(),
        ]);
    }

    // Actualizar un presupuesto respetando las validaciones del servicio.
    public function update(
        PresupuestoRequest $request,
        int $presupuesto
    ): RedirectResponse {
        $this->autorizar('presupuestos', 'editar');

        $this->service->actualizar(
            $this->usuario(),
            $presupuesto,
            $request->validated()
        );

        return redirect()
            ->route('presupuestos.detalle', $presupuesto)
            ->with(
                'success',
                'Seguimiento presupuestario actualizado correctamente.'
            );
    }

    // Reabrir un presupuesto cerrado con el permiso correspondiente.
    public function reabrir(int $presupuesto): RedirectResponse
    {
        $this->autorizar('presupuestos', 'reabrir');

        $this->service->reabrir(
            $this->usuario(),
            $presupuesto
        );

        return redirect()
            ->route('presupuestos.detalle', $presupuesto)
            ->with(
                'success',
                'Presupuesto reabierto correctamente. Ahora está en Borrador.'
            );
    }

    // Obtener el usuario autenticado.
    private function usuario(): User
    {
        $usuario = Auth::user();

        abort_unless($usuario instanceof User, 401);

        return $usuario;
    }
}