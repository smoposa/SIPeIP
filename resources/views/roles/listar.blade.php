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
 
    <!-- Encabezado -->
    <div class="mb-2">
        <h2 class="text-2xl font-semibold text-gray-800">
            Roles registrados
        </h2>
         <!--<p class="mt-1 text-gray-500">
            Consulte, registre y administre los roles institucionales del Sistema Integral de Planificación e Inversión Pública (SIPeIP).
        </p -->
    </div>

    <!-- Resumen -->
    <div class="flex items-center justify-between mb-4">

        <div>
            <p class="text-sm text-gray-500">
                {{ $roles->count() }} registros ·
                <span class="text-green-600 font-medium">
                    {{ $roles->where('estado','Activo')->count() }}
                </span>
                activos ·
                <span class="text-red-600 font-medium">
                    {{ $roles->where('estado','Inactivo')->count() }}
                </span>
                inactivos
            </p>

        </div>

        <a href="{{ route('roles.create') }}"
        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md transition">

            <i class="bi bi-plus-lg"></i>

            Crear rol

        </a>

    </div>

    <!-- Filtros
    <div>
    ... aqui codigo de filtro 
    </div>-->

    <!-- Tabla -->
    <div class="overflow-y-auto" style="height: calc(100vh - 210px);"> <!-- Scroll vertical -->

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