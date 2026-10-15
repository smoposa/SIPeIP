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
        <div class="flex flex-wrap items-center gap-4 mb-4">

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

            <!-- Filtro de estado -->
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

            <!-- Crear agenda: ruta propia de ODS -->
            @if(puedeHacer('ods', 'crear'))

                <a href="{{ route('ods.create') }}"
                   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700
                          text-white text-sm font-medium px-4 py-2 rounded-md
                          transition whitespace-nowrap">

                    <i class="bi bi-plus-lg"></i>

                    Crear agenda

                </a>

            @endif

        </div>

        <!-- Listado de agendas -->
        @include('ods.partials.listado-agendas')

        <!-- Paginación -->
        @if($agendas->hasPages())

            <div class="mt-4">
                {{ $agendas->links() }}
            </div>

        @endif

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

                    if (sinResultados) {
                        sinResultados.classList.toggle(
                            'hidden',
                            visibles > 0 || filas.length === 0
                        );
                    }

                }

                buscador.addEventListener('input', filtrarAgendas);
                filtroEstado.addEventListener('change', filtrarAgendas);

            });
        </script>

    </div>

</x-catalogos-layout>