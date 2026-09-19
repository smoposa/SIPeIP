<x-programas-layout title="Programas de inversión">

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

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 flex-shrink-0 items-center
                                justify-center rounded-lg border
                                border-gray-200 bg-gray-100">

                        <i class="bi bi-collection text-xl text-gray-600"></i>

                    </div>

                    <div>

                        <p class="text-xs font-medium uppercase
                                  tracking-wide text-gray-400">
                            Inversión pública
                        </p>

                        <h2 class="text-lg font-semibold text-gray-800">
                            Programas de inversión
                        </h2>

                        <p class="mt-0.5 text-sm text-gray-500">
                            Programas institucionales alineados con los
                            objetivos estratégicos de la entidad.
                        </p>

                    </div>

                </div>

                @if(puedeHacer('programas', 'crear'))

                    <a
                        href="{{ route('programas.create') }}"
                        class="inline-flex items-center justify-center
                               gap-2 rounded-md bg-blue-600 px-4 py-2
                               text-sm font-medium text-white
                               transition hover:bg-blue-700"
                    >
                        <i class="bi bi-plus-lg"></i>

                        Nuevo programa
                    </a>

                @endif

            </div>

        </div>

        {{-- Resumen --}}
        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">

            <div class="rounded-lg border border-gray-200
                        bg-white px-4 py-3">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center
                                rounded-lg bg-slate-100">

                        <i class="bi bi-collection text-slate-600"></i>

                    </div>

                    <div>

                        <p class="text-xl font-semibold text-gray-800">
                            {{ $totalProgramas }}
                        </p>

                        <p class="text-xs text-gray-500">
                            Total de programas
                        </p>

                    </div>

                </div>

            </div>

            <div class="rounded-lg border border-gray-200
                        bg-white px-4 py-3">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center
                                rounded-lg bg-green-50">

                        <i class="bi bi-check-circle text-green-600"></i>

                    </div>

                    <div>

                        <p class="text-xl font-semibold text-gray-800">
                            {{ $totalActivos }}
                        </p>

                        <p class="text-xs text-gray-500">
                            Programas activos
                        </p>

                    </div>

                </div>

            </div>

            <div class="rounded-lg border border-gray-200
                        bg-white px-4 py-3">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center
                                rounded-lg bg-red-50">

                        <i class="bi bi-x-circle text-red-600"></i>

                    </div>

                    <div>

                        <p class="text-xl font-semibold text-gray-800">
                            {{ $totalInactivos }}
                        </p>

                        <p class="text-xs text-gray-500">
                            Programas inactivos
                        </p>

                    </div>

                </div>

            </div>

        </div>

        {{-- Tabla --}}
        <div class="overflow-hidden rounded-lg
                    border border-gray-200 bg-white">

            <div
                class="overflow-auto"
                style="height: calc(100vh - 345px); min-height: 320px;"
            >
                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="sticky top-0 z-10 bg-gray-50">

                        <tr>

                            <th class="w-28 px-4 py-3 text-left text-xs
                                       font-medium uppercase tracking-wide
                                       text-gray-500">
                                Código
                            </th>

                            <th class="px-4 py-3 text-left text-xs
                                       font-medium uppercase tracking-wide
                                       text-gray-500">
                                Programa
                            </th>

                            <th class="w-28 px-4 py-3 text-center text-xs
                                       font-medium uppercase tracking-wide
                                       text-gray-500">
                                Período
                            </th>

                            <th class="w-24 px-4 py-3 text-center text-xs
                                       font-medium uppercase tracking-wide
                                       text-gray-500">
                                Proyectos
                            </th>

                            <th class="w-32 px-4 py-3 text-center text-xs
                                       font-medium uppercase tracking-wide
                                       text-gray-500">
                                Proceso
                            </th>

                            <th class="w-24 px-4 py-3 text-center text-xs
                                       font-medium uppercase tracking-wide
                                       text-gray-500">
                                Estado
                            </th>

                            <th class="w-32 px-4 py-3 text-center text-xs
                                       font-medium uppercase tracking-wide
                                       text-gray-500">
                                Acciones
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">

                        @forelse($programas as $programa)

                            <tr class="transition hover:bg-gray-50">

                                <td class="whitespace-nowrap px-4 py-3">

                                    <span class="font-mono text-xs
                                                 font-semibold text-[#024687]">
                                        {{ $programa->codigo }}
                                    </span>

                                </td>

                                <td class="px-4 py-3">

                                    <a
                                        href="{{ route(
                                            'programas.detalle',
                                            $programa->id
                                        ) }}"
                                        class="text-sm font-medium
                                               text-gray-800 hover:text-blue-700"
                                    >
                                        {{ $programa->nombre }}
                                    </a>

                                    <p class="mt-1 text-xs text-gray-500">
                                        Responsable:
                                        {{ $programa->responsable?->nombres
                                            ?? 'No registra' }}
                                        {{ $programa->responsable?->apellidos
                                            ?? '' }}
                                    </p>

                                    <p class="mt-0.5 text-xs text-gray-400">
                                        {{ $programa->objetivos->count() }}
                                        objetivos asociados
                                    </p>

                                </td>

                                <td class="whitespace-nowrap px-4 py-3
                                           text-center text-xs text-gray-600">
                                    {{ $programa->periodo_inicio }}
                                    –
                                    {{ $programa->periodo_fin }}
                                </td>

                                <td class="px-4 py-3 text-center">

                                    <span class="inline-flex min-w-8
                                                 items-center justify-center
                                                 rounded-full bg-gray-100
                                                 px-2 py-1 text-xs
                                                 font-medium text-gray-700">
                                        {{ $programa->proyectos_count }}
                                    </span>

                                </td>

                                <td class="px-4 py-3 text-center">

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

                                    <span class="inline-flex rounded-full
                                                 px-2 py-1 text-[11px]
                                                 font-medium
                                                 {{ $claseProceso }}">
                                        {{ $programa->estado_proceso }}
                                    </span>

                                </td>

                                <td class="px-4 py-3 text-center">

                                    @if($programa->estado === 'Activo')

                                        <span class="inline-flex items-center
                                                     gap-1.5 rounded-full
                                                     bg-green-50 px-2 py-1
                                                     text-[11px] font-medium
                                                     text-green-700">

                                            <span class="h-1.5 w-1.5
                                                         rounded-full
                                                         bg-green-500">
                                            </span>

                                            Activo
                                        </span>

                                    @else

                                        <span class="inline-flex items-center
                                                     gap-1.5 rounded-full
                                                     bg-red-50 px-2 py-1
                                                     text-[11px] font-medium
                                                     text-red-700">

                                            <span class="h-1.5 w-1.5
                                                         rounded-full
                                                         bg-red-500">
                                            </span>

                                            Inactivo
                                        </span>

                                    @endif

                                </td>

                                <td class="px-4 py-3">

                                    <div class="flex items-center
                                                justify-center gap-2">

                                        <a
                                            href="{{ route(
                                                'programas.detalle',
                                                $programa->id
                                            ) }}"
                                            class="inline-flex h-8 w-8
                                                   items-center justify-center
                                                   rounded-md border
                                                   border-gray-300 bg-white
                                                   text-gray-600 transition
                                                   hover:bg-gray-100"
                                            title="Ver detalle"
                                        >
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        @if(puedeHacer(
                                            'programas',
                                            'editar'
                                        ))

                                            <a
                                                href="{{ route(
                                                    'programas.edit',
                                                    $programa->id
                                                ) }}"
                                                class="inline-flex h-8 w-8
                                                       items-center
                                                       justify-center
                                                       rounded-md border
                                                       border-gray-300 bg-white
                                                       text-gray-600 transition
                                                       hover:bg-gray-100"
                                                title="Editar programa"
                                            >
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                        @endif

                                        @if(puedeHacer(
                                            'programas',
                                            'estado'
                                        ))

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
                                                        $programa->estado
                                                            === 'Activo'
                                                            ? 0
                                                            : 1
                                                    }}"
                                                >

                                                <button
                                                    type="submit"
                                                    class="inline-flex h-8 w-8
                                                           items-center
                                                           justify-center
                                                           rounded-md border
                                                           transition
                                                           {{
                                                               $programa->estado
                                                                   === 'Activo'
                                                                   ? 'border-red-200 bg-red-50 text-red-700 hover:bg-red-100'
                                                                   : 'border-green-200 bg-green-50 text-green-700 hover:bg-green-100'
                                                           }}"
                                                    title="{{
                                                        $programa->estado
                                                            === 'Activo'
                                                            ? 'Inactivar programa'
                                                            : 'Activar programa'
                                                    }}"
                                                >
                                                    <i class="bi {{
                                                        $programa->estado
                                                            === 'Activo'
                                                            ? 'bi-toggle-off'
                                                            : 'bi-toggle-on'
                                                    }}"></i>
                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="px-6 py-12 text-center"
                                >
                                    <i class="bi bi-inbox
                                              text-3xl text-gray-300"></i>

                                    <p class="mt-3 text-sm font-medium
                                              text-gray-600">
                                        No existen programas registrados.
                                    </p>

                                    <p class="mt-1 text-xs text-gray-400">
                                        Registre un programa para comenzar.
                                    </p>
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            @if($programas->hasPages())

                <div class="border-t border-gray-200 px-4 py-3">
                    {{ $programas->links() }}
                </div>

            @endif

        </div>

    </div>

</x-programas-layout>