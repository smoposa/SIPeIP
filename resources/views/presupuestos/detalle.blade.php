<x-seguimiento-layout title="Detalle presupuestario">

    <x-slot name="breadcrumbs">

        <nav aria-label="Migas de pan">

            <ol class="flex flex-wrap items-center gap-2 text-xs">

                <li>
                    <a href="{{ route('presupuestos.listar') }}"
                       class="text-gray-500 hover:text-blue-600">
                        Presupuestos
                    </a>
                </li>

                <li aria-hidden="true" class="text-gray-400">/</li>

                <li aria-current="page" class="font-medium text-gray-700">
                    Detalle presupuestario
                </li>

            </ol>

        </nav>

    </x-slot>


    <div class="space-y-4">

        @include('presupuestos.partials.avisos')


        <!-- Descripción y acciones -->
        <div class="flex flex-wrap items-center justify-between gap-4">

            <p class="text-sm text-gray-500">
                Consulte los montos registrados y la ejecución financiera del proyecto.
            </p>

            <div class="flex items-center gap-2">

                <a href="{{ route('presupuestos.listar') }}"
                   class="rounded-md border border-gray-300 px-4 py-2 text-sm
                          font-medium text-gray-700 transition hover:bg-gray-50">
                    Volver
                </a>

                @if($presupuesto->estado === 'Borrador' && puedeHacer('presupuestos', 'editar'))

                    <a href="{{ route('presupuestos.edit', $presupuesto) }}"
                       class="inline-flex items-center gap-2 rounded-md bg-blue-600
                              px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-700">

                        <i class="bi bi-pencil" aria-hidden="true"></i>
                        Editar presupuesto

                    </a>

                @endif

            </div>

        </div>


        <!-- Información general -->
        <div class="rounded-lg border border-gray-200 bg-white p-5">

            <h3 class="text-sm font-semibold text-gray-800">
                Información del registro
            </h3>

            <dl class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2 text-sm">

                <div class="md:col-span-2">

                    <dt class="font-medium text-gray-600">Proyecto</dt>

                    <dd class="mt-1 break-words text-gray-500">
                        {{ $presupuesto->proyecto?->codigo }}
                        -
                        {{ $presupuesto->proyecto?->nombre ?? 'No registra' }}
                    </dd>

                </div>

                <div>
                    <dt class="font-medium text-gray-600">Año</dt>
                    <dd class="mt-1 text-gray-500">{{ $presupuesto->anio }}</dd>
                </div>

                <div>
                    <dt class="font-medium text-gray-600">Período</dt>
                    <dd class="mt-1 text-gray-500">{{ $presupuesto->periodo }}</dd>
                </div>

                <div>
                    <dt class="font-medium text-gray-600">Fecha de corte</dt>
                    <dd class="mt-1 text-gray-500">
                        {{ $presupuesto->fecha_corte?->format('d/m/Y') ?? 'No registra' }}
                    </dd>
                </div>

                <div>
                    <dt class="font-medium text-gray-600">Estado</dt>
                    <dd class="mt-1 text-gray-500">{{ $presupuesto->estado }}</dd>
                </div>

            </dl>

        </div>


        <!-- Montos y ejecución -->
        <div class="rounded-lg border border-gray-200 bg-white p-5">

            <h3 class="text-sm font-semibold text-gray-800">
                Seguimiento financiero
            </h3>

            <dl class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 text-sm">

                <div>

                    <dt class="font-medium text-gray-600">Aprobado del proyecto</dt>

                    <dd class="mt-1 text-gray-500">

                        @if($presupuesto->proyecto)

                            USD {{ number_format(
                                (float) $presupuesto->proyecto->presupuesto_aprobado,
                                2
                            ) }}

                        @else

                            No registra

                        @endif

                    </dd>

                </div>


                @foreach([
                    'Programado' => $presupuesto->monto_programado,
                    'Vigente' => $presupuesto->presupuesto_vigente,
                    'Ejecutado' => $presupuesto->monto_ejecutado
                ] as $etiqueta => $monto)

                    <div>

                        <dt class="font-medium text-gray-600">{{ $etiqueta }}</dt>

                        <dd class="mt-1 text-gray-500">
                            USD {{ number_format((float) $monto, 2) }}
                        </dd>

                    </div>

                @endforeach

            </dl>


            <div class="mt-5 border-t border-gray-100 pt-4">

                <p class="text-sm font-medium text-gray-600">
                    Ejecución financiera
                </p>

                <p class="mt-1 text-xl font-semibold {{
                    $presupuesto->alerta === 'Cumplido'
                        ? 'text-green-700'
                        : ($presupuesto->alerta === 'En riesgo'
                            ? 'text-amber-700'
                            : 'text-red-700')
                }}">
                    {{ number_format($presupuesto->porcentaje_ejecucion, 2) }}%
                </p>

                <p class="mt-1 text-xs text-gray-500">
                    {{ $presupuesto->alerta }}
                </p>

            </div>

        </div>


        <!-- Observaciones -->
        <div class="rounded-lg border border-gray-200 bg-white p-5">

            <h3 class="text-sm font-semibold text-gray-800">
                Observaciones
            </h3>

            <p class="mt-2 whitespace-pre-line break-words text-sm text-gray-600">{{ $presupuesto->observaciones ?: 'No registra.' }}</p>


            <p class="mt-5 border-t border-gray-100 pt-4 text-xs text-gray-500">

                Registrado por

                {{ trim(
                    ($presupuesto->creador?->nombres ?? '') . ' ' .
                    ($presupuesto->creador?->apellidos ?? '')
                ) ?: 'No registra' }}

                el {{ $presupuesto->created_at?->format('d/m/Y H:i') ?? 'No registra' }}

            </p>

        </div>

    </div>

</x-seguimiento-layout>