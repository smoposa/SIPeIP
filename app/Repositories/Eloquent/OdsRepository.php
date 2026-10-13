<?php

namespace App\Repositories\Eloquent;

use App\Models\Ods;
use App\Models\AgendaOds;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\OdsRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class OdsRepository implements OdsRepositoryInterface
{
    public function listarAgendas(): LengthAwarePaginator
    {
        return AgendaOds::query()->withCount('ods')->orderByDesc('periodo_inicio')->orderByDesc('id')->paginate(10);
    }

    public function obtenerAgenda(int $id): AgendaOds
    {
        return AgendaOds::query()->findOrFail($id);
    }

    /**
     * Obtener todos los ODS ordenados por código.
     */
    public function obtenerTodosOrdenados(?int $agendaId = null): Collection
    {
        return Ods::query()->withCount('metas')->when($agendaId, fn ($query) => $query->where('agenda_id', $agendaId))->orderBy('codigo')->get();
    }

    /**
     * Obtener un ODS con sus metas asociadas.
     */
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
}