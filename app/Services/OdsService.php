<?php
namespace App\Services;
use App\Models\{AgendaOds,Ods,OdsMeta};
use App\Repositories\Contracts\OdsRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
class OdsService
{
    public function __construct(private readonly OdsRepositoryInterface $odsRepository) {}
    private function filtros(): array
    {
        $cantidad = request()->integer('per_page', 7);
        $estado = request()->string('estado')->toString();
        return [in_array($cantidad,[7,10,15],true)?$cantidad:7, trim(request()->string('buscar')->toString()), in_array($estado,['Activo','Inactivo'],true)?$estado:''];
    }
    public function listarAgendas(): LengthAwarePaginator
    {
        return $this->odsRepository->listarAgendas(!$this->puedeConsultarHistorial(), ...$this->filtros());
    }
    public function obtenerAgenda(int $id): AgendaOds
    {
        $agenda = $this->odsRepository->obtenerAgenda($id);
        abort_unless($this->puedeConsultarHistorial() || $agenda->estado === 'Activo',404);
        return $agenda;
    }
    public function crearAgenda(array $datos): AgendaOds
    {
        return $this->odsRepository->crearAgenda(['nombre'=>$datos['nombre'],'periodo_inicio'=>$datos['periodo_inicio'],'periodo_fin'=>$datos['periodo_fin'],'descripcion'=>$datos['descripcion']??null,'estado'=>'Activo']);
    }
    private function validarEstado(array $campos): void
    {
        if (array_key_exists('estado',$campos) && !in_array($campos['estado'],['Activo','Inactivo'],true)) {
            throw ValidationException::withMessages(['estado'=>'El estado seleccionado no es válido.']);
        }
    }
    public function actualizarAgenda(int $id,array $datos): AgendaOds
    {
        $agenda=$this->obtenerAgenda($id);
        $campos=array_intersect_key($datos,array_flip(['nombre','periodo_inicio','periodo_fin','descripcion','estado']));
        $this->validarEstado($campos);
        return $this->odsRepository->actualizarAgenda($agenda,$campos);
    }
    public function actualizarEstadoAgenda(int $id,string $estado): AgendaOds
    {
        $this->validarEstado(['estado'=>$estado]);
        return $this->odsRepository->actualizarEstadoAgenda($this->obtenerAgenda($id),$estado);
    }
    public function datosAgenda(int $id): array
    {
        $agenda=$this->obtenerAgenda($id);
        return ['agenda'=>$agenda,'ods'=>$this->odsRepository->listarObjetivos($agenda->id,...$this->filtros())];
    }
    public function obtenerTodos(): Collection { return $this->odsRepository->obtenerTodosOrdenados(); }
    public function obtenerConMetas(Ods $ods): Ods { $this->obtenerAgenda((int)$ods->agenda_id); return $this->odsRepository->obtenerConMetas($ods); }
    public function actualizarObjetivo(Ods $ods,array $datos): Ods
    {
        $campos=array_intersect_key($datos,array_flip(['codigo','nombre','descripcion','estado']));
        $this->validarEstado($campos);
        return $this->odsRepository->actualizarObjetivo($ods,$campos);
    }
    public function actualizarEstadoObjetivo(Ods $ods,string $estado): Ods { $this->validarEstado(['estado'=>$estado]); return $this->odsRepository->actualizarEstadoObjetivo($ods,$estado); }
    public function siguienteCodigoObjetivo(int $agendaId): string
    {
        $objetivos=$this->odsRepository->obtenerTodosOrdenados($agendaId);
        $ultimoNumero=$objetivos->reduce(function(int $mayor,Ods $objetivo): int {
            return preg_match('/^ODS-(\d+)$/i',$objetivo->codigo,$coincidencias)?max($mayor,(int)$coincidencias[1]):$mayor;
        },0);
        return 'ODS-'.str_pad((string)($ultimoNumero+1),2,'0',STR_PAD_LEFT);
    }
    public function crearObjetivo(int $agendaId,array $datos): Ods
    {
        return DB::transaction(function() use($agendaId,$datos){
            $agenda=$this->odsRepository->obtenerAgendaParaActualizar($agendaId);
            return $this->odsRepository->crearObjetivo(['agenda_id'=>$agenda->id,'codigo'=>$this->siguienteCodigoObjetivo($agenda->id),'nombre'=>$datos['nombre'],'descripcion'=>$datos['descripcion'],'estado'=>'Activo']);
        });
    }
    public function crearMeta(Ods $ods,array $datos): OdsMeta { return $this->odsRepository->crearMeta(['ods_id'=>$ods->id,'codigo'=>$datos['codigo'],'nombre'=>$datos['nombre'],'descripcion'=>$datos['descripcion']??null,'estado'=>$datos['estado']??'Activo']); }
    public function actualizarMeta(Ods $ods,OdsMeta $meta,array $datos): OdsMeta
    {
        abort_unless((int)$meta->ods_id===(int)$ods->id,404);
        return $this->odsRepository->actualizarMeta($meta,array_intersect_key($datos,array_flip(['codigo','nombre','descripcion','estado'])));
    }
    private function puedeConsultarHistorial(): bool { return in_array(auth()->user()?->rol?->codigo,['ADMIN_GLOBAL','ADMIN_SISTEMA'],true); }
}
