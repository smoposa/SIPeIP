<x-roles-layout title="Página de inicio">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestión de Roles
        </h2>
    </x-slot>

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <button
                class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Información General
            </button>

            <button
                class="px-5 py-3 text-sm font-medium text-gray-600 hover:text-black">
                Crear Rol
            </button>

            <button
                class="px-5 py-3 text-sm font-medium text-gray-600 hover:text-black">
                Consultar Roles
            </button>

        </div>

    </div>

    <div class="space-y-6">

        <!-- Bienvenida -->
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">
                Gestión de Roles
            </h2>

            <p class="mt-2 text-gray-600">
                Administre los roles institucionales del Sistema Integral de
                Planificación e Inversión Pública (SIPeIP).
            </p>
        </div>

        <!-- Tarjetas informativas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white border border-gray-200 rounded-lg p-5">
                <h3 class="text-base font-semibold text-gray-800">
                    Roles Registrados
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Total de roles creados en el sistema
                </p>

                <p class="text-4xl font-semibold text-gray-700 mt-4">
                    0
                </p>
            </div>

            <div class="bg-white border border-gray-200 rounded-lg p-5">
                <h3 class="text-base font-semibold text-gray-800">
                    Roles Activos
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Habilitados para asignación
                </p>

                <p class="text-4xl font-semibold text-gray-700 mt-4">
                    0
                </p>
            </div>

            <div class="bg-white border border-gray-200 rounded-lg p-5">
                <h3 class="text-base font-semibold text-gray-800">
                    Roles Inactivos
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Roles deshabilitados
                </p>

                <p class="text-4xl font-semibold text-gray-700 mt-4">
                    0
                </p>
                
            </div>

        </div>

    </div>

</x-roles-layout>