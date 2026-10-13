<x-catalogos-layout title="Agendas ODS">

    <div class="space-y-4">

        <!-- Notificaciones -->
        @include('ods.partials.avisos')

        <!-- Encabezado -->
        <div class="mb-4">

            <p class="mt-1 text-sm text-gray-500">
                Consulte y administre las agendas de desarrollo sostenible registradas en el sistema.
            </p>

        </div>

        <!-- Buscador, filtro, resumen y acciones -->
        <div class="flex items-center gap-4 mb-4">

            <!-- Buscador -->
            <div class="relative flex-1 max-w-md">

                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <i class="bi bi-search"></i>
                </span>

                <input
                    type="text"
                    id="buscarAgenda"
                    placeholder="Buscar agenda..."
                    class="w-full border border-gray-300 rounded-md pl-10 pr-4 py-2 text-sm
                        focus:ring-blue-500 focus:border-blue-500">

            </div>

            <!-- Filtro Estado -->
            <select
                id="filtroEstado"
                class="w-48 rounded-md border border-gray-300 px-3 py-2 text-sm
                    text-gray-700 focus:border-blue-500 focus:ring-blue-500">

                <option value="">Todos los estados</option>
                <option value="Activo">Activos</option>
                <option value="Inactivo">Inactivos</option>

            </select>

            <!-- Resumen de estados -->
            <div class="flex-1">

                <p class="text-sm text-gray-500">

                    <span class="text-blue-600 font-medium">
                        {{ $agendas->total() }}
                    </span>
                    registros ·

                    <span class="text-green-600 font-medium">
                        {{ $agendas->getCollection()->where('estado', 'Activo')->count() }}
                    </span>
                    activas ·

                    <span class="text-red-600 font-medium">
                        {{ $agendas->getCollection()->where('estado', 'Inactivo')->count() }}
                    </span>
                    inactivas

                </p>

            </div>

            <!-- Crear agenda -->
            @if(puedeHacer('ods', 'crear'))

                <a
                    href="{{ route('catalogos.gestion.create', 'ods-agendas') }}"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700
                        text-white text-sm font-medium px-4 py-2 rounded-md
                        transition whitespace-nowrap">

                    <i class="bi bi-plus-lg"></i>

                    Crear agenda

                </a>

            @endif

        </div>

        <!-- Listado de agendas -->
        <div class="bg-white border border-gray-200 rounded-lg overflow-x-auto">

            <table class="w-full text-sm text-left">

                <thead class="bg-gray-50 text-gray-600">

                    <tr>
                        <th class="p-4">Agenda</th>
                        <th class="p-4">Período</th>
                        <th class="p-4">Objetivos</th>
                        <th class="p-4">Estado</th>
                        <th class="p-4">Acciones</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($agendas as $agenda)

                        <tr
                            class="fila-agenda border-t border-gray-200 hover:bg-gray-50"
                            data-nombre="{{ $agenda->nombre }}"
                            data-periodo="{{ $agenda->periodo_inicio }}–{{ $agenda->periodo_fin }}"
                            data-estado="{{ $agenda->estado }}">

                            <td class="p-4">

                                <a
                                    href="{{ route('ods.agenda', $agenda->id) }}"
                                    class="font-semibold text-blue-700 hover:underline">

                                    {{ $agenda->nombre }}

                                </a>

                            </td>

                            <td class="p-4">
                                {{ $agenda->periodo_inicio }}–{{ $agenda->periodo_fin }}
                            </td>

                            <td class="p-4">
                                {{ $agenda->ods_count }}
                            </td>

                            <td class="p-4">

                                <span
                                    class="inline-flex rounded-full px-3 py-1 text-xs
                                        {{ $agenda->estado === 'Activo'
                                            ? 'bg-green-50 text-green-700'
                                            : 'bg-gray-100 text-gray-600' }}">

                                    {{ $agenda->estado }}

                                </span>

                            </td>

                            <td class="p-4">

                                <div class="flex flex-wrap items-center gap-4">

                                    <a
                                        href="{{ route('ods.agenda', $agenda->id) }}"
                                        class="text-blue-600 hover:underline">

                                        Ver objetivos

                                    </a>

                                    @if(puedeHacer('ods', 'editar'))

                                        <a
                                            href="{{ route('catalogos.gestion.edit', ['ods-agendas', $agenda->id]) }}"
                                            class="text-blue-600 hover:underline">

                                            Editar

                                        </a>

                                    @endif

                                    @include('catalogos.gestion.estado', [
                                        'modulo' => 'ods',
                                        'recursoEstado' => 'ods-agendas',
                                        'registroEstado' => $agenda,
                                    ])

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="p-8 text-center text-gray-500">
                                No existen agendas registradas.
                            </td>

                        </tr>

                    @endforelse

                    <tr id="sinResultadosAgenda" class="hidden">

                        <td colspan="5" class="p-8 text-center text-gray-500">
                            No se encontraron agendas con los filtros seleccionados.
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

        <!-- Paginación -->
        <div class="mt-4">
            {{ $agendas->links() }}
        </div>

        <!-- Buscador y filtro -->
        <script>

            document.addEventListener('DOMContentLoaded', function () {

                const buscador = document.getElementById('buscarAgenda');
                const filtroEstado = document.getElementById('filtroEstado');
                const filas = document.querySelectorAll('.fila-agenda');
                const sinResultados = document.getElementById('sinResultadosAgenda');

                function filtrarAgendas() {

                    const texto = buscador.value.toLowerCase().trim();
                    const estado = filtroEstado.value;

                    let visibles = 0;

                    filas.forEach(function (fila) {

                        const nombre = (fila.dataset.nombre || '').toLowerCase();
                        const periodo = (fila.dataset.periodo || '').toLowerCase();
                        const estadoAgenda = fila.dataset.estado || '';

                        const coincideTexto =
                            nombre.includes(texto) ||
                            periodo.includes(texto);

                        const coincideEstado =
                            estado === '' ||
                            estadoAgenda === estado;

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

                buscador.addEventListener('input', filtrarAgendas);
                filtroEstado.addEventListener('change', filtrarAgendas);

            });

        </script>

    </div>

</x-catalogos-layout>