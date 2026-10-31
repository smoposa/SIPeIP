<?php

namespace App\Services;

use App\Models\AgendaOds;
use App\Models\Ods;
use App\Models\OdsMeta;
use App\Repositories\Contracts\OdsRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class OdsService
{
    public function __construct(
        private readonly OdsRepositoryInterface $odsRepository
    ) {
    }

    /**
     * Listar agendas según los permisos de consulta del usuario.
     */
    public function listarAgendas(): LengthAwarePaginator
    {
        return $this->odsRepository->listarAgendas(
            soloActivas: !$this->puedeConsultarHistorial()
        );
    }

    /**
     * Obtener una agenda y validar su visibilidad.
     */
    public function obtenerAgenda(int $id): AgendaOds
    {
        $agenda = $this->odsRepository->obtenerAgenda($id);

        abort_unless(
            $this->puedeConsultarHistorial()
                || $agenda->estado === 'Activo',
            404
        );

        return $agenda;
    }

    /**
     * Registrar una agenda con estado inicial Activo.
     */
    public function crearAgenda(array $datos): AgendaOds
    {
        return $this->odsRepository->crearAgenda([
            'nombre' => $datos['nombre'],
            'periodo_inicio' => $datos['periodo_inicio'],
            'periodo_fin' => $datos['periodo_fin'],
            'descripcion' => $datos['descripcion'] ?? null,
            'estado' => 'Activo',
        ]);
    }

    /**
     * Actualizar los campos validados y autorizados de la agenda.
     */
    public function actualizarAgenda(int $id, array $datos): AgendaOds
    {
        $agenda = $this->obtenerAgenda($id);

        $campos = array_intersect_key($datos, array_flip([
            'nombre',
            'periodo_inicio',
            'periodo_fin',
            'descripcion',
            'estado',
        ]));

        if (
            array_key_exists('estado', $campos)
            && !in_array($campos['estado'], ['Activo', 'Inactivo'], true)
        ) {
            throw ValidationException::withMessages([
                'estado' => 'El estado seleccionado no es válido.',
            ]);
        }

        return $this->odsRepository->actualizarAgenda(
            $agenda,
            $campos
        );
    }

    /**
     * Actualizar únicamente el estado de la agenda.
     */
    public function actualizarEstadoAgenda(int $id, string $estado): AgendaOds
    {
        if (!in_array($estado, ['Activo', 'Inactivo'], true)) {
            throw ValidationException::withMessages([
                'estado' => 'El estado seleccionado no es válido.',
            ]);
        }

        $agenda = $this->obtenerAgenda($id);

        return $this->odsRepository->actualizarEstadoAgenda(
            $agenda,
            $estado
        );
    }

    /**
     * Obtener la agenda visible y sus objetivos.
     */
    public function datosAgenda(int $id): array
    {
        $agenda = $this->obtenerAgenda($id);

        return [
            'agenda' => $agenda,
            'ods' => $this->odsRepository->obtenerTodosOrdenados($agenda->id),
        ];
    }

    /**
     * Obtener todos los objetivos.
     */
    public function obtenerTodos(): Collection
    {
        return $this->odsRepository->obtenerTodosOrdenados();
    }

    /**
     * Obtener un objetivo con su agenda y metas.
     */
    public function obtenerConMetas(Ods $ods): Ods
    {
        $this->obtenerAgenda((int) $ods->agenda_id);

        return $this->odsRepository->obtenerConMetas($ods);
    }

    /**
     * Actualizar los campos validados y autorizados del objetivo.
     */
    public function actualizarObjetivo(Ods $ods, array $datos): Ods
    {
        $campos = array_intersect_key($datos, array_flip([
            'codigo',
            'nombre',
            'descripcion',
            'estado',
        ]));

        if (
            array_key_exists('estado', $campos)
            && !in_array($campos['estado'], ['Activo', 'Inactivo'], true)
        ) {
            throw ValidationException::withMessages([
                'estado' => 'El estado seleccionado no es válido.',
            ]);
        }

        return $this->odsRepository->actualizarObjetivo(
            $ods,
            $campos
        );
    }

    /**
     * Actualizar estado del objetivo.
     */
    public function actualizarEstadoObjetivo(Ods $ods, string $estado): Ods
    {
        if (!in_array($estado, ['Activo', 'Inactivo'], true)) {
            throw ValidationException::withMessages([
                'estado' => 'El estado seleccionado no es válido.',
            ]);
        }

        return $this->odsRepository->actualizarEstadoObjetivo(
            $ods,
            $estado
        );
    }

    /**
     * Sugerir el siguiente código de objetivo dentro de una agenda.
     */
    public function siguienteCodigoObjetivo(int $agendaId): string
    {
        $objetivos = $this->odsRepository->obtenerTodosOrdenados($agendaId);

        $ultimoNumero = $objetivos->reduce(function (int $mayor, Ods $objetivo): int {

            if (preg_match('/^ODS-(\d+)$/i', $objetivo->codigo, $coincidencias)) {
                return max($mayor, (int) $coincidencias[1]);
            }

            return $mayor;

        }, 0);

        return 'ODS-' . str_pad(
            (string) ($ultimoNumero + 1),
            2,
            '0',
            STR_PAD_LEFT
        );
    }

    /**
     * Registrar un objetivo con código consecutivo y estado inicial Activo.
     */
    public function crearObjetivo(int $agendaId, array $datos): Ods
    {
        return DB::transaction(function () use ($agendaId, $datos) {

            $agenda = $this->odsRepository->obtenerAgendaParaActualizar(
                $agendaId
            );

            $codigo = $this->siguienteCodigoObjetivo($agenda->id);

            return $this->odsRepository->crearObjetivo([
                'agenda_id' => $agenda->id,
                'codigo' => $codigo,
                'nombre' => $datos['nombre'],
                'descripcion' => $datos['descripcion'],
                'estado' => 'Activo',
            ]);

        });
    }

    /**
     * Registrar una meta dentro del objetivo seleccionado.
     */
    public function crearMeta(Ods $ods, array $datos): OdsMeta
    {
        return $this->odsRepository->crearMeta([
            'ods_id' => $ods->id,
            'codigo' => $datos['codigo'],
            'nombre' => $datos['nombre'],
            'descripcion' => $datos['descripcion'] ?? null,
            'estado' => $datos['estado'] ?? 'Activo',
        ]);
    }

    /**
     * Actualizar una meta del objetivo seleccionado.
     */
    public function actualizarMeta(
        Ods $ods,
        OdsMeta $meta,
        array $datos
    ): OdsMeta {
        abort_unless((int) $meta->ods_id === (int) $ods->id, 404);

        $campos = array_intersect_key($datos, array_flip([
            'codigo',
            'nombre',
            'descripcion',
            'estado',
        ]));

        return $this->odsRepository->actualizarMeta(
            $meta,
            $campos
        );
    }

    /**
     * Determinar si el usuario puede consultar agendas inactivas.
     */
    private function puedeConsultarHistorial(): bool
    {
        return in_array(
            auth()->user()?->rol?->codigo,
            ['ADMIN_GLOBAL', 'ADMIN_SISTEMA'],
            true
        );
    }
}