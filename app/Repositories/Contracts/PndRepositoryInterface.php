<?php
namespace App\Repositories\Contracts;
use App\Models\{Pnd,PndEje,PndPolitica,PndObjetivo,PndEstrategia,PndMeta};
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
interface PndRepositoryInterface
{
    public function listarPlanes(bool $soloActivos = true, int $porPagina = 10, string $buscar = '', string $estado = ''): LengthAwarePaginator;
    public function listarEjes(int $id, int $porPagina, string $buscar, string $estado): LengthAwarePaginator;
    public function listarObjetivos(int $id, int $porPagina, string $buscar, string $estado): LengthAwarePaginator;
    public function obtenerPlan(int $id): Pnd;
    public function crearPlan(array $datos): Pnd;
    public function actualizarPlan(Pnd $pnd,array $datos): Pnd;
    public function crearPolitica(array $datos): PndPolitica;
    public function actualizarPolitica(PndPolitica $registro,array $datos): PndPolitica;
    public function crearEstrategia(array $datos): PndEstrategia;
    public function actualizarEstrategia(PndEstrategia $registro,array $datos): PndEstrategia;
    public function crearMeta(array $datos): PndMeta;
    public function actualizarMeta(PndMeta $registro,array $datos): PndMeta;
    public function obtenerPlanConEjes(int $id): Pnd;
    public function obtenerConEstructura(?int $id=null,bool $soloActivos=true): ?Pnd;
    public function obtenerResumen(?int $id=null,bool $soloActivos=true): array;
    public function obtenerEjeConObjetivos(int $id): PndEje;
    public function crearEje(array $datos): PndEje;
    public function actualizarEje(PndEje $eje,array $datos): PndEje;
    public function obtenerObjetivoConDetalle(int $id): ?PndObjetivo;
    public function crearObjetivo(array $datos): PndObjetivo;
    public function actualizarObjetivo(PndObjetivo $objetivo,array $datos): PndObjetivo;
}
