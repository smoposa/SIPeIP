<?php
namespace App\Repositories\Eloquent;
use App\Models\{Pnd,PndEje,PndObjetivo,PndEstrategia,PndMeta,PndPolitica};
use App\Repositories\Contracts\PndRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
class PndRepository implements PndRepositoryInterface
{
    private function filtrar($query,string $buscar,string $estado,array $columnas)
    {
        return $query->when($estado !== '',fn($q)=>$q->where('estado',$estado))
            ->when($buscar !== '',fn($q)=>$q->where(function($q) use($buscar,$columnas){
                foreach($columnas as $columna) $q->orWhere($columna,'like',"%{$buscar}%");
            }));
    }
    public function listarPlanes(bool $soloActivos=true,int $porPagina=10,string $buscar='',string $estado=''): LengthAwarePaginator
    {
        return $this->filtrar(Pnd::query()->when($soloActivos,fn($q)=>$q->where('estado','Activo')),$buscar,$estado,['nombre','periodo_inicio','periodo_fin'])
            ->withCount('ejes')->with(['ejes'=>fn($q)=>$q->select('id','pnd_id')->withCount('objetivos')])->orderByDesc('periodo_inicio')->orderByDesc('id')->paginate($porPagina)->withQueryString();
    }
    private function consultaEjes($q) { return $q->withCount('objetivos')->with(['objetivos'=>fn($q)=>$q->select('id','pnd_eje_id')->withCount(['politicas','metas'])])->orderBy('numero')->orderBy('id'); }
    private function consultaObjetivos($q) { return $q->withCount(['politicas','metas'])->with(['politicas'=>fn($q)=>$q->select('id','pnd_objetivo_id')->withCount('estrategias')])->orderBy('numero')->orderBy('id'); }
    public function listarEjes(int $id,int $porPagina,string $buscar,string $estado): LengthAwarePaginator { return $this->consultaEjes($this->filtrar(PndEje::query()->where('pnd_id',$id),$buscar,$estado,['numero','nombre']))->paginate($porPagina)->withQueryString(); }
    public function listarObjetivos(int $id,int $porPagina,string $buscar,string $estado): LengthAwarePaginator { return $this->consultaObjetivos($this->filtrar(PndObjetivo::query()->where('pnd_eje_id',$id),$buscar,$estado,['numero','nombre']))->paginate($porPagina)->withQueryString(); }
    public function obtenerPlan(int $id): Pnd { return Pnd::query()->findOrFail($id); }
    public function obtenerPlanConEjes(int $id): Pnd { return Pnd::query()->with(['ejes'=>fn($q)=>$this->consultaEjes($q)])->findOrFail($id); }
    public function obtenerEjeConObjetivos(int $id): PndEje { return PndEje::query()->with(['pnd','objetivos'=>fn($q)=>$this->consultaObjetivos($q)])->findOrFail($id); }
    public function obtenerConEstructura(?int $id=null,bool $soloActivos=true): ?Pnd { return Pnd::query()->when($soloActivos,fn($q)=>$q->where('estado','Activo'))->with(['ejes'=>fn($q)=>$q->orderBy('numero'),'ejes.objetivos'=>fn($q)=>$q->orderBy('numero'),'ejes.objetivos.politicas'=>fn($q)=>$q->orderBy('codigo'),'ejes.objetivos.politicas.estrategias'=>fn($q)=>$q->orderBy('codigo'),'ejes.objetivos.metas'=>fn($q)=>$q->orderBy('numero')])->when($id!==null,fn($q)=>$q->whereKey($id))->orderByDesc('periodo_inicio')->orderByDesc('id')->first(); }
    public function obtenerResumen(?int $id=null,bool $soloActivos=true): array { $pnd=$this->obtenerConEstructura($id,$soloActivos); $ejes=$pnd?->ejes??collect(); $objetivos=$ejes->flatMap(fn($e)=>$e->objetivos); $politicas=$objetivos->flatMap(fn($o)=>$o->politicas); return ['ejes'=>$ejes->count(),'objetivos'=>$objetivos->count(),'politicas'=>$politicas->count(),'estrategias'=>$politicas->sum(fn($p)=>$p->estrategias->count()),'metas'=>$objetivos->sum(fn($o)=>$o->metas->count())]; }
    public function obtenerObjetivoConDetalle(int $id): ?PndObjetivo { return PndObjetivo::query()->with(['eje.pnd','politicas'=>fn($q)=>$q->orderBy('codigo'),'politicas.estrategias'=>fn($q)=>$q->orderBy('codigo'),'metas'=>fn($q)=>$q->orderBy('numero')])->find($id); }
    public function crearPlan(array $datos): Pnd { return Pnd::query()->create($datos); }
    public function actualizarPlan(Pnd $pnd,array $datos): Pnd { $pnd->update($datos); return $pnd; }
    public function crearEje(array $datos): PndEje { return PndEje::query()->create($datos); }
    public function actualizarEje(PndEje $eje,array $datos): PndEje { $eje->update($datos); return $eje; }
    public function crearObjetivo(array $datos): PndObjetivo { return PndObjetivo::query()->create($datos); }
    public function actualizarObjetivo(PndObjetivo $objetivo,array $datos): PndObjetivo { $objetivo->update($datos); return $objetivo; }
    public function crearPolitica(array $datos): PndPolitica { return PndPolitica::query()->create($datos); }
    public function actualizarPolitica(PndPolitica $registro,array $datos): PndPolitica { $registro->update($datos); return $registro; }
    public function crearEstrategia(array $datos): PndEstrategia { return PndEstrategia::query()->create($datos); }
    public function actualizarEstrategia(PndEstrategia $registro,array $datos): PndEstrategia { $registro->update($datos); return $registro; }
    public function crearMeta(array $datos): PndMeta { return PndMeta::query()->create($datos); }
    public function actualizarMeta(PndMeta $registro,array $datos): PndMeta { $registro->update($datos); return $registro; }
}
