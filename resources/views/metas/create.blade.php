<x-objetivos-layout title="Crear Meta">

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

    <!-- Barra -->
    <div class="bg-white border-b border-gray-300 mb-0">

        <div class="flex">

            <a href="{{ route('metas.listar') }}"
               class="py-2 text-sm font-medium text-blue-600 hover:text-blue-800 mr-8">

                <i class="bi bi-chevron-left"></i>

                Regresar

            </a>

        </div>

    </div>

    <!-- Contenido -->
    <div class="bg-white pt-4 px-6 pb-6">

        <div class="mb-6">

            <h2 class="text-2xl font-semibold text-gray-800">
                Crear Meta
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Complete la información para registrar una nueva meta institucional.
            </p>

        </div>

        <div class="overflow-y-auto" style="height: calc(100vh - 270px);">

            <form method="POST"
                  action="{{ route('metas.store') }}">

                @csrf

                <div class="space-y-6">

                    <!-- ===================== -->
                    <!-- Información General -->
                    <!-- ===================== -->

                    <div>

                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">

                            Información General

                        </h3>

                        <!-- Objetivo -->

                        <div class="flex items-center mb-4">

                            <label class="w-44 flex-shrink-0 text-sm font-medium text-gray-700">

                                Objetivo Estratégico
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="flex-1">

                                <select
                                    name="objetivo_id"
                                    required
                                    class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm">

                                    <option value="">

                                        Seleccione...

                                    </option>

                                    @foreach($objetivos as $objetivo)

                                        <option
                                            value="{{ $objetivo->id }}"
                                            {{ old('objetivo_id') == $objetivo->id ? 'selected' : '' }}>

                                            {{ $objetivo->codigo }}
                                            -
                                            {{ $objetivo->nombre }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <!-- Código -->

                        <div class="flex items-center mb-4">

                            <label class="w-44 flex-shrink-0 text-sm font-medium text-gray-700">

                                Código

                            </label>

                            <div class="flex-1">

                            <input
                                type="text"
                                value="{{ $codigo }}"
                                disabled
                                class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm bg-gray-100 text-gray-700 font-medium">

                            </div>

                        </div>

                        <!-- Nombre -->

                        <div class="flex items-center mb-4">

                            <label class="w-44 flex-shrink-0 text-sm font-medium text-gray-700">

                                Nombre
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="flex-1">

                                <input
                                    type="text"
                                    name="nombre"
                                    maxlength="255"
                                    value="{{ old('nombre') }}"
                                    required
                                    class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm">

                            </div>

                        </div>

                        <!-- Descripción -->

                        <div class="flex items-start">

                            <label class="w-44 flex-shrink-0 pt-2 text-sm font-medium text-gray-700">

                                Descripción

                            </label>

                            <div class="flex-1">

                                <textarea
                                    name="descripcion"
                                    rows="4"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">{{ old('descripcion') }}</textarea>

                            </div>

                        </div>

                    </div>

                    <!-- ===================== -->
                    <!-- Valores -->
                    <!-- ===================== -->

                    <div>

                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">

                            Valores

                        </h3>

                        <!-- Línea base -->

                        <div class="flex items-center mb-4">

                            <label class="w-44 flex-shrink-0 text-sm font-medium text-gray-700">

                                Línea base
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="flex-1">

                                <input
                                    type="number"
                                    step="0.01"
                                    name="linea_base"
                                    value="{{ old('linea_base') }}"
                                    required
                                    class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm">

                            </div>

                        </div>

                        <!-- Valor meta -->

                        <div class="flex items-center mb-4">

                            <label class="w-44 flex-shrink-0 text-sm font-medium text-gray-700">

                                Valor meta
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="flex-1">

                                <input
                                    type="number"
                                    step="0.01"
                                    name="valor_meta"
                                    value="{{ old('valor_meta') }}"
                                    required
                                    class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm">

                            </div>

                        </div>

                        <!-- Unidad de medida -->

                        <div class="flex items-center">

                            <label class="w-44 flex-shrink-0 text-sm font-medium text-gray-700">

                                Unidad de medida
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="flex-1">

                                <select
                                    name="unidad_medida"
                                    required
                                    class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm">

                                    <option value="">Seleccione...</option>

                                    <option value="Porcentaje">Porcentaje</option>

                                    <option value="Número">Número</option>

                                    <option value="Cantidad">Cantidad</option>

                                    <option value="Personas">Personas</option>

                                    <option value="Instituciones">Instituciones</option>

                                    <option value="Kilómetros">Kilómetros</option>

                                    <option value="Hectáreas">Hectáreas</option>

                                    <option value="Dólares">Dólares</option>

                                </select>

                            </div>

                        </div>

                    </div>
                                        <!-- ===================== -->
                    <!-- Planificación -->
                    <!-- ===================== -->

                    <div>

                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">

                            Planificación

                        </h3>

                        <!-- Período inicio -->

                        <div class="flex items-center mb-4">

                            <label class="w-44 flex-shrink-0 text-sm font-medium text-gray-700">

                                Período inicio
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="flex-1">

                                <input
                                    type="number"
                                    name="periodo_inicio"
                                    min="2020"
                                    max="2100"
                                    value="{{ old('periodo_inicio') }}"
                                    required
                                    class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm">

                            </div>

                        </div>

                        <!-- Período fin -->

                        <div class="flex items-center mb-4">

                            <label class="w-44 flex-shrink-0 text-sm font-medium text-gray-700">

                                Período fin
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="flex-1">

                                <input
                                    type="number"
                                    name="periodo_fin"
                                    min="2020"
                                    max="2100"
                                    value="{{ old('periodo_fin') }}"
                                    required
                                    class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm">

                            </div>

                        </div>

                        <!-- Responsable -->

                        <div class="flex items-center mb-4">

                            <label class="w-44 flex-shrink-0 text-sm font-medium text-gray-700">

                                Responsable
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="flex-1">

                                <select
                                    name="responsable_id"
                                    required
                                    class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm">

                                    <option value="">

                                        Seleccione...

                                    </option>

                                        @foreach($responsables as $responsable)

                                            <option
                                                value="{{ $responsable->id }}"
                                                {{ old('responsable_id') == $responsable->id ? 'selected' : '' }}>

                                                {{ $responsable->nombres }}
                                                {{ $responsable->apellidos }}
                                                - {{ $responsable->cargo }}

                                            </option>

                                        @endforeach
                                </select>

                            </div>

                        </div>

                        <!-- Estado -->

                        <div class="flex items-center">

                            <label class="w-44 flex-shrink-0 text-sm font-medium text-gray-700">

                                Estado
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="flex-1">

                                <select
                                    name="estado"
                                    required
                                    class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm">

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

                    </div>

                    <!-- Botones -->

                    <div class="flex justify-end gap-3 pt-6 border-t">

                        <a href="{{ route('metas.listar') }}"
                           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">

                            Cancelar

                        </a>

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">

                            Guardar Meta

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</x-objetivos-layout>