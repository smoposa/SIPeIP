<?php

namespace App\Repositories\Eloquent;

use App\Models\Ods;
use App\Models\AgendaOds;
use App\Models\OdsMeta;
use App\Repositories\Contracts\OdsRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class OdsRepository implements OdsRepositoryInterface
{
    public function listarAgendas(): LengthAwarePaginator
    {
        return AgendaOds::query()
            ->withCount('ods')
            ->orderByDesc('periodo_inicio')
            ->orderByDesc('id')
            ->paginate(10);
    }

    public function obtenerAgenda(int $id): AgendaOds
    {
        return AgendaOds::query()->findOrFail($id);
    }

    public function crearAgenda(array $datos): AgendaOds
    {
        return AgendaOds::query()->create($datos);
    }

    public function actualizarAgenda(
        AgendaOds $agenda,
        array $datos
    ): AgendaOds {
        $agenda->update($datos);

        return $agenda;
    }

    public function actualizarEstadoAgenda(
        AgendaOds $agenda,
        string $estado
    ): AgendaOds {
        $agenda->update([
            'estado' => $estado,
        ]);

        return $agenda;
    }

    public function obtenerTodosOrdenados(?int $agendaId = null): Collection
    {
        return Ods::query()
            ->withCount('metas')
            ->when(
                $agendaId,
                fn ($query) => $query->where('agenda_id', $agendaId)
            )
            ->orderBy('codigo')
            ->get();
    }

    public function obtenerConMetas(Ods $ods): Ods
    {
        $ods->load([
            'agenda',
            'metas' => function ($query) {
                $query->orderBy('codigo');
            },
        ]);

        return $ods;
    }

    /**
     * Bloquear la agenda durante la generación del código y el registro.
     */
    public function obtenerAgendaParaActualizar(int $id): AgendaOds
    {
        return AgendaOds::query()
            ->lockForUpdate()
            ->findOrFail($id);
    }

    /**
     * Registrar un objetivo.
     */
    public function crearObjetivo(array $datos): Ods
    {
        return Ods::query()->create($datos);
    }

    /**
     * Actualizar los datos del objetivo.
     */
    public function actualizarObjetivo(
        Ods $ods,
        array $datos
    ): Ods {
        $ods->update($datos);

        return $ods;
    }

    public function actualizarEstadoObjetivo(
        Ods $ods,
        string $estado
    ): Ods {
        $ods->update([
            'estado' => $estado,
        ]);

        return $ods;
    }

    public function crearMeta(array $datos): OdsMeta
    {
        return OdsMeta::query()->create($datos);
    }

    public function actualizarMeta(
        OdsMeta $meta,
        array $datos
    ): OdsMeta {
        $meta->update($datos);

        return $meta;
    }
}