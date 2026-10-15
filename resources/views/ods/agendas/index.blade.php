<x-catalogos-layout title="Agendas ODS">

    <!-- Migas de pan del encabezado -->
    <x-slot name="breadcrumbs">

        <nav aria-label="Migas de pan">

            <ol class="flex items-center text-xs">

                <li aria-current="page"
                    class="font-medium text-gray-700">

                    Agendas ODS

                </li>

            </ol>

        </nav>

    </x-slot>

    <div class="space-y-4">

        <!-- Notificaciones -->
        @include('ods.partials.avisos')


        <!-- Encabezado -->
        <div class="mb-4">

            <p class="mt-1 text-sm text-gray-500">
                Consulte y administre las agendas de desarrollo sostenible
                registradas en el sistema.
            </p>

        </div>


        <!-- Buscador, filtro, resumen y acciones -->
        <div class="flex flex-wrap items-center gap-4 mb-4">

            <!-- Buscador -->
            <div class="relative flex-1 max-w-md">

                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">

                    <i class="bi bi-search" aria-hidden="true"></i>

                </span>

                <input
                    type="text"
                    id="buscarAgenda"
                    placeholder="Buscar agenda..."
                    aria-label="Buscar agenda"
                    class="w-full border border-gray-300 rounded-md pl-10 pr-4 py-2 text-sm
                           focus:ring-blue-500 focus:border-blue-500">

            </div>


            <!-- Filtro de estado -->
            <select
                id="filtroEstadoAgenda"
                aria-label="Filtrar agendas por estado"
                class="w-48 rounded-md border border-gray-300 px-3 py-2 text-sm
                       text-gray-700 focus:border-blue-500 focus:ring-blue-500">

                <option value="">Todos los estados</option>
                <option value="Activo">Activos</option>
                <option value="Inactivo">Inactivos</option>

            </select>


            <!-- Resumen de registros -->
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


                @if($agendas->hasPages())

                    <p class="mt-1 text-xs text-gray-500">
                        El buscador, el filtro y los conteos por estado
                        corresponden a esta página.
                    </p>

                @endif

            </div>

            <!-- Crear agenda -->
            @if(puedeHacer('ods', 'crear'))

                <button
                    type="button"
                    id="crearAgenda"
                    aria-haspopup="dialog"
                    aria-controls="panelAgenda"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700
                           text-white text-sm font-medium px-4 py-2 rounded-md
                           transition whitespace-nowrap">

                    <i class="bi bi-plus-lg" aria-hidden="true"></i>
                    Crear agenda

                </button>

            @endif

        </div>


        <!-- Listado de agendas -->
        <div id="gestionAgendas">

            @include('ods.agendas.partials.listado-agendas')

            @include('ods.agendas.partials.panel-editar-agenda')

        </div>

        <!-- Funcionamiento del panel lateral -->
        @include('ods.agendas.partials.scripts-agendas')


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
                const filtroEstado = document.getElementById('filtroEstadoAgenda');
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

                filtrarAgendas();

            });
        </script>

    </div>

</x-catalogos-layout>