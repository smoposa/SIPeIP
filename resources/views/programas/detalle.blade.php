<x-programas-layout title="Detalle del programa">

    <div class="space-y-5">

        @if(session('success'))

            <div
                id="alertSuccess"
                class="fixed right-5 top-5 z-50 rounded-lg
                       bg-green-600 px-6 py-3 text-sm
                       text-white shadow-lg"
                role="alert"
            >
                {{ session('success') }}
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const alerta =
                        document.getElementById('alertSuccess');

                    if (!alerta) {
                        return;
                    }

                    setTimeout(function () {
                        alerta.remove();
                    }, 3000);
                });
            </script>

        @endif

        {{-- Encabezado --}}
        <div class="rounded-lg border border-gray-200 bg-white">

            <div class="flex flex-col gap-4 px-5 py-4
                        lg:flex-row lg:items-center lg:justify-between">

                <div class="flex min-w-0 items-center gap-3">

                    <div class="flex h-12 w-12 flex-shrink-0 items-center
                                justify-center rounded-lg border
                                border-gray-200 bg-gray-100">

                        <i class="bi bi-collection text-xl text-gray-600"></i>

                    </div>

                    <div class="min-w-0">

                        <p class="font-mono text-xs font-semibold
                                  text-[#024687]">
                            {{ $programa->codigo }}
                        </p>

                        <h2 class="truncate text-lg font-semibold
                                   text-gray-800">
                            {{ $programa->nombre }}
                        </h2>

                        <p class="mt-0.5 text-sm text-gray-500">
                            {{ $programa->entidad?->nombre
                                ?? 'Entidad no registrada' }}
                        </p>

                    </div>

                </div>

                <div class="flex flex-wrap items-center gap-2">

                    <a
                        href="{{ route('programas.listar') }}"
                        class="inline-flex items-center gap-2 rounded-md
                               border border-gray-300 bg-white px-3 py-2
                               text-sm font-medium text-gray-700
                               transition hover:bg-gray-50"
                    >
                        <i class="bi bi-arrow-left"></i>

                        Regresar
                    </a>

                    @if(puedeHacer('programas', 'editar'))

                        <a
                            href="{{ route(
                                'programas.edit',
                                $programa->id
                            ) }}"
                            class="inline-flex items-center gap-2
                                   rounded-md bg-blue-600 px-3 py-2
                                   text-sm font-medium text-white
                                   transition hover:bg-blue-700"
                        >
                            <i class="bi bi-pencil"></i>

                            Editar
                        </a>

                    @endif

                </div>

            </div>

        </div>

        <div
            class="overflow-y-auto pr-1"
            style="height: calc(100vh - 190px); min-height: 420px;"
        >
            <div class="space-y-5">

                {{-- Estados --}}
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">

                    <div class="rounded-lg border
                                border-gray-200 bg-white p-5">

                        <p class="text-xs font-medium uppercase
                                  tracking-wide text-gray-500">
                            Estado administrativo
                        </p>

                        <div class="mt-3 flex flex-wrap
                                    items-center justify-between gap-3">

                            @if($programa->estado === 'Activo')

                                <span class="inline-flex items-center
                                             gap-1.5 rounded-full
                                             bg-green-50 px-2.5 py-1
                                             text-xs font-medium
                                             text-green-700">

                                    <span class="h-1.5 w-1.5
                                                 rounded-full bg-green-500">
                                    </span>

                                    Activo
                                </span>

                            @else

                                <span class="inline-flex items-center
                                             gap-1.5 rounded-full
                                             bg-red-50 px-2.5 py-1
                                             text-xs font-medium
                                             text-red-700">

                                    <span class="h-1.5 w-1.5
                                                 rounded-full bg-red-500">
                                    </span>

                                    Inactivo
                                </span>

                            @endif

                            @if(puedeHacer('programas', 'estado'))

                                <form
                                    method="POST"
                                    action="{{ route(
                                        'programas.estado',
                                        $programa->id
                                    ) }}"
                                >
                                    @csrf
                                    @method('PUT')

                                    <input
                                        type="hidden"
                                        name="estado"
                                        value="{{
                                            $programa->estado === 'Activo'
                                                ? 0
                                                : 1
                                        }}"
                                    >

                                    <button
                                        type="submit"
                                        class="text-xs font-medium
                                               text-blue-600
                                               hover:text-blue-800"
                                    >
                                        {{ $programa->estado === 'Activo'
                                            ? 'Inactivar'
                                            : 'Activar' }}
                                    </button>

                                </form>

                            @endif

                        </div>

                    </div>

                    <div class="rounded-lg border
                                border-gray-200 bg-white p-5">

                        <p class="text-xs font-medium uppercase
                                  tracking-wide text-gray-500">
                            Estado del proceso
                        </p>

                        @php
                            $claseProceso = match(
                                $programa->estado_proceso
                            ) {
                                'Priorizado' =>
                                    'bg-green-50 text-green-700',

                                'En revisión' =>
                                    'bg-blue-50 text-blue-700',

                                'Observado' =>
                                    'bg-amber-50 text-amber-700',

                                'Negado' =>
                                    'bg-red-50 text-red-700',

                                default =>
                                    'bg-gray-100 text-gray-700',
                            };
                        @endphp

                        <div class="mt-3 flex flex-col gap-3
                                    sm:flex-row sm:items-center
                                    sm:justify-between">

                            <span class="inline-flex w-fit rounded-full
                                         px-2.5 py-1 text-xs font-medium
                                         {{ $claseProceso }}">
                                {{ $programa->estado_proceso }}
                            </span>

                            @if(puedeHacer('programas', 'proceso'))

                                <form
                                    method="POST"
                                    action="{{ route(
                                        'programas.estado-proceso',
                                        $programa->id
                                    ) }}"
                                    class="flex items-center gap-2"
                                >
                                    @csrf
                                    @method('PUT')

                                    <select
                                        name="estado_proceso"
                                        required
                                        class="rounded-md border-gray-300
                                               py-1.5 text-xs shadow-sm
                                               focus:border-blue-500
                                               focus:ring-blue-500"
                                    >
                                        @foreach(
                                            \App\Enums\EstadoProcesoPrograma::cases()
                                            as $estadoProceso
                                        )

                                            <option
                                                value="{{ $estadoProceso->value }}"
                                                @selected(
                                                    $programa->estado_proceso
                                                    === $estadoProceso->value
                                                )
                                            >
                                                {{ $estadoProceso->value }}
                                            </option>

                                        @endforeach
                                    </select>

                                    <button
                                        type="submit"
                                        class="rounded-md bg-blue-600
                                               px-3 py-1.5 text-xs
                                               font-medium text-white
                                               transition hover:bg-blue-700"
                                    >
                                        Actualizar
                                    </button>

                                </form>

                            @endif

                        </div>

                        @error('estado_proceso')

                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                </div>

                {{-- Información general --}}
                <div class="rounded-lg border
                            border-gray-200 bg-white">

                    <div class="border-b border-gray-200 px-5 py-3">

                        <h3 class="text-sm font-semibold text-gray-800">
                            Información general
                        </h3>

                    </div>

                    <div class="grid grid-cols-1 gap-5 p-5 md:grid-cols-2">

                        <div>

                            <p class="text-xs font-medium
                                      uppercase text-gray-500">
                                Período
                            </p>

                            <p class="mt-1 text-sm text-gray-700">
                                {{ $programa->periodo_inicio }}
                                –
                                {{ $programa->periodo_fin }}
                            </p>

                        </div>

                        <div>

                            <p class="text-xs font-medium
                                      uppercase text-gray-500">
                                Proyectos relacionados
                            </p>

                            <p class="mt-1 text-sm text-gray-700">
                                {{ $programa->proyectos->count() }}
                            </p>

                        </div>

                        <div>

                            <p class="text-xs font-medium
                                      uppercase text-gray-500">
                                Responsable
                            </p>

                            <p class="mt-1 text-sm text-gray-700">
                                {{ $programa->responsable?->nombres
                                    ?? 'No registra' }}

                                {{ $programa->responsable?->apellidos
                                    ?? '' }}
                            </p>

                            @if($programa->responsable?->cargo)

                                <p class="mt-0.5 text-xs text-gray-500">
                                    {{ $programa->responsable->cargo }}
                                </p>

                            @endif

                        </div>

                        <div>

                            <p class="text-xs font-medium
                                      uppercase text-gray-500">
                                Registrado por
                            </p>

                            <p class="mt-1 text-sm text-gray-700">
                                {{ $programa->usuario?->nombres
                                    ?? 'No registra' }}

                                {{ $programa->usuario?->apellidos
                                    ?? '' }}
                            </p>

                        </div>

                        <div class="md:col-span-2">

                            <p class="text-xs font-medium
                                      uppercase text-gray-500">
                                Descripción
                            </p>

                            <p class="mt-1 whitespace-pre-line
                                      text-sm leading-relaxed text-gray-700">
                                {{ $programa->descripcion
                                    ?: 'No registra' }}
                            </p>

                        </div>

                    </div>

                </div>

                {{-- Objetivos --}}
                <div class="rounded-lg border
                            border-gray-200 bg-white">

                    <div class="border-b border-gray-200 px-5 py-3">

                        <h3 class="text-sm font-semibold text-gray-800">
                            Alineación con Objetivos Estratégicos
                            Institucionales
                        </h3>

                    </div>

                    <div class="p-5">

                        <div class="space-y-3">

                            @forelse($programa->objetivos as $objetivo)

                                <div class="rounded-md border
                                            border-gray-200 bg-gray-50 p-4">

                                    <p class="font-mono text-xs
                                              font-semibold text-[#024687]">
                                        {{ $objetivo->codigo }}
                                    </p>

                                    <p class="mt-1 text-sm
                                              font-medium text-gray-800">
                                        {{ $objetivo->nombre }}
                                    </p>

                                    @if($objetivo->descripcion)

                                        <p class="mt-1 text-xs
                                                  leading-relaxed text-gray-500">
                                            {{ $objetivo->descripcion }}
                                        </p>

                                    @endif

                                </div>

                            @empty

                                <p class="py-4 text-center
                                          text-sm text-gray-500">
                                    No existen objetivos asociados.
                                </p>

                            @endforelse

                        </div>

                    </div>

                </div>

                {{-- Auditoría básica --}}
                <div class="rounded-lg border
                            border-gray-200 bg-white">

                    <div class="border-b border-gray-200 px-5 py-3">

                        <h3 class="text-sm font-semibold text-gray-800">
                            Trazabilidad básica
                        </h3>

                    </div>

                    <div class="grid grid-cols-1 gap-5 p-5 md:grid-cols-2">

                        <div>

                            <p class="text-xs font-medium
                                      uppercase text-gray-500">
                                Fecha de creación
                            </p>

                            <p class="mt-1 text-sm text-gray-700">
                                {{ $programa->created_at?->format(
                                    'd/m/Y H:i'
                                ) ?? 'No registra' }}
                            </p>

                        </div>

                        <div>

                            <p class="text-xs font-medium
                                      uppercase text-gray-500">
                                Última actualización
                            </p>

                            <p class="mt-1 text-sm text-gray-700">
                                {{ $programa->updated_at?->format(
                                    'd/m/Y H:i'
                                ) ?? 'No registra' }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-programas-layout>