<x-objetivos-layout title="Crear OEI">

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

    @if ($errors->any())

        <div class="mb-4 rounded-md border border-red-300 bg-red-50 p-4">

            <h3 class="text-sm font-semibold text-red-800 mb-2">
                Se encontraron los siguientes errores:
            </h3>

            <ul class="list-disc list-inside text-sm text-red-700">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-0">

        <div class="flex">

            <a href="{{ route('objetivos.oei') }}"
               class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">

                <i class="bi bi-chevron-left"></i>

                Regresar

            </a>

        </div>

    </div>

    <!-- Información -->
    <div class="bg-white pt-4 px-6 pb-6">

        <!-- Encabezado -->
        <div class="mb-6">

            <h2 class="text-2xl font-semibold text-gray-800">
                Crear Objetivo Estratégico Institucional
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Complete la información para registrar un nuevo objetivo estratégico institucional.
            </p>

        </div>

        <!-- Scroll -->
        <div class="overflow-y-auto" style="height: calc(100vh - 270px);">

            <!-- Formulario -->
            <form method="POST"
                  action="{{ route('objetivos.store') }}">

                @csrf

                <input type="hidden"
                       name="tipo"
                       value="OEI">

                <div class="space-y-4">

                    <!-- Institución -->
                    <div class="flex items-center">

                        <label class="w-40 flex-shrink-0 text-sm font-medium text-gray-700">
                            Institución <span class="text-red-500">*</span>
                        </label>

                        <div class="flex-1">

                            <select
                                name="entidad_id"
                                required
                                class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm focus:ring-blue-500 focus:border-blue-500">

                                <option value="">
                                    Seleccione
                                </option>

                                @foreach($entidades as $entidad)

                                    <option value="{{ $entidad->id }}"
                                        {{ old('entidad_id') == $entidad->id ? 'selected' : '' }}>

                                        {{ $entidad->nombre }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <!-- Plan Institucional -->
                    <div class="flex items-center">

                        <label class="w-40 flex-shrink-0 text-sm font-medium text-gray-700">
                            Plan <span class="text-red-500">*</span>
                        </label>

                        <div class="flex-1">

                            <select
                                name="plan_id"
                                required
                                class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm focus:ring-blue-500 focus:border-blue-500">

                                <option value="">
                                    Seleccione
                                </option>

                                @foreach($planes as $plan)

                                    <option value="{{ $plan->id }}"
                                        {{ old('plan_id') == $plan->id ? 'selected' : '' }}>

                                        {{ $plan->nombre }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>
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
                                value="{{ old('codigo') }}"
                                required
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
                                value="{{ old('nombre') }}"
                                required
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
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">{{ old('descripcion') }}</textarea>

                        </div>

                    </div>

                    <!-- Fecha de inicio -->
                    <div class="flex items-center">

                        <label class="w-40 flex-shrink-0 text-sm font-medium text-gray-700">
                            Fecha inicio
                        </label>

                        <div class="flex-1">

                            <input
                                type="date"
                                name="fecha_inicio"
                                value="{{ old('fecha_inicio') }}"
                                class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm focus:ring-blue-500 focus:border-blue-500">

                        </div>

                    </div>

                    <!-- Fecha fin -->
                    <div class="flex items-center">

                        <label class="w-40 flex-shrink-0 text-sm font-medium text-gray-700">
                            Fecha fin
                        </label>

                        <div class="flex-1">

                            <input
                                type="date"
                                name="fecha_fin"
                                value="{{ old('fecha_fin') }}"
                                class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm focus:ring-blue-500 focus:border-blue-500">

                        </div>

                    </div>

                    <!-- Estado -->
                    <div class="flex items-center">

                        <label class="w-40 flex-shrink-0 text-sm font-medium text-gray-700">
                            Estado <span class="text-red-500">*</span>
                        </label>

                        <div class="flex-1">

                            <select
                                name="estado"
                                required
                                class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm focus:ring-blue-500 focus:border-blue-500">

                                <option value="Activo"
                                    {{ old('estado', 'Activo') == 'Activo' ? 'selected' : '' }}>
                                    Activo
                                </option>

                                <option value="Inactivo"
                                    {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>
                                    Inactivo
                                </option>

                            </select>

                        </div>

                    </div>
                                        <!-- Botones -->
                    <div class="flex justify-end gap-3 mt-6">

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">

                            Guardar

                        </button>

                        <a href="{{ route('objetivos.oei') }}"
                           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">

                            Cancelar

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

</x-objetivos-layout>