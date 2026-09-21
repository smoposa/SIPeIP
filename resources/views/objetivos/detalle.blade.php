<x-objetivos-layout title="Detalle OEI">

    @if(session('success'))

        <div id="alertSuccess"
             class="fixed right-5 top-5 z-50 rounded-lg bg-green-600 px-6 py-3 text-white shadow-lg">

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
     @include('objetivos.partials.barra-menu')


    <!-- Contenido -->
    <div class="min-w-0 w-full overflow-x-hidden overflow-y-auto"
         style="height: calc(100vh - 100px);">

        <div class="min-w-0 bg-white p-6 shadow-sm">

            <!-- Cabecera -->
            <div class="flex min-w-0 items-center gap-4 pb-6">

                <div class="flex h-16 w-16 flex-shrink-0 items-center justify-center
                            rounded-full bg-[#024687] text-3xl text-white">

                    <i class="bi bi-bullseye"></i>

                </div>

                <div class="min-w-0">

                    <h2 class="break-words text-xl font-semibold text-gray-800">
                        {{ $objetivo->nombre }}
                    </h2>

                    <p class="text-sm text-gray-500">
                        {{ $objetivo->codigo }}
                    </p>

                </div>

            </div>

            <!-- Información general -->
            <div class="border-b border-gray-200 bg-gray-100">

                <div class="flex items-center justify-between px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        Información general
                    </h4>

                    <a href="{{ route('objetivos.edit', $objetivo->id) }}"
                       class="text-sm text-blue-600 hover:text-blue-800">

                        Editar

                    </a>

                </div>

            </div>

            <div class="px-4 py-4">

                <div class="space-y-4">

                    <!-- Código -->
                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Código
                        </span>

                        <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                            {{ $objetivo->codigo }}
                        </span>

                    </div>

                    <!-- Plan -->
                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Plan
                        </span>

                        <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                            {{ $objetivo->plan?->codigo ?? 'No registra' }}
                            -
                            {{ $objetivo->plan?->nombre ?? 'No registra' }}
                        </span>

                    </div>

                    <!-- Objetivo PND -->
                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Objetivo PND
                        </span>

                        <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                            Objetivo {{ $objetivo->pnd?->numero ?? 'No registra' }}
                            -
                            {{ $objetivo->pnd?->nombre ?? 'No registra' }}
                        </span>

                    </div>

                    <!-- Política PND -->
                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Política PND
                        </span>

                        <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                            {{ $objetivo->politicaPnd?->codigo ?? 'No registra' }}
                            -
                            {{ $objetivo->politicaPnd?->nombre ?? 'No registra' }}
                        </span>

                    </div>

                    <!-- ODS -->
                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            ODS
                        </span>

                        <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                            {{ $objetivo->ods?->codigo ?? 'No registra' }}
                            -
                            {{ $objetivo->ods?->nombre ?? 'No registra' }}
                        </span>

                    </div>

                    <!-- Meta ODS -->
                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Meta ODS
                        </span>

                        <span class="min-w-0 flex-1 break-words text-sm text-gray-600">
                            {{ $objetivo->metaOds?->codigo ?? 'No registra' }}
                            -
                            {{ $objetivo->metaOds?->nombre ?? 'No registra' }}
                        </span>

                    </div>

                    <!-- Nombre -->
                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Nombre
                        </span>

                        <span class="min-w-0 flex-1 break-words text-sm font-medium text-[#024687]">
                            {{ $objetivo->nombre }}
                        </span>

                    </div>

                    <!-- Descripción -->
                    <div class="flex min-w-0 items-start gap-4">

                        <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                            Descripción
                        </span>

                        <span class="min-w-0 flex-1 break-words text-sm leading-relaxed text-gray-600">
                            {{ $objetivo->descripcion ?: 'No registra' }}
                        </span>

                    </div>

                </div>

            </div>

            <!-- Estado -->
            <div class="border-b border-gray-200 bg-gray-100">

                <div class="px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        Estado del objetivo
                    </h4>

                </div>

            </div>

            <div class="px-4 py-4">

                <div class="flex flex-wrap items-center gap-4">

                    <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                        Estado
                    </span>

                    @if($objetivo->estado === 'Activo')

                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                            Activo
                        </span>

                    @else

                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-700">
                            Inactivo
                        </span>

                    @endif

                    <a href="{{ route('objetivos.editarestado', $objetivo->id) }}"
                       class="text-sm text-blue-600 hover:text-blue-800 hover:underline">

                        Editar

                    </a>

                </div>

            </div>

            <!-- Auditoría -->
            <div class="border-b border-gray-200 bg-gray-100">

                <div class="px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        Auditoría
                    </h4>

                </div>

            </div>

            <div class="px-4 py-4">

                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

                    <div>

                        <p class="text-sm font-semibold text-gray-700">
                            Registrado por
                        </p>

                        <p class="mt-1 break-words text-sm text-gray-600">
                            {{ $objetivo->usuario?->name ?? 'No registra' }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm font-semibold text-gray-700">
                            Fecha de creación
                        </p>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ $objetivo->created_at?->format('d/m/Y H:i') ?? 'No registra' }}
                        </p>

                    </div>

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