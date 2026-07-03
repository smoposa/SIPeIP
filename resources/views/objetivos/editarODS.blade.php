<x-objetivos-layout title="Editar ODS">

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

            <a href="{{ route('objetivos.detalle', $objetivo->id) }}"
               class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">

                <i class="bi bi-chevron-left"></i>

                Regresar

            </a>

        </div>

    </div>

    <!-- Información -->
    <div class="bg-white p-6 shadow-sm">

        <!-- Encabezado -->
        <div class="mb-6">

            <h2 class="text-2xl font-semibold text-gray-800">
                Actualizar informacion de ODS
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Modifique la información del Objetivo de Desarrollo Sostenible.
            </p>

        </div>

        <!-- Validaciones -->
        @if ($errors->any())

            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">

                <ul class="list-disc list-inside text-sm text-red-700">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <!-- Scroll -->
        <div class="overflow-y-auto" style="height: calc(100vh - 300px);">

            <!-- Formulario -->
            <form method="POST"
                  action="{{ route('objetivos.update', $objetivo->id) }}">


                    @csrf
                    @method('PUT')

                    <input type="hidden"
                        name="tipo"
                        value="ODS">

                    <div class="space-y-4">

                    <!-- Código -->
                    <div class="flex items-center">

                        <label class="w-40 flex-shrink-0 text-sm font-medium text-gray-700">
                            Código <span class="text-red-500">*</span>
                        </label>

                        <div class="flex-1">

                            <input
                                type="text"
                                name="codigo"
                                maxlength="30"
                                required
                                value="{{ old('codigo', $objetivo->codigo) }}"
                                class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm focus:ring-blue-500 focus:border-blue-500">

                        </div>

                    </div>

                    <!-- Nombre -->
                    <div class="flex items-center">

                        <label class="w-40 flex-shrink-0 text-sm font-medium text-gray-700">
                            Nombre <span class="text-red-500">*</span>
                        </label>

                        <div class="flex-1">

                            <input
                                type="text"
                                name="nombre"
                                maxlength="255"
                                required
                                value="{{ old('nombre', $objetivo->nombre) }}"
                                class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm focus:ring-blue-500 focus:border-blue-500">

                        </div>

                    </div>

                    <!-- Descripción -->
                    <div class="flex items-start">

                        <label class="w-40 flex-shrink-0 pt-2 text-sm font-medium text-gray-700">
                            Descripción
                        </label>

                        <div class="flex-1">

                            <textarea
                                name="descripcion"
                                rows="4"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">{{ old('descripcion', $objetivo->descripcion) }}</textarea>

                        </div>

                    </div>

                    <!-- Botones -->
                    <div class="flex justify-end gap-3 mt-6">

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">

                            Actualizar 

                        </button>

                        <a href="{{ route('objetivos.detalle', $objetivo->id) }}"
                           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">

                            Cancelar

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

</x-objetivos-layout>
