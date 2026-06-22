<x-roles-layout title="Consultar Roles">

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

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex gap-6">

            <a href="{{ route('roles.index') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Inicio
            </a>

            <a href="{{ route('roles.create') }}"
               class="px-2 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Crear rol
            </a>

            
            <a href="{{ route('roles.listar') }}"
            class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Consultar roles
            </a>

        </div>

    </div>

    <!-- Encabezado -->
    <div class="mb-6">

        <h2 class="text-2xl font-semibold text-gray-800">
            Consulta de Roles
        </h2>

        <p class="mt-1 text-gray-500">
            Visualice y administre los roles institucionales registrados en el Sistema Integral de Planificación e Inversión Pública (SIPeIP).
        </p>

    </div>

    <!-- Filtros (solo visual por ahora) 
    <div class="bg-white border border-gray-200 rounded-lg p-4 mb-6">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <input
                type="text"
                placeholder="Nombre de la entidad"
                class="border border-gray-300 rounded-md px-3 py-2">

            <input
                type="text"
                placeholder="Código institucional"
                class="border border-gray-300 rounded-md px-3 py-2">

            <select
                class="border border-gray-300 rounded-md px-3 py-2">

                <option value="">
                    Todos los tipos
                </option>

            </select>

            <select
                class="border border-gray-300 rounded-md px-3 py-2">

                <option value="">
                    Todos los estados
                </option>

                <option value="Activo">
                    Activo
                </option>

                <option value="Inactivo">
                    Inactivo
                </option>

            </select>

        </div>

    </div>-->

    <!-- Tabla -->
    <div class="overflow-y-auto" style="height: calc(100vh - 280px);"> <!-- Scroll vertical -->

        <div class="bg-white border border-gray-200 rounded-lg">

            <table class="min-w-full">

                <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">

                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                                Nro
                            </th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                                Nombre
                            </th>

                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                                Descripción
                            </th>

                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                                Estado
                            </th>

                            <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">
                                Acciones
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($roles as $rol)

                            <tr class="border-b border-gray-100 hover:bg-gray-50">

                                <!-- Nro -->
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    {{ $loop->iteration }}
                                </td>

                                <!-- Nombre -->
                                <td class="px-4 py-3 text-sm font-medium">

                                    <a href="{{ route('roles.detalle', $rol->id) }}"
                                    class="text-blue-600 hover:text-blue-800 hover:underline">

                                        {{ $rol->nombre }}

                                    </a>

                                </td>

                                <!-- Descripcion -->
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    {{ $rol->descripcion }}
                                </td>

                                <!-- Estado -->
                                <td class="px-4 py-3">

                                    @if($rol->estado == 'Activo')

                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                            Activo
                                        </span>

                                    @else

                                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                            Inactivo
                                        </span>

                                    @endif

                                </td>

                                <!-- Acciones -->
                                <td class="px-4 py-3 text-center">

                                    <a href="{{ route('roles.edit', $rol->id) }}"
                                    class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        Editar
                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5"
                                    class="px-4 py-6 text-center text-gray-500">

                                    No existen roles registrados.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>
        </div>
    </div>

</x-roles-layout>