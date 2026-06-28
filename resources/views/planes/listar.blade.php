<x-planes-layout title="Consultar Planes Institucionales">

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="{{ route('planes.index') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Información General
            </a>

            <a href="{{ route('planes.create') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Crear Plan
            </a>

            <a href="{{ route('planes.listar') }}"
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Consultar Planes
            </a>

        </div>

    </div>

    <!-- Encabezado -->

    <div class="flex justify-between items-center mb-6">

        <div>

            <h2 class="text-3xl font-semibold text-gray-800">

                Planes Institucionales

            </h2>

            <p class="mt-2 text-gray-600">

                Consulte la información de los planes registrados en el sistema.

            </p>

        </div>

        <a href="{{ route('planes.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg">

            <i class="bi bi-plus-circle me-2"></i>

            Nuevo Plan

        </a>

    </div>

    <!-- Buscador -->

    <div class="bg-white border rounded-lg p-4 mb-6">

        <form method="GET">

            <div class="flex gap-4">

                <input
                    type="text"
                    name="buscar"
                    class="flex-1 rounded-lg border-gray-300"
                    placeholder="Buscar por código o nombre del plan...">

                <button
                    class="px-5 py-2 bg-gray-800 text-white rounded-lg">

                    <i class="bi bi-search"></i>

                </button>

            </div>

        </form>

    </div>

    <!-- Tabla -->

    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">

        <table class="min-w-full">

            <thead class="bg-gray-50 border-b border-gray-200">

                <tr>

                    <th class="px-4 py-3 text-left text-sm font-semibold">
                        Código
                    </th>

                    <th class="px-4 py-3 text-left text-sm font-semibold">
                        Nombre
                    </th>

                    <th class="px-4 py-3 text-left text-sm font-semibold">
                        Tipo
                    </th>

                    <th class="px-4 py-3 text-center text-sm font-semibold">
                        Estado
                    </th>

                    <th class="px-4 py-3 text-center text-sm font-semibold">
                        Acciones
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-gray-200">
                                @forelse($planes as $plan)

                    <tr class="hover:bg-gray-50">

                        <td class="px-4 py-3 text-sm text-gray-700">

                            {{ $plan->codigo }}

                        </td>

                        <td class="px-4 py-3 text-sm font-medium">

                            <a href="{{ route('planes.detalle', $plan->id) }}"
                               class="text-blue-600 hover:text-blue-800 hover:underline">

                                {{ $plan->nombre }}

                            </a>

                        </td>

                        <td class="px-4 py-3 text-sm text-gray-700">

                            {{ $plan->tipo }}

                        </td>

                        <td class="px-4 py-3 text-center">

                            @if($plan->estado == 'Activo')

                                <span class="inline-flex px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">

                                    Activo

                                </span>

                            @else

                                <span class="inline-flex px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">

                                    Inactivo

                                </span>

                            @endif

                        </td>

                        <td class="px-4 py-3">

                            <div class="flex justify-center gap-2">

                                <a href="{{ route('planes.detalle', $plan->id) }}"
                                   class="text-blue-600 hover:text-blue-800"
                                   title="Ver">

                                    <i class="bi bi-eye-fill"></i>

                                </a>

                                <a href="{{ route('planes.edit', $plan->id) }}"
                                   class="text-amber-600 hover:text-amber-800"
                                   title="Editar">

                                    <i class="bi bi-pencil-square"></i>

                                </a>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5"
                            class="px-6 py-10 text-center text-gray-500">

                            No existen planes registrados.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>
        <!-- Paginación -->

    @if(isset($planes) && method_exists($planes, 'links'))

        <div class="mt-6">

            {{ $planes->links() }}

        </div>

    @endif

</x-planes-layout>