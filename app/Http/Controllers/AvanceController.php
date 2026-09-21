<?php

namespace App\Http\Controllers;

use App\Enums\EstadoSeguimiento;
use App\Enums\PeriodoSeguimiento;
use App\Http\Requests\Seguimiento\AvanceRequest;
use App\Models\User;
use App\Services\AvanceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AvanceController extends Controller
{
    public function __construct(private readonly AvanceService $service) {}

    public function index(): View
    {
        $this->autorizar('avances');
        return view('avances.listar', ['avances' => $this->service->listar($this->usuario())]);
    }

    public function create(): View
    {
        $this->autorizar('avances', 'crear');
        return view('avances.create', [
            ...$this->service->datosFormulario($this->usuario()),
            'periodos' => PeriodoSeguimiento::cases(),
            'estados' => EstadoSeguimiento::cases(),
        ]);
    }

    public function store(AvanceRequest $request): RedirectResponse
    {
        $this->autorizar('avances', 'crear');
        $avance = $this->service->crear($this->usuario(), $request->validated());
        return redirect()->route('avances.detalle', $avance)->with('success', 'Avance registrado correctamente.');
    }

    public function detalle(int $avance): View
    {
        $this->autorizar('avances');
        return view('avances.detalle', ['avance' => $this->service->obtener($this->usuario(), $avance)]);
    }

    public function edit(int $avance): View
    {
        $this->autorizar('avances', 'editar');
        $registro = $this->service->obtener($this->usuario(), $avance);
        abort_if($registro->estado === EstadoSeguimiento::CERRADO->value, 403, 'El avance está cerrado.');
        return view('avances.edit', [
            ...$this->service->datosFormulario($this->usuario(), $registro),
            'periodos' => PeriodoSeguimiento::cases(),
            'estados' => EstadoSeguimiento::cases(),
        ]);
    }

    public function update(AvanceRequest $request, int $avance): RedirectResponse
    {
        $this->autorizar('avances', 'editar');
        $this->service->actualizar($this->usuario(), $avance, $request->validated());
        return redirect()->route('avances.detalle', $avance)->with('success', 'Avance actualizado correctamente.');
    }

    public function indicadores(int $proyecto): JsonResponse
    {
        $this->autorizar('avances');
        return response()->json($this->service->indicadores($this->usuario(), $proyecto)->map(fn ($i) => [
            'id' => $i->id, 'codigo' => $i->codigo, 'nombre' => $i->nombre,
            'unidad_medida' => $i->unidad_medida,
        ])->values());
    }

    private function usuario(): User
    {
        $usuario = Auth::user();
        abort_unless($usuario instanceof User, 401);
        return $usuario;
    }
}
