<?php

namespace App\Http\Controllers;

use App\Http\Requests\Metas\StoreMetaRequest;
use App\Http\Requests\Metas\UpdateMetaRequest;
use App\Http\Requests\Metas\UpdateMetaStatusRequest;
use App\Services\MetaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MetaController extends Controller
{
    public function __construct(
        private readonly MetaService $metaService
    ) {
    }

    /**
     * Listar las metas de la entidad.
     */
    public function listar(): View
    {
        $this->autorizar('metas');

        $usuario = auth()->user();

        $metas = $this->metaService->listar(
            $usuario
        );

        $resumen = $this->metaService
            ->obtenerResumen(
                $usuario
            );

        return view('metas.listar', [
            'metas' => $metas,
            'totalMetas' => $resumen['totalMetas'],
            'metasActivas' => $resumen['metasActivas'],
            'metasInactivas' => $resumen['metasInactivas'],
        ]);
    }

    /**
     * Mostrar el formulario de creación.
     */
    public function create(
        Request $request
    ): View {
        $this->autorizar('metas');

        $objetivoId = $request->filled('objetivo_id')
            ? $request->integer('objetivo_id')
            : null;

        return view(
            'metas.create',
            $this->metaService
                ->obtenerDatosCreacion(
                    auth()->user(),
                    $objetivoId
                )
        );
    }

    /**
     * Registrar una meta institucional.
     */
    public function store(
        StoreMetaRequest $request
    ): RedirectResponse {
        $this->autorizar('metas');

        $meta = $this->metaService->crear(
            $request->validated(),
            auth()->user()
        );

        session([
            'meta_id' => $meta->id,
        ]);

        return redirect()
            ->route(
                'metas.create',
                [
                    'objetivo_id' => $meta->objetivo_id,
                ]
            )
            ->with(
                'meta_registrada',
                true
            );
    }

    /**
     * Mostrar el detalle de una meta.
     */
    public function detalle(
        int $id
    ): View {
        $this->autorizar('metas');

        $meta = $this->metaService
            ->obtenerAccesible(
                $id,
                auth()->user()
            );

        return view(
            'metas.detalle',
            compact('meta')
        );
    }

    /**
     * Mostrar el formulario de edición.
     */
    public function edit(
        int $id
    ): View {
        $this->autorizar('metas');

        return view(
            'metas.edit',
            $this->metaService
                ->obtenerDatosEdicion(
                    $id,
                    auth()->user()
                )
        );
    }

    /**
     * Actualizar una meta institucional.
     */
    public function update(
        UpdateMetaRequest $request,
        int $id
    ): RedirectResponse {
        $this->autorizar('metas');

        $meta = $this->metaService
            ->actualizar(
                $id,
                $request->validated(),
                auth()->user()
            );

        return redirect()
            ->route(
                'metas.detalle',
                $meta->id
            )
            ->with(
                'success',
                'Meta actualizada correctamente.'
            );
    }

    /**
     * Mostrar el formulario para cambiar el estado.
     */
    public function editarEstado(
        int $id
    ): View {
        $this->autorizar('metas');

        $meta = $this->metaService
            ->obtenerAccesible(
                $id,
                auth()->user()
            );

        return view(
            'metas.editarestado',
            compact('meta')
        );
    }

    /**
     * Actualizar el estado administrativo.
     */
    public function actualizarEstado(
        UpdateMetaStatusRequest $request,
        int $id
    ): RedirectResponse {
        $this->autorizar('metas');

        $meta = $this->metaService
            ->cambiarEstado(
                $id,
                $request->boolean('estado'),
                auth()->user()
            );

        return redirect()
            ->route(
                'metas.detalle',
                $meta->id
            )
            ->with(
                'success',
                'Estado de la meta actualizado correctamente.'
            );
    }
}