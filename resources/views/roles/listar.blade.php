<x-roles-layout title="Consultar Roles">

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="{{ route('roles.index') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Información General
            </a>

            <a href="{{ route('roles.create') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Crear Rol
            </a>

            
            <a href="{{ route('roles.listar') }}"
            class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Consultar Roles
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

    <!-- Tabla -->
    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">

        <table class="min-w-full">

            <thead class="bg-gray-50 border-b border-gray-200">

                <tr>
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

                        <td class="px-4 py-3 font-medium text-gray-800">
                            {{ $rol->nombre }}
                        </td>

                        <td class="px-4 py-3 text-gray-600">
                            {{ $rol->descripcion }}
                        </td>

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

                        <td class="px-4 py-3 text-center">

                            <button
                                class="text-blue-600 hover:text-blue-800 font-medium">
                                Editar
                            </button>

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

</x-roles-layout>