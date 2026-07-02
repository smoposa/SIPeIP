<x-roles-layout title="Página de inicio">

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">
            <a href="{{ route('roles.index') }}"
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Inicio
            </a>
        </div>
    </div>
     
    <!-- Marco general del contenido -->
    <div class="space-y-6">

        <!-- Encabezado -->
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">
                Información general
            </h2>

            <p class="mt-2 text-gray-600">
                Administre los roles institucionales del Sistema Integral de Planificación e Inversión Pública (SIPeIP).
            </p>

        </div>

        <!-- Scroll vertical -->
        <div class="overflow-y-auto" style="height: calc(100vh - 280px);">

            <!-- Tarjetas Indicadores -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Roles Registrados -->
                <div class="bg-white border border-gray-200 rounded-lg p-5">
                    <h3 class="text-base font-semibold text-gray-800">
                        Roles Registrados
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Total de roles creados en el sistema
                    </p>

                    <p class="text-4xl font-semibold text-gray-700 mt-4">
                        {{ $totalRoles }}
                    </p>
                </div>

                <!-- Roles Activos -->
                <div class="bg-white border border-gray-200 rounded-lg p-5">
                    <h3 class="text-base font-semibold text-gray-800">
                        Roles Activos
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Habilitados para asignación
                    </p>

                    <p class="text-4xl font-semibold text-gray-700 mt-4">
                        {{ $rolesActivos }}
                    </p>
                </div>

                <!-- Roles Inactivos -->
                <div class="bg-white border border-gray-200 rounded-lg p-5">
                    <h3 class="text-base font-semibold text-gray-800">
                        Roles Inactivos
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Roles deshabilitados
                    </p>

                    <p class="text-4xl font-semibold text-gray-700 mt-4">
                        {{ $rolesInactivos }}
                    </p>
                </div>

            </div>

        </div>

    </div>

</x-roles-layout>