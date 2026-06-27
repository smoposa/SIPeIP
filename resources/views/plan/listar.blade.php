<x-plan-layout title="Consultar planes">

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

    <div class="space-y-6">

        <!-- Encabezado -->
        <div>

            <h2 class="text-2xl font-semibold text-gray-900">
                Consultar planes
            </h2>

            <p class="mt-2 text-sm text-gray-600">
                Consulte los planes institucionales registrados en el sistema.
            </p>

        </div>


        <!-- Tabla -->
        <div class="overflow-y-auto" style="height: calc(100vh - 210px);">

            <div class="bg-white border border-gray-200 rounded-lg">
                <table class="min-w-full">
                    <thead class="bg-gray-50 border-b border-gray-200 sticky top-0">
                        <tr>
                            <th class="px-4 py-3 text-left">Código</th>
                            <th class="px-4 py-3 text-left">Nombre</th>
                            <th class="px-4 py-3 text-left">Entidad</th>
                            <th class="px-4 py-3 text-center">Período</th>
                            <th class="px-4 py-3 text-center">Estado</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($planes as $plan)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    {{ $plan->codigo }}
                                </td>

                                <td class="px-4 py-3 text-sm font-medium">

                                    <a href="{{ route('planes.detalle', $plan->id) }}"
                                        class="text-blue-600 hover:text-blue-800 hover:underline">

                                        {{ $plan->nombre }}

                                    </a>

                                </td>

                                <td class="px-4 py-3 text-sm text-gray-600">
                                    {{ $plan->entidad->nombre }}
                                </td>

                                <td class="px-4 py-3 text-sm text-gray-600">
                                    {{ $plan->periodo_inicio }} - {{ $plan->periodo_fin }}
                                </td>

                                <td class="px-4 py-3 text-sm text-gray-600 text-center">
                                    {{ $plan->estado }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7"
                                    class="text-center py-10 text-gray-500">

                                    No existen planes registrados.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-plan-layout>