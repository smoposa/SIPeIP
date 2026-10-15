<x-catalogos-layout :title="$agenda->nombre">

    <div class="space-y-4">

        <!-- Notificaciones -->
        @include('ods.partials.avisos')











        <!-- Barra de acciones -->
        <div class="flex flex-wrap items-center gap-6 py-3
                    border-b border-gray-200 text-sm">

            <a href="{{ route('ods.index') }}"
               class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800">

                <i class="bi bi-chevron-left"></i>
                Regresar

            </a>

            @if(puedeHacer('ods', 'editar'))

                <a href="{{ route('catalogos.gestion.edit', ['ods-agendas', $agenda->id]) }}"
                   class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800">

                    <i class="bi bi-pencil"></i>
                    Editar información

                </a>

            @endif

            @include('catalogos.gestion.estado', [
                'modulo' => 'ods',
                'recursoEstado' => 'ods-agendas',
                'registroEstado' => $agenda,
            ])

            <a href="{{ route('ods.agenda', $agenda->id) }}"
               class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800">

                <i class="bi bi-arrow-clockwise"></i>
                Actualizar

            </a>

        </div>

        <!-- Identificación de la agenda -->
        <div class="flex items-center gap-4 py-2">

            <div class="flex h-16 w-16 shrink-0 items-center justify-center
                        rounded-full bg-blue-600 text-white">

                <i class="bi bi-journal-text text-3xl"></i>

            </div>

            <div>

                <h2 class="text-xl font-semibold text-gray-900">
                    {{ $agenda->nombre }}
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Agenda de Desarrollo Sostenible
                </p>

            </div>

        </div>

        <!-- Información general -->
        <div>

            <!-- Encabezado -->
            <div class="flex items-center justify-between
                        bg-gray-100 px-4 py-2 border-b border-gray-200">

                <h3 class="text-sm font-medium text-gray-800">
                    Información general
                </h3>

                @if(puedeHacer('ods', 'editar'))

                    <a href="{{ route('catalogos.gestion.edit', ['ods-agendas', $agenda->id]) }}"
                       class="text-sm text-blue-600 hover:underline">

                        Editar

                    </a>

                @endif

            </div>

            <!-- Datos de la agenda -->
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-4 px-4 py-4">

                <div class="grid grid-cols-[140px_1fr] gap-3">

                    <dt class="text-sm font-medium text-gray-700">
                        Nombre
                    </dt>

                    <dd class="text-sm text-gray-600 break-words">
                        {{ $agenda->nombre }}
                    </dd>

                </div>

                <div class="grid grid-cols-[140px_1fr] gap-3">

                    <dt class="text-sm font-medium text-gray-700">
                        Estado
                    </dt>

                    <dd>

                        @if($agenda->estado === 'Activo')

                            <span class="inline-flex items-center gap-1.5 text-sm text-green-600">

                                <i class="bi bi-check-lg"></i>
                                Activo

                            </span>

                        @else

                            <span class="inline-flex items-center gap-1.5 text-sm text-red-600">

                                <i class="bi bi-x-lg"></i>
                                Inactivo

                            </span>

                        @endif

                    </dd>

                </div>

                <div class="grid grid-cols-[140px_1fr] gap-3">

                    <dt class="text-sm font-medium text-gray-700">
                        Período
                    </dt>

                    <dd class="text-sm text-gray-600">
                        {{ $agenda->periodo_inicio }}–{{ $agenda->periodo_fin }}
                    </dd>

                </div>

                <div class="grid grid-cols-[140px_1fr] gap-3">

                    <dt class="text-sm font-medium text-gray-700">
                        Objetivos
                    </dt>

                    <dd class="text-sm text-gray-600">
                        {{ $ods->count() }}
                    </dd>

                </div>

                <div class="grid grid-cols-[140px_1fr] gap-3 md:col-span-2">

                    <dt class="text-sm font-medium text-gray-700">
                        Descripción
                    </dt>

                    <dd class="text-sm text-gray-600 whitespace-pre-line break-words">{{ $agenda->descripcion ?: 'Sin descripción registrada.' }}</dd>

                </div>

            </dl>

            @if($agenda->estado === 'Inactivo')

                <p class="mx-4 mb-4 text-sm text-amber-700">
                    Agenda inactiva. Su información se conserva para consulta
                    y no se utiliza en nuevas alineaciones.
                </p>

            @endif

        </div>

        <!-- Encabezado del listado -->
        <div class="bg-gray-100 px-4 py-2 border-b border-gray-200">

            <h3 class="text-sm font-medium text-gray-800">
                Objetivos de Desarrollo Sostenible
            </h3>

        </div>













        <!-- Buscador, filtro, resumen y crear -->
        <div class="flex flex-wrap items-center gap-4">

            <!-- Buscador -->
            <div class="relative flex-1 max-w-md">

                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <i class="bi bi-search"></i>
                </span>

                <input
                    type="text"
                    id="buscarObjetivo"
                    placeholder="Buscar objetivo..."
                    class="w-full border border-gray-300 rounded-md pl-10 pr-4 py-2 text-sm
                           focus:ring-blue-500 focus:border-blue-500">

            </div>

            <!-- Filtro de estado -->
            <select
                id="filtroEstadoObjetivo"
                class="w-48 rounded-md border border-gray-300 px-3 py-2 text-sm
                       text-gray-700 focus:border-blue-500 focus:ring-blue-500">

                <option value="">Todos los estados</option>
                <option value="Activo">Activos</option>
                <option value="Inactivo">Inactivos</option>

            </select>

            <!-- Resumen -->
            <div class="flex-1">

                <p class="text-sm text-gray-500">

                    <span class="text-blue-600 font-medium">
                        {{ $ods->count() }}
                    </span>
                    registros ·

                    <span class="text-green-600 font-medium">
                        {{ $ods->where('estado', 'Activo')->count() }}
                    </span>
                    activos ·

                    <span class="text-red-600 font-medium">
                        {{ $ods->where('estado', 'Inactivo')->count() }}
                    </span>
                    inactivos

                </p>

            </div>

            <!-- Crear objetivo -->
            @if(puedeHacer('ods', 'crear'))

                <a href="{{ route('catalogos.gestion.create', [
                        'recurso' => 'ods',
                        'padre' => $agenda->id,
                    ]) }}"
                   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700
                          text-white text-sm font-medium px-4 py-2 rounded-md
                          transition whitespace-nowrap">

                    <i class="bi bi-plus-lg"></i>

                    Crear objetivo ODS

                </a>

            @endif

        </div>

        <!-- Listado de objetivos -->
        <div class="border border-gray-200 rounded-lg overflow-hidden">

            <!-- Scroll independiente -->
            <div class="overflow-auto"
                 style="max-height: calc(100vh - 340px);">

                <table class="min-w-full">

                    <!-- Encabezado fijo -->
                    <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">

                        <tr>

                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                                Nro
                            </th>

                            <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                                Código
                            </th>

                            <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                                Objetivo
                            </th>

                            <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                                Metas
                            </th>

                            <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                                Estado
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($ods as $item)

                            <tr
                                class="fila-objetivo border-b border-gray-100 hover:bg-gray-50 transition"
                                data-codigo="{{ $item->codigo }}"
                                data-nombre="{{ $item->nombre }}"
                                data-estado="{{ $item->estado }}"
                            >

                                <!-- Nro -->
                                <td class="px-4 py-2 text-sm text-gray-600">
                                    {{ $loop->iteration }}
                                </td>

                                <!-- Código -->
                                <td class="px-2 py-2 text-xs text-gray-600 whitespace-nowrap">
                                    {{ $item->codigo }}
                                </td>

                                <!-- Objetivo -->
                                <td class="px-2 py-2 text-xs font-medium max-w-xl">

                                    <a href="{{ route('ods.detalle', $item->id) }}"
                                       class="text-blue-600 hover:text-blue-800 hover:underline">

                                        <span class="block line-clamp-2"
                                              title="{{ $item->nombre }}">

                                            {{ $item->nombre }}

                                        </span>

                                    </a>

                                </td>

                                <!-- Metas -->
                                <td class="px-2 py-2 text-xs text-gray-600">
                                    {{ $item->metas_count }}
                                </td>

                                <!-- Estado -->
                                <td class="px-2 py-2 whitespace-nowrap">

                                    @if($item->estado === 'Activo')

                                        <span class="inline-flex items-center gap-1.5 text-xs text-green-600">

                                            <i class="bi bi-check-lg font-bold"></i>

                                            Activo

                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1.5 text-xs text-red-600">

                                            <i class="bi bi-x-lg font-bold"></i>

                                            Inactivo

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5"
                                    class="px-4 py-6 text-center text-sm text-gray-500">

                                    No existen objetivos registrados en esta agenda.

                                </td>

                            </tr>

                        @endforelse

                        <!-- Sin coincidencias -->
                        <tr id="sinResultadosObjetivo" class="hidden">

                            <td colspan="5"
                                class="px-4 py-6 text-center text-sm text-gray-500">

                                No se encontraron objetivos con los filtros seleccionados.

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

        <!-- Buscador y filtro -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const buscador = document.getElementById('buscarObjetivo');
                const filtroEstado = document.getElementById('filtroEstadoObjetivo');
                const filas = document.querySelectorAll('.fila-objetivo');
                const sinResultados = document.getElementById('sinResultadosObjetivo');

                function filtrarObjetivos() {

                    const texto = buscador.value.toLowerCase().trim();
                    const estado = filtroEstado.value;

                    let visibles = 0;

                    filas.forEach(function (fila) {

                        const codigo = (fila.dataset.codigo || '').toLowerCase();
                        const nombre = (fila.dataset.nombre || '').toLowerCase();
                        const estadoObjetivo = fila.dataset.estado || '';

                        const coincideTexto =
                            codigo.includes(texto) ||
                            nombre.includes(texto);

                        const coincideEstado =
                            estado === '' ||
                            estadoObjetivo === estado;

                        const mostrar = coincideTexto && coincideEstado;

                        fila.style.display = mostrar ? '' : 'none';

                        if (mostrar) {
                            visibles++;
                        }

                    });

                    sinResultados.classList.toggle(
                        'hidden',
                        visibles > 0 || filas.length === 0
                    );

                }

                buscador.addEventListener('input', filtrarObjetivos);
                filtroEstado.addEventListener('change', filtrarObjetivos);

            });
        </script>

    </div>

</x-catalogos-layout>