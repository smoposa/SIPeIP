<?php
namespace App\Repositories\Eloquent;
use App\Models\{Ods, AgendaOds, OdsMeta};
use App\Repositories\Contracts\OdsRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
class OdsRepository implements OdsRepositoryInterface
{
    public function listarAgendas(bool $soloActivas = true, int $porPagina = 10, string $buscar = '', string $estado = ''): LengthAwarePaginator
    {
        return AgendaOds::query()->when($soloActivas, fn ($q) => $q->where('estado', 'Activo'))
            ->when($buscar !== '', fn ($q) => $q->where(fn ($q) => $q->where('nombre', 'like', "%{$buscar}%")->orWhere('periodo_inicio', 'like', "%{$buscar}%")->orWhere('periodo_fin', 'like', "%{$buscar}%")))
            ->when($estado !== '', fn ($q) => $q->where('estado', $estado))
            ->withCount('ods')->orderByDesc('periodo_inicio')->orderByDesc('id')->paginate($porPagina)->withQueryString();
    }
    public function listarObjetivos(int $agendaId, int $porPagina = 7, string $buscar = '', string $estado = ''): LengthAwarePaginator
    {
        return Ods::query()->where('agenda_id', $agendaId)->withCount('metas')
            ->when($buscar !== '', fn ($q) => $q->where(fn ($q) => $q->where('codigo', 'like', "%{$buscar}%")->orWhere('nombre', 'like', "%{$buscar}%")))
            ->when($estado !== '', fn ($q) => $q->where('estado', $estado))
            ->orderBy('codigo')->orderBy('id')->paginate($porPagina)->withQueryString();
    }
    public function obtenerAgenda(int $id): AgendaOds { return AgendaOds::query()->findOrFail($id); }
    public function crearAgenda(array $datos): AgendaOds { return AgendaOds::query()->create($datos); }
    public function actualizarAgenda(AgendaOds $agenda, array $datos): AgendaOds { $agenda->update($datos); return $agenda; }
    public function actualizarEstadoAgenda(AgendaOds $agenda, string $estado): AgendaOds { return $this->actualizarAgenda($agenda, ['estado'=>$estado]); }
    public function obtenerTodosOrdenados(?int $agendaId = null): Collection { return Ods::query()->withCount('metas')->when($agendaId, fn ($q) => $q->where('agenda_id',$agendaId))->orderBy('codigo')->get(); }
    public function obtenerConMetas(Ods $ods): Ods { return $ods->load(['agenda','metas'=>fn ($q)=>$q->orderBy('codigo')]); }
    public function obtenerAgendaParaActualizar(int $id): AgendaOds { return AgendaOds::query()->lockForUpdate()->findOrFail($id); }
    public function crearObjetivo(array $datos): Ods { return Ods::query()->create($datos); }
    public function actualizarObjetivo(Ods $ods, array $datos): Ods { $ods->update($datos); return $ods; }
    public function actualizarEstadoObjetivo(Ods $ods, string $estado): Ods { return $this->actualizarObjetivo($ods,['estado'=>$estado]); }
    public function crearMeta(array $datos): OdsMeta { return OdsMeta::query()->create($datos); }
    public function actualizarMeta(OdsMeta $meta, array $datos): OdsMeta { $meta->update($datos); return $meta; }
}
