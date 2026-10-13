<?php

namespace App\Http\Controllers;

use App\Http\Requests\Catalogos\GuardarCatalogoRequest;
use App\Http\Requests\Catalogos\EstadoCatalogoRequest;
use Illuminate\Http\Request;
use App\Services\CatalogoDefinition;
use App\Services\CatalogoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GestionCatalogoController extends Controller
{
    public function __construct(private readonly CatalogoService $service)
    {
    }

    private function permiso(string $recurso, string $accion = 'ver'): void
    {
        $this->autorizar(CatalogoDefinition::obtener($recurso)['modulo'], $accion);
    }

    public function index(string $recurso): View
    {
        $this->permiso($recurso);

        return view('catalogos.gestion.index', $this->service->listar($recurso));
    }

    public function create(Request $request, string $recurso): View
    {
        $this->permiso($recurso, 'crear');

        $datos = $request->validate(['padre' => ['nullable', 'integer', 'min:1']]);

        $padreId = isset($datos['padre']) ? (int) $datos['padre'] : null;

        return view('catalogos.gestion.form', $this->service->datos($recurso, null, $padreId));
    }

    public function store(GuardarCatalogoRequest $request, string $recurso): RedirectResponse
    {
        $registro = $this->service->guardar($recurso, $request->validated());

        return redirect()->to($this->service->rutaRetorno($recurso, $registro))->with('success', 'Registro creado correctamente.');
    }

    public function show(string $recurso, int $id): View
    {
        $this->permiso($recurso);

        return view('catalogos.gestion.detalle', $this->service->datos($recurso, $id));
    }

    public function edit(string $recurso, int $id): View
    {
        $this->permiso($recurso, 'editar');

        return view('catalogos.gestion.form', $this->service->datos($recurso, $id));
    }

    public function update(GuardarCatalogoRequest $request, string $recurso, int $id): RedirectResponse
    {
        $registro = $this->service->guardar($recurso, $request->validated(), $id);

        return redirect()->to($this->service->rutaRetorno($recurso, $registro))->with('success', 'Registro actualizado correctamente.');
    }

    public function estado(EstadoCatalogoRequest $request, string $recurso, int $id): RedirectResponse
    {
        $datos = $this->service->datos($recurso, $id);
        $this->service->cambiarEstado($recurso, $id, $request->validated('estado'));

        return redirect()->to($datos['retorno'])->with('success', 'Estado actualizado. La información se conserva en el historial.');
    }
}
