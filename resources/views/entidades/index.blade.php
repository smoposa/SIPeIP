<x-entidades-layout title="Todas las Entidades">

    @if(session('success'))

        <div id="alertSuccess"
             class="fixed top-5 right-5 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">

            {{ session('success') }}

        </div>

        <script>
            setTimeout(() => {

                const alerta = document.getElementById('alertSuccess');

                if (alerta) {
                    alerta.remove();
                }

            }, 3000);
        </script>

    @endif


    <!-- Encabezado -->
    <div class="mb-4">

        <p class="mt-1 text-sm text-gray-500">
            Consulte y administre las entidades registradas en el sistema.
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
                id="buscarEntidad"
                placeholder="Buscar entidad..."
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

                {{ $totalEntidades }} registros ·

                <span class="text-green-600 font-medium">
                    {{ $entidadesActivas }}
                </span>
                activas ·

                <span class="text-red-600 font-medium">
                    {{ $entidadesInactivas }}
                </span>
                inactivas

            </p>

        </div>


        <!-- Crear entidad -->
        @if(puedeHacer('entidades', 'crear'))

            <a href="{{ route('entidades.create') }}"
               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700
                      text-white text-sm font-medium px-4 py-2 rounded-md
                      transition whitespace-nowrap">

                <i class="bi bi-plus-lg"></i>

                Crear entidad

            </a>

        @endif

    </div>


    <!-- Listado de entidades -->
    @include('entidades.partials.listado-entidades')


    <!-- Buscador y filtro -->
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const buscador = document.getElementById('buscarEntidad');
            const filtroEstado = document.getElementById('filtroEstado');
            const filas = document.querySelectorAll('.fila-entidad');

            function filtrarEntidades() {

                const texto = buscador.value.toLowerCase().trim();
                const estado = filtroEstado.value;

                filas.forEach(function (fila) {

                    const nombre = fila.dataset.nombre || '';
                    const codigo = fila.dataset.codigo || '';
                    const siglas = fila.dataset.siglas || '';
                    const tipo = fila.dataset.tipo || '';
                    const provincia = fila.dataset.provincia || '';
                    const estadoEntidad = fila.dataset.estado || '';

                    const coincideTexto =
                        nombre.includes(texto) ||
                        codigo.includes(texto) ||
                        siglas.includes(texto) ||
                        tipo.includes(texto) ||
                        provincia.includes(texto);

                    const coincideEstado =
                        estado === '' ||
                        estadoEntidad === estado;

                    fila.style.display =
                        coincideTexto && coincideEstado
                            ? ''
                            : 'none';

                });

            }

            buscador.addEventListener('input', filtrarEntidades);
            filtroEstado.addEventListener('change', filtrarEntidades);

        });

    </script>

</x-entidades-layout>