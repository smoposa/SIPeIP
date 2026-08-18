<x-usuarios-layout title="Todos los Usuarios">

    <div class="space-y-4">

        <!-- Notificación de Éxito -->
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
                Consulte y administre los usuarios registrados en el sistema.
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
                    id="buscarUsuario"
                    placeholder="Buscar usuario..."
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
                        {{ $totalUsuarios }}
                    </span>
                    registros ·

                    <span class="text-green-600 font-medium">
                        {{ $usuariosActivos }}
                    </span>
                    activos ·

                    <span class="text-red-600 font-medium">
                        {{ $usuariosInactivos }}
                    </span>
                    inactivos

                </p>

            </div>


            <!-- Crear usuario -->
            @if(puedeHacer('usuarios', 'crear'))

                <a href="{{ route('usuarios.create') }}"
                   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700
                          text-white text-sm font-medium px-4 py-2 rounded-md
                          transition whitespace-nowrap">

                    <i class="bi bi-plus-lg"></i>

                    Crear usuario

                </a>

            @endif

        </div>


        <!-- Listado de usuarios -->
        @include('usuarios.partials.listado-usuarios')


        <!-- Mensaje sin resultados -->
        <div id="sinResultados"
             class="hidden py-8 text-center text-sm text-gray-500">

            No se encontraron usuarios que coincidan con la búsqueda.

        </div>

    </div>


    <!-- Buscador y filtro -->
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const buscador = document.getElementById('buscarUsuario');
            const filtroEstado = document.getElementById('filtroEstado');
            const filas = document.querySelectorAll('.fila-usuario');
            const sinResultados = document.getElementById('sinResultados');

            function filtrarUsuarios() {

                const texto = buscador.value.toLowerCase().trim();
                const estado = filtroEstado.value;

                let visibles = 0;

                filas.forEach(function (fila) {

                    const nombre = fila.dataset.nombre || '';
                    const email = fila.dataset.email || '';
                    const identificacion = fila.dataset.identificacion || '';
                    const cargo = fila.dataset.cargo || '';
                    const rol = fila.dataset.rol || '';
                    const entidad = fila.dataset.entidad || '';
                    const estadoUsuario = fila.dataset.estado || '';

                    const coincideTexto =
                        nombre.includes(texto) ||
                        email.includes(texto) ||
                        identificacion.includes(texto) ||
                        cargo.includes(texto) ||
                        rol.includes(texto) ||
                        entidad.includes(texto);

                    const coincideEstado =
                        estado === '' ||
                        estadoUsuario === estado;

                    const mostrar =
                        coincideTexto && coincideEstado;

                    fila.style.display = mostrar ? '' : 'none';

                    if (mostrar) {
                        visibles++;
                    }

                });

                sinResultados.classList.toggle(
                    'hidden',
                    visibles !== 0
                );

            }

            buscador.addEventListener('input', filtrarUsuarios);
            filtroEstado.addEventListener('change', filtrarUsuarios);

        });

    </script>

</x-usuarios-layout>