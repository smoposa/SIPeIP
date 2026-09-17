<x-objetivos-layout title="Editar Estado de la Meta">

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300">

        <div class="flex">

            <a href="{{ route('metas.detalle', $meta->id) }}"
               class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">

                <i class="bi bi-chevron-left"></i>
                Regresar

            </a>

        </div>

    </div>

    <!-- Scroll vertical -->
    <div class="overflow-y-auto" style="height: calc(100vh - 180px);">

        <!-- Encabezado -->
        <div class="p-6">

            <h2 class="text-2xl font-semibold text-gray-800">
                Editar estado administrativo
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Habilite o deshabilite la meta institucional dentro del sistema.
            </p>

        </div>

        <!-- Formulario -->
        <div class="bg-white p-6">

            <!-- Validaciones -->
            @if($errors->any())

                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">

                    <ul class="list-disc list-inside text-sm text-red-700">

                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif

            <!-- Información actual -->
            <div class="mb-8">

                <div class="flex items-center mb-4">

                    <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                        Meta
                    </span>

                    <span class="min-w-0 break-words text-sm text-gray-600">
                        {{ $meta->nombre }}
                    </span>

                </div>

                <div class="flex items-center mb-4">

                    <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                        Código
                    </span>

                    <span class="text-sm text-gray-600">
                        {{ $meta->codigo }}
                    </span>

                </div>

                <div class="flex items-center">

                    <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                        Objetivo estratégico
                    </span>

                    <span class="min-w-0 break-words text-sm text-gray-600">

                        {{ $meta->objetivo?->codigo }}
                        -
                        {{ $meta->objetivo?->nombre }}

                    </span>

                </div>

            </div>

            <form method="POST"
                  action="{{ route('metas.actualizarestado', $meta->id) }}">

                @csrf
                @method('PUT')

                <div class="flex items-center gap-12">

                    <label for="estado"
                           class="w-32 text-sm font-medium text-gray-700">
                        Meta habilitada
                    </label>

                    <input type="hidden"
                           name="estado"
                           value="0">

                    <input type="checkbox"
                           id="estado"
                           name="estado"
                           value="1"
                           {{ old(
                                'estado',
                                $meta->estado === 'Activo' ? '1' : '0'
                           ) == '1' ? 'checked' : '' }}
                           class="w-5 h-5">

                </div>

                <p class="mt-3 ml-44 text-xs text-gray-500">
                    Este cambio afecta únicamente la disponibilidad administrativa de la meta.
                </p>

                <!-- Botones -->
                <div class="flex gap-3 mt-10">

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">

                        Guardar

                    </button>

                    <a href="{{ route('metas.detalle', $meta->id) }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">

                        Cancelar

                    </a>

                </div>

            </form>

        </div>

    </div>

</x-objetivos-layout>