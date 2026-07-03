<x-objetivos-layout title="Detalle PND">

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

            <a href="{{ route('objetivos.pnd') }}"
               class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">

                <i class="bi bi-chevron-left"></i>

                Regresar

            </a>

            <a href="{{ route('objetivos.edit', $objetivo->id) }}"
               class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                <i class="bi bi-pencil text-blue-500 me-2"></i>

                Editar información

            </a>

            <a href="{{ url()->current() }}"
               class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                <i class="bi bi-arrow-clockwise text-blue-500 me-2"></i>

                Actualizar

            </a>

        </div>

    </div>

    <!-- Scroll -->
    <div class="overflow-y-auto" style="height: calc(100vh - 180px);">

        <div class="bg-white p-6 shadow-sm">

            <!-- Cabecera -->
            <div class="flex items-center gap-4 mb-0 pb-6">

                <div class="w-16 h-16 rounded-full bg-[#7C3AED]
                            flex items-center justify-center
                            text-white text-3xl">

                    <i class="bi bi-flag"></i>

                </div>

                <div>

                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ $objetivo->nombre }}
                    </h2>

                    <p class="text-gray-500">
                        {{ $objetivo->codigo }}
                    </p>

                </div>

            </div>

            <!-- Información General -->
            <div class="bg-gray-100 border-b border-gray-200">

                <div class="flex justify-between items-center px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        Información general
                    </h4>

                    <a href="{{ route('objetivos.edit', $objetivo->id) }}"
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
                            Código
                        </span>

                        <span class="text-sm text-gray-600">
                            {{ $objetivo->codigo }}
                        </span>

                    </div>

                    <!-- Eje -->
                    <div class="flex">

                        <span class="w-40 text-sm font-semibold text-gray-700">
                            Eje
                        </span>

                        <span class="text-sm text-gray-600">
                            {{ $objetivo->eje }}
                        </span>

                    </div>

                    <!-- Nombre -->
                    <div class="flex">

                        <span class="w-40 text-sm font-semibold text-gray-700">
                            Nombre
                        </span>

                        <span class="text-sm font-medium text-[#024687]">
                            {{ $objetivo->nombre }}
                        </span>

                    </div>

                    <!-- Descripción -->
                    <div class="flex items-start">

                        <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Descripción
                        </span>

                        <span class="text-sm text-gray-600 leading-relaxed">
                            {{ $objetivo->descripcion ?: 'No registra' }}
                        </span>

                    </div>

                </div>

            </div>
                        <!-- Estado -->
            <div class="bg-gray-100 border-b border-gray-200">

                <div class="px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        Estado del objetivo
                    </h4>

                </div>

            </div>

            <div class="px-4 py-2">

                <div class="flex items-center mb-4">

                    <div class="flex items-center">

                        <span class="w-40 text-sm font-semibold text-gray-700">
                            Estado
                        </span>

                        @if($objetivo->estado == 'Activo')

                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                Habilitado
                            </span>

                        @else

                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                Deshabilitado
                            </span>

                        @endif

                        <a href="{{ route('objetivos.editarestado', $objetivo->id) }}"
                           class="ml-10 text-sm text-blue-600 hover:text-blue-800 hover:underline">

                            Editar

                        </a>

                    </div>

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

                    <!-- Fecha de creación -->
                    <div>

                        <p class="text-sm font-semibold text-gray-700">
                            Fecha de creación
                        </p>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ $objetivo->created_at?->format('d/m/Y H:i') ?? 'No registra' }}
                        </p>

                    </div>

                    <!-- Última actualización -->
                    <div>

                        <p class="text-sm font-semibold text-gray-700">
                            Última actualización
                        </p>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ $objetivo->updated_at?->format('d/m/Y H:i') ?? 'No registra' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-objetivos-layout>