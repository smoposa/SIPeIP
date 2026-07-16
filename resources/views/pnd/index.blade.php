<x-catalogos-layout title="PND">

    <!-- Encabezado -->
    <div class="mb-2">

        <h2 class="text-2xl font-semibold text-gray-800">
            Objetivos del Plan Nacional de Desarrollo (PND)
        </h2>

    </div>

    <!-- Resumen  -->
    <div class="flex items-center justify-between mb-4">

        <div>

            <p class="text-sm text-gray-500">

                {{ $pnd->count() }} registros ·

                <span class="text-green-600 font-medium">
                    {{ $pnd->where('estado','Activo')->count() }}
                </span>

                activos

            </p>

        </div>

    </div>

    <!-- Tabla -->
    <div class="overflow-y-auto" style="height: calc(100vh - 210px);">

        <div class="bg-white border border-gray-200 rounded-lg">

            <table class="min-w-full">

                <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">

                    <tr>

                        <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                            Nro
                        </th>

                        <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                            Eje
                        </th>

                        <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                            Código
                        </th>

                        <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                            Objetivo
                        </th>

                        <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                            Estado
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($pnd as $item)

                        <tr class="border-b border-gray-100 hover:bg-gray-50">

                            <td class="px-2 py-2 text-sm text-gray-600">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-2 py-2 text-sm text-gray-700">
                                {{ $item->eje }}
                            </td>

                            <td class="px-2 py-2 text-sm font-medium text-blue-700">
                                {{ $item->codigo }}
                            </td>

                            <td class="px-2 py-2 text-sm text-gray-700">
                                {{ $item->nombre }}
                            </td>

                            <td class="px-2 py-2">

                                @if($item->estado == 'Activo')

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

                                No existen registros.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-catalogos-layout>