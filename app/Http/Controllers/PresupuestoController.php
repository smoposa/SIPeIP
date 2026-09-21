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
    public function __construct(private readonly PresupuestoService $service) {}

    public function index(): View
    {
        $this->autorizar('presupuestos');
        return view('presupuestos.listar', ['presupuestos' => $this->service->listar($this->usuario())]);
    }

    public function create(): View
    {
        $this->autorizar('presupuestos', 'crear');
        return view('presupuestos.create', [...$this->service->datosFormulario($this->usuario()), 'periodos' => PeriodoSeguimiento::cases(), 'estados' => EstadoSeguimiento::cases()]);
    }

    public function store(PresupuestoRequest $request): RedirectResponse
    {
        $this->autorizar('presupuestos', 'crear');
        $registro = $this->service->crear($this->usuario(), $request->validated());
        return redirect()->route('presupuestos.detalle', $registro)->with('success', 'Seguimiento presupuestario registrado correctamente.');
    }

    public function detalle(int $presupuesto): View
    {
        $this->autorizar('presupuestos');
        return view('presupuestos.detalle', ['presupuesto' => $this->service->obtener($this->usuario(), $presupuesto)]);
    }

    public function edit(int $presupuesto): View
    {
        $this->autorizar('presupuestos', 'editar');
        $registro = $this->service->obtener($this->usuario(), $presupuesto);
        abort_if($registro->estado === EstadoSeguimiento::CERRADO->value, 403, 'El presupuesto está cerrado.');
        return view('presupuestos.edit', [...$this->service->datosFormulario($this->usuario(), $registro), 'periodos' => PeriodoSeguimiento::cases(), 'estados' => EstadoSeguimiento::cases()]);
    }

    public function update(PresupuestoRequest $request, int $presupuesto): RedirectResponse
    {
        $this->autorizar('presupuestos', 'editar');
        $this->service->actualizar($this->usuario(), $presupuesto, $request->validated());
        return redirect()->route('presupuestos.detalle', $presupuesto)->with('success', 'Seguimiento presupuestario actualizado correctamente.');
    }

    private function usuario(): User
    {
        $usuario = Auth::user();
        abort_unless($usuario instanceof User, 401);
        return $usuario;
    }
}
