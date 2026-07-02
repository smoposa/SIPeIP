<x-planes-layout title="Detalle del Plan Institucional">

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
    <div class="bg-white border-b border-gray-300 mb-0">
        <div class="flex">

            <a href="{{ route('planes.listar') }}"
                class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">
                <i class="bi bi-chevron-left"></i>
                Regresar
            </a>

            <a href="{{ route('planes.edit', $plan->id) }}"
                class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                <i class="bi bi-pencil text-blue-500 me-2"></i>
                Editar información
            </a>

            <a href="{{ route('planes.editarestado', $plan->id) }}"
                class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                <i class="bi bi-check2-circle text-blue-500 me-2"></i>
                Editar estado
            </a>

            <a href="{{ url()->current() }}"
                class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                <i class="bi bi-arrow-clockwise text-blue-500 me-2"></i>
                Actualizar
            </a>
        </div>
    </div>

    <!-- Scroll vertical -->
    <div class="overflow-y-auto" style="height: calc(100vh - 180px);">

        <!-- Información básica-->
        <div class="bg-white p-6 shadow-sm">

            <!-- Cabecera del plan -->
            <div class="flex items-center gap-4 mb-0 pb-6">
                
                <div class="w-16 h-16 rounded-full bg-[#0F766E]
                            flex items-center justify-center
                            text-white text-3xl">
                    <i class="bi bi-file-earmark-text"></i>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ $plan->nombre }}
                    </h2>
                    <p class="text-gray-500">
                        Período {{ $plan->periodo_inicio }} - {{ $plan->periodo_fin }}
                    </p>
                </div>

            </div>

            <!-- Información General -->
            <div class="bg-gray-100 border-b border-gray-200">

                <div class="flex justify-between items-center px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        Información general
                    </h4>

                    <a href="{{ route('planes.edit', $plan->id) }}"
                    class="text-sm text-blue-600 hover:text-blue-800">
                        Editar
                    </a>

                </div>

            </div>
            
            <!-- Datos -->
            <div class="px-4 py-3">
                <div class="space-y-4 mb-6">

                    <!-- Código -->
                    <div class="flex">
                        <span class="w-40 text-sm font-semibold text-gray-700">
                            Código del Plan
                        </span>
                        <span class="text-sm text-gray-600">
                            {{ $plan->codigo }}
                        </span>
                    </div>

                    <!-- Nombre -->
                    <div class="flex">
                        <span class="w-40 text-sm font-semibold text-gray-700">
                            Nombre
                        </span>
                        <span class="text-sm font-medium text-[#0F766E]">
                            {{ $plan->nombre }}
                        </span>
                    </div>

                    <!-- Descripción -->
                    <div class="flex items-start">
                        <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Descripción
                        </span>
                        <span class="text-sm text-gray-600 leading-relaxed">
                            {{ $plan->descripcion ?: 'No registra' }}
                        </span>
                    </div>

                    <!-- Período -->
                    <div class="flex">
                        <span class="w-40 text-sm font-semibold text-gray-700">
                            Período
                        </span>
                        <span class="text-sm text-gray-600">
                            {{ $plan->periodo_inicio }} - {{ $plan->periodo_fin }}
                        </span>
                    </div>

                    <!-- Fecha Inicio -->
                    <div class="flex">
                        <span class="w-40 text-sm font-semibold text-gray-700">
                            Fecha de Inicio
                        </span>
                        <span class="text-sm text-gray-600">
                            {{ \Carbon\Carbon::parse($plan->fecha_inicio)->format('d/m/Y') }}
                        </span>
                    </div>

                    <!-- Fecha Finalización -->
                    <div class="flex">
                        <span class="w-40 text-sm font-semibold text-gray-700">
                            Fecha de Finalización
                        </span>
                        <span class="text-sm text-gray-600">
                            {{ \Carbon\Carbon::parse($plan->fecha_fin)->format('d/m/Y') }}
                        </span>
                    </div>

                </div>
            </div>

            <!-- Estado -->
            <div class="bg-gray-100 border-b border-gray-200">
                <div class="px-4 py-2">
                    <h4 class="text-sm font-semibold text-gray-800">
                        Estado del Plan
                    </h4>
                </div>
            </div>

            <div class="px-4 py-2 mb-6">
                <div class="flex items-center">
                    <span class="w-40 text-sm font-semibold text-gray-700">
                        Estado
                    </span>
                    @if($plan->estado == 'Activo')
                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                            Habilitado
                        </span>
                    @else
                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">
                            Deshabilitado
                        </span>
                    @endif
                    <a href="{{ route('planes.editarestado', $plan->id) }}"
                    class="ml-10 text-sm text-blue-600 hover:text-blue-800 hover:underline">
                        Editar
                    </a>
                </div>
            </div>

            <!-- Auditoría -->
            <div class="bg-gray-100 border-b border-gray-200">
                <div class="px-4 py-2">
                    <h4 class="text-sm font-semibold text-gray-800">
                        Auditoría
                    </h4>
                </div>
            </div>

            <div class="px-4 py-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <p class="text-sm font-semibold text-gray-700">
                            Fecha de creación
                        </p>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $plan->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-700">
                            Última actualización
                        </p>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $plan->updated_at->format('d/m/Y H:i') }}
                        </p>
                    </div>

                </div>
            </div>
        </div>

    </div>

</x-planes-layout>