<x-planes-layout title="Consultar Planes Institucionales">

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
            Planes Institucionales
        </h2>
        <!--
        <p class="mt-1 text-gray-500">
            Consulte, registre y administre los planes institucionales del Sistema Integral de Planificación e Inversión Pública (SIPeIP).
        </p>
        -->

    </div>

    <!-- Resumen -->
    <div class="flex items-center justify-between mb-4">

        <div>
            <p class="text-sm text-gray-500">
                {{ $planes->count() }} registros ·
                <span class="text-green-600 font-medium">
                    {{ $planes->where('estado','Activo')->count() }}
                </span>
                activos ·
                <span class="text-red-600 font-medium">
                    {{ $planes->where('estado','Inactivo')->count() }}
                </span>
                inactivos
            </p>

        </div>

        <a href="{{ route('planes.create') }}"
            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md transition">
            <i class="bi bi-plus-lg"></i>
            Crear plan
        </a>

    </div>

    <!-- Filtros
    <div>
    ... aqui codigo de filtro 
    </div>-->


    <!-- Tabla -->
    <div class="overflow-y-auto" style="height: calc(100vh - 280px);"> <!-- Scroll vertical -->
    
        <div class="bg-white border border-gray-200 rounded-lg">

            <table class="min-w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        
                        <th class="px-2 py-2 text-left text-sm font-semibold text-gray-700">
                            Nro
                        </th>

                        <th class="px-2 py-2 text-left text-sm font-semibold">
                            Código
                        </th>

                        <th class="px-2 py-2 text-left text-sm font-semibold">
                            Nombre
                        </th>

                        <th class="px-2 py-2 text-left text-sm font-semibold">
                            Período
                        </th>

                        <th class="px-2 py-2 text-center text-sm font-semibold">
                            Estado
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse($planes as $plan)
                        <tr class="hover:bg-gray-50">
                        
                            <td class="px-2 py-2 text-sm text-gray-600">
                                {{ $loop->iteration }}
                            </td>                        
                        
                            <td class="px-2 py-2 text-sm text-gray-700">
                                {{ $plan->codigo }}
                            </td>

                            <td class="px-2 py-2 text-sm font-medium">
                                <a href="{{ route('planes.detalle', $plan->id) }}"
                                class="text-blue-600 hover:text-blue-800 hover:underline">
                                    {{ $plan->nombre }}
                                </a>
                            </td>
                            <td class="px-2 py-2 text-sm text-gray-700">
                                {{ $plan->periodo_inicio }} - {{ $plan->periodo_fin }}
                            </td>

                            <td class="px-2 py-2 text-center">
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
    </div>

    <!-- Paginación -->

    @if(isset($planes) && method_exists($planes, 'links'))

    <div class="mt-6">
        {{ $planes->links() }}
    </div>

    @endif

</x-planes-layout>