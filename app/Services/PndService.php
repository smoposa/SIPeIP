<?php
namespace App\Services;
use App\Models\{Pnd,PndEje,PndObjetivo,PndPolitica,PndEstrategia,PndMeta};
use App\Repositories\Contracts\PndRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;
class PndService
{
    public function __construct(private readonly PndRepositoryInterface $pndRepository) {}
    private function filtros(): array { $n=request()->integer('per_page',7); $estado=request()->string('estado')->toString(); return [in_array($n,[7,10,15],true)?$n:7,trim(request()->string('buscar')->toString()),in_array($estado,['Activo','Inactivo'],true)?$estado:'']; }
    public function listarPlanes(): LengthAwarePaginator { return $this->pndRepository->listarPlanes(!$this->puedeConsultarHistorial(),...$this->filtros()); }
    public function listarEjes(int $id): LengthAwarePaginator { $this->obtenerPlan($id); return $this->pndRepository->listarEjes($id,...$this->filtros()); }
    public function listarObjetivos(int $id): LengthAwarePaginator { $this->obtenerEjeConObjetivos($id); return $this->pndRepository->listarObjetivos($id,...$this->filtros()); }
    public function obtenerPlan(int $id): Pnd { $pnd=$this->pndRepository->obtenerPlan($id); $this->validarVisibilidadPlan($pnd); return $pnd; }
    public function obtenerPlanConEjes(int $id): Pnd { $this->obtenerPlan($id); return $this->pndRepository->obtenerPlanConEjes($id); }
    public function obtenerEjeConObjetivos(int $id): PndEje { $eje=$this->pndRepository->obtenerEjeConObjetivos($id); $this->obtenerPlan((int)$eje->pnd_id); return $eje; }
    public function obtenerEstructura(?int $id=null): ?Pnd { if($id!==null) $this->obtenerPlan($id); return $this->pndRepository->obtenerConEstructura($id,!$this->puedeConsultarHistorial()); }
    public function obtenerResumen(?int $id=null): array { if($id!==null) $this->obtenerPlan($id); return $this->pndRepository->obtenerResumen($id,!$this->puedeConsultarHistorial()); }
    public function obtenerDatosIndex(?int $id=null): array { return ['pnd'=>$this->obtenerEstructura($id),'resumen'=>$this->obtenerResumen($id)]; }
    public function obtenerObjetivoConDetalle(int $id): ?PndObjetivo { $o=$this->pndRepository->obtenerObjetivoConDetalle($id); if($o===null) return null; abort_if($o->eje===null,404); $this->obtenerPlan((int)$o->eje->pnd_id); return $o; }
    private function campos(array $datos,array $permitidos): array { $campos=array_intersect_key($datos,array_flip($permitidos)); if(array_key_exists('estado',$campos)&&!in_array($campos['estado'],['Activo','Inactivo'],true)) throw ValidationException::withMessages(['estado'=>'El estado seleccionado no es válido.']); return $campos; }
    public function crearPlan(array $datos): Pnd { return $this->pndRepository->crearPlan(['nombre'=>$datos['nombre'],'periodo_inicio'=>$datos['periodo_inicio'],'periodo_fin'=>$datos['periodo_fin'],'descripcion'=>$datos['descripcion']??null,'estado'=>'Activo']); }
    public function actualizarPlan(int $id,array $datos): Pnd { return $this->pndRepository->actualizarPlan($this->obtenerPlan($id),$this->campos($datos,['nombre','periodo_inicio','periodo_fin','descripcion','estado'])); }
    public function crearEje(int $pndId,array $datos): PndEje { $pnd=$this->pndRepository->obtenerPlan($pndId); return $this->pndRepository->crearEje(['pnd_id'=>$pnd->id,'numero'=>$datos['numero'],'nombre'=>$datos['nombre'],'descripcion'=>$datos['descripcion']??null,'estado'=>'Activo']); }
    public function actualizarEje(PndEje $eje,array $datos): PndEje { return $this->pndRepository->actualizarEje($eje,$this->campos($datos,['numero','nombre','descripcion','estado'])); }
    public function crearObjetivo(PndEje $eje,array $datos): PndObjetivo { return $this->pndRepository->crearObjetivo(['pnd_eje_id'=>$eje->id,'numero'=>$datos['numero'],'nombre'=>$datos['nombre'],'descripcion'=>$datos['descripcion']??null,'estado'=>'Activo']); }
    public function actualizarObjetivo(PndObjetivo $objetivo,array $datos): PndObjetivo { return $this->pndRepository->actualizarObjetivo($objetivo,$this->campos($datos,['numero','nombre','descripcion','estado'])); }
    public function crearPolitica(PndObjetivo $objetivo,array $datos): PndPolitica { return $this->pndRepository->crearPolitica(['pnd_objetivo_id'=>$objetivo->id,'codigo'=>$datos['codigo'],'nombre'=>$datos['nombre'],'estado'=>'Activo']); }
    public function actualizarPolitica(PndObjetivo $objetivo,PndPolitica $registro,array $datos): PndPolitica { abort_unless((int)$registro->pnd_objetivo_id===(int)$objetivo->id,404); return $this->pndRepository->actualizarPolitica($registro,$this->campos($datos,['codigo','nombre','estado'])); }
    public function crearEstrategia(PndObjetivo $objetivo,PndPolitica $politica,array $datos): PndEstrategia { abort_unless((int)$politica->pnd_objetivo_id===(int)$objetivo->id,404); return $this->pndRepository->crearEstrategia(['pnd_politica_id'=>$politica->id,'codigo'=>$datos['codigo'],'descripcion'=>$datos['descripcion'],'estado'=>'Activo']); }
    public function actualizarEstrategia(PndObjetivo $objetivo,PndPolitica $politica,PndEstrategia $registro,array $datos): PndEstrategia { abort_unless((int)$politica->pnd_objetivo_id===(int)$objetivo->id,404); abort_unless((int)$registro->pnd_politica_id===(int)$politica->id,404); return $this->pndRepository->actualizarEstrategia($registro,$this->campos($datos,['codigo','descripcion','estado'])); }
    public function crearMeta(PndObjetivo $objetivo,array $datos): PndMeta { return $this->pndRepository->crearMeta(['pnd_objetivo_id'=>$objetivo->id,'numero'=>$datos['numero'],'descripcion'=>$datos['descripcion'],'estado'=>'Activo']); }
    public function actualizarMeta(PndObjetivo $objetivo,PndMeta $registro,array $datos): PndMeta { abort_unless((int)$registro->pnd_objetivo_id===(int)$objetivo->id,404); return $this->pndRepository->actualizarMeta($registro,$this->campos($datos,['numero','descripcion','estado'])); }
    private function validarVisibilidadPlan(Pnd $pnd): void { abort_unless($this->puedeConsultarHistorial()||$pnd->estado==='Activo',404); }
    private function puedeConsultarHistorial(): bool { return in_array(auth()->user()?->rol?->codigo,['ADMIN_GLOBAL','ADMIN_SISTEMA'],true); }
}
