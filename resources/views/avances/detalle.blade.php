<x-seguimiento-layout title="Detalle del avance">

    <x-slot name="breadcrumbs">

        <nav aria-label="Migas de pan">

            <ol class="flex flex-wrap items-center gap-2 text-xs">

                <li>
                    <a href="{{ route('avances.listar') }}"
                       class="text-gray-500 hover:text-blue-600">
                        Avances físicos
                    </a>
                </li>

                <li aria-hidden="true" class="text-gray-400">/</li>

                <li aria-current="page" class="font-medium text-gray-700">
                    Detalle del avance
                </li>

            </ol>

        </nav>

    </x-slot>


    <div class="space-y-4">

        @include('avances.partials.avisos')


        <!-- Descripción y acciones -->
        <div class="flex flex-wrap items-center justify-between gap-4">

            <p class="text-sm text-gray-500">
                Consulte los valores programados, ejecutados y el cumplimiento del avance.
            </p>

            <div class="flex items-center gap-2">

                <a href="{{ route('avances.listar') }}"
                   class="rounded-md border border-gray-300 px-4 py-2 text-sm
                          font-medium text-gray-700 transition hover:bg-gray-50">
                    Volver
                </a>

                @if($avance->estado === 'Borrador' && puedeHacer('avances', 'editar'))

                    <a href="{{ route('avances.edit', $avance) }}"
                       class="inline-flex items-center gap-2 rounded-md bg-blue-600
                              px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-700">

                        <i class="bi bi-pencil" aria-hidden="true"></i>
                        Editar avance

                    </a>

                @endif

            </div>

        </div>


        <!-- Proyecto e indicador -->
        <div class="rounded-lg border border-gray-200 bg-white p-5">

            <h3 class="text-sm font-semibold text-gray-800">
                Proyecto e indicador
            </h3>

            <dl class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2 text-sm">

                <div>
                    <dt class="font-medium text-gray-600">Proyecto</dt>
                    <dd class="mt-1 break-words text-gray-500">
                        {{ $avance->proyecto?->codigo }}
                        -
                        {{ $avance->proyecto?->nombre ?? 'No registra' }}
                    </dd>
                </div>

                <div>
                    <dt class="font-medium text-gray-600">Indicador</dt>
                    <dd class="mt-1 break-words text-gray-500">
                        {{ $avance->indicador?->codigo }}
                        -
                        {{ $avance->indicador?->nombre ?? 'No registra' }}
                    </dd>
                </div>

                <div>
                    <dt class="font-medium text-gray-600">Unidad de medida</dt>
                    <dd class="mt-1 text-gray-500">
                        {{ $avance->indicador?->unidad_medida ?? 'No registra' }}
                    </dd>
                </div>

                <div>
                    <dt class="font-medium text-gray-600">Estado</dt>
                    <dd class="mt-1 text-gray-500">{{ $avance->estado }}</dd>
                </div>

            </dl>

        </div>


        <!-- Valores -->
        <div class="rounded-lg border border-gray-200 bg-white p-5">

            <h3 class="text-sm font-semibold text-gray-800">
                Seguimiento físico
            </h3>

            <dl class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 text-sm">

                <div>
                    <dt class="font-medium text-gray-600">Año</dt>
                    <dd class="mt-1 text-gray-500">{{ $avance->anio }}</dd>
                </div>

                <div>
                    <dt class="font-medium text-gray-600">Período</dt>
                    <dd class="mt-1 text-gray-500">{{ $avance->periodo }}</dd>
                </div>

                <div>
                    <dt class="font-medium text-gray-600">Fecha de corte</dt>
                    <dd class="mt-1 text-gray-500">
                        {{ $avance->fecha_corte?->format('d/m/Y') ?? 'No registra' }}
                    </dd>
                </div>

                <div>
                    <dt class="font-medium text-gray-600">Valor programado</dt>
                    <dd class="mt-1 text-gray-500">
                        {{ number_format((float) $avance->valor_programado, 4) }}
                    </dd>
                </div>

                <div>
                    <dt class="font-medium text-gray-600">Valor ejecutado</dt>
                    <dd class="mt-1 text-gray-500">
                        {{ number_format((float) $avance->valor_ejecutado, 4) }}
                    </dd>
                </div>

                <div>
                    <dt class="font-medium text-gray-600">Cumplimiento</dt>

                    <dd class="mt-1 font-semibold {{
                        $avance->alerta === 'Cumplido'
                            ? 'text-green-700'
                            : ($avance->alerta === 'En riesgo'
                                ? 'text-amber-700'
                                : 'text-red-700')
                    }}">
                        {{ number_format($avance->porcentaje_cumplimiento, 2) }}%
                        <span class="block text-xs font-normal">
                            {{ $avance->alerta }}
                        </span>
                    </dd>

                </div>

            </dl>

        </div>


        <!-- Resultados -->
        <div class="rounded-lg border border-gray-200 bg-white p-5">

            <h3 class="text-sm font-semibold text-gray-800">
                Resultado alcanzado
            </h3>

            <p class="mt-2 whitespace-pre-line break-words text-sm text-gray-600">{{ $avance->resultado ?: 'No registra.' }}</p>


            <h3 class="mt-5 text-sm font-semibold text-gray-800">
                Observaciones
            </h3>

            <p class="mt-2 whitespace-pre-line break-words text-sm text-gray-600">{{ $avance->observaciones ?: 'No registra.' }}</p>


            <p class="mt-5 border-t border-gray-100 pt-4 text-xs text-gray-500">

                Registrado por

                {{ trim(
                    ($avance->creador?->nombres ?? '') . ' ' .
                    ($avance->creador?->apellidos ?? '')
                ) ?: 'No registra' }}

                el {{ $avance->created_at?->format('d/m/Y H:i') ?? 'No registra' }}

            </p>

        </div>

    </div>

</x-seguimiento-layout>