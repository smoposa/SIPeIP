<x-catalogos-layout :title="'Objetivos  ' . $agenda->nombre">
    <!-- Migas de pan del encabezado -->
    <x-slot name="breadcrumbs">

        <nav aria-label="Migas de pan">

            <ol class="flex flex-wrap items-center gap-x-2 gap-y-1 text-xs">

                <li>

                    <a href="{{ route('ods.agendas.index') }}"
                       class="text-blue-600 hover:text-blue-800 hover:underline">

                        Agendas ODS

                    </a>

                </li>


                <li aria-hidden="true">

                    <i class="bi bi-chevron-right"></i>

                </li>


                <li class="break-words">
                    {{ $agenda->nombre }}
                </li>


                <li aria-hidden="true">

                    <i class="bi bi-chevron-right"></i>

                </li>


                <li aria-current="page"
                    class="font-medium text-gray-700">

                    Objetivos

                </li>

            </ol>

        </nav>

    </x-slot>


    <div class="space-y-4">

        <!-- Notificaciones -->
        @include('ods.partials.avisos')


        <!-- Regresar y encabezado -->
        <div class="bg-white border-b border-gray-300 mb-0">

            <div class="flex">

                <a href="{{ route('ods.agendas.index') }}"
                   class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">

                    <i class="bi bi-chevron-left" aria-hidden="true"></i>
                    Regresar

                </a>


                <a href="{{ url()->current() }}"
                   class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                    <i class="bi bi-arrow-clockwise text-blue-500 me-2" aria-hidden="true"></i>
                    Actualizar

                </a>

            </div>

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
                    id="buscarObjetivo"
                    placeholder="Buscar objetivo..."
                    aria-label="Buscar objetivo"
                    class="w-full border border-gray-300 rounded-md pl-10 pr-4 py-2 text-sm
                           focus:ring-blue-500 focus:border-blue-500">

            </div>


            <!-- Filtro de estado -->
            <select
                id="filtroEstadoObjetivo"
                aria-label="Filtrar objetivos por estado"
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


            <!-- Registrar objetivo -->
            @if(puedeHacer('ods', 'crear'))

                <button
                    type="button"
                    id="registrarObjetivo"
                    aria-haspopup="dialog"
                    aria-controls="panelObjetivo"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700
                           text-white text-sm font-medium px-4 py-2 rounded-md
                           transition whitespace-nowrap">

                    <i class="bi bi-plus-lg" aria-hidden="true"></i>
                    Registrar objetivo

                </button>

            @endif

        </div>


        <!-- Listado y panel de objetivos -->
        <div id="gestionObjetivos">

            @include('ods.objetivos.partials.listado-objetivos')

            @include('ods.objetivos.partials.panel-editar-objetivo')

        </div>


        <!-- Funcionamiento del panel lateral -->
        @include('ods.objetivos.partials.scripts-objetivos')


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

                    if (sinResultados) {

                        sinResultados.classList.toggle(
                            'hidden',
                            visibles > 0 || filas.length === 0
                        );

                    }

                }

                buscador.addEventListener('input', filtrarObjetivos);
                filtroEstado.addEventListener('change', filtrarObjetivos);

                filtrarObjetivos();

            });
        </script>

    </div>

</x-catalogos-layout>