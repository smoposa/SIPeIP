<x-entidades-layout title="Página de inicio">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestión de Entidades
        </h2>
    </x-slot>

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="{{ route('entidades.index') }}"
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Inicio
            </a>

            <a href="{{ route('entidades.create') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Crear entidad
            </a>

            <a href="{{ route('entidades.listar') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Consultar entidades
            </a>

        </div>
    </div>

    <div class="space-y-6">

        <!-- Encabezado -->
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">
                Información general
            </h2>

            <p class="mt-2 text-gray-600">
                Administre las entidades públicas registradas en el Sistema Integral de Planificación e Inversión Pública (SIPeIP).
            </p>

        </div>

        <!-- Tarjetas Indicadores -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Registrados -->
            <div class="bg-white border border-gray-200 rounded-lg p-5">
                <h3 class="text-base font-semibold text-gray-800">
                    Entidades Registradas
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Total de entidades registradas
                </p>

                <p class="text-4xl font-semibold text-gray-700 mt-4">
                    {{ $totalEntidades }}
                </p>
            </div>

            <!-- Activas -->
            <div class="bg-white border border-gray-200 rounded-lg p-5">
                <h3 class="text-base font-semibold text-gray-800">
                    Entidades Activas
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Habilitadas en el sistema
                </p>

                <p class="text-4xl font-semibold text-gray-700 mt-4">
                    {{ $entidadesActivas }}
                </p>
            </div>

            <!-- Inactivas -->
            <div class="bg-white border border-gray-200 rounded-lg p-5">
                <h3 class="text-base font-semibold text-gray-800">
                    Entidades Inactivas
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Entidades deshabilitadas
                </p>

                <p class="text-4xl font-semibold text-gray-700 mt-4">
                    {{ $entidadesInactivas }}
                </p>
            </div>

        </div>
    </div>

</x-entidades-layout>