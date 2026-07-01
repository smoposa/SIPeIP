<x-objetivos-layout title="Nueva Meta">

    <!-- Barra principal -->
    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="{{ route('objetivos.index') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Información General
            </a>

            <a href="{{ route('objetivos.ods') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                ODS
            </a>

            <a href="{{ route('objetivos.pnd') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                PND
            </a>

            <a href="{{ route('objetivos.oei') }}"
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Objetivos Institucionales
            </a>

        </div>

    </div>

    <!-- Encabezado -->

    <div class="flex items-center justify-between mb-6">

        <div>

            <div class="flex items-center gap-3">

                <a href="{{ route('metas.index', $objetivo->id) }}"
                   class="text-gray-500 hover:text-blue-600">

                    <i class="bi bi-arrow-left text-lg"></i>

                </a>

                <div>

                    <h2 class="text-2xl font-semibold text-gray-800">

                        Nueva Meta

                    </h2>

                    <p class="text-gray-500 mt-1">

                        {{ $objetivo->codigo }} - {{ $objetivo->nombre }}

                    </p>

                </div>

            </div>

        </div>

    </div>

    @if ($errors->any())

        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">

            <ul class="list-disc list-inside text-sm text-red-600">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ route('metas.store', $objetivo->id) }}" method="POST">

        @csrf

        <div class="bg-white border border-gray-200 rounded-lg">

            <div class="px-6 py-5 border-b">

                <h3 class="text-lg font-semibold text-gray-800">

                    Información General

                </h3>

            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Código -->

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Código <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="codigo"
                        value="{{ old('codigo') }}"
                        maxlength="30"
                        required
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                </div>

                <!-- Estado -->

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Estado
                    </label>

                    <select
                        name="estado"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                        <option value="Activo" {{ old('estado') == 'Activo' ? 'selected' : '' }}>
                            Activo
                        </option>

                        <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>
                            Inactivo
                        </option>

                    </select>

                </div>

                <!-- Nombre -->

                <div class="md:col-span-2">

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nombre de la Meta <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="nombre"
                        value="{{ old('nombre') }}"
                        maxlength="255"
                        required
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                </div>

                <!-- Descripción -->

                <div class="md:col-span-2">

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Descripción
                    </label>

                    <textarea
                        name="descripcion"
                        rows="4"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('descripcion') }}</textarea>

                </div>

                <!-- Valor Meta -->

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Valor Meta
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="valor_meta"
                        value="{{ old('valor_meta') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                </div>

                <!-- Unidad de Medida -->

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Unidad de Medida
                    </label>

                    <input
                        type="text"
                        name="unidad_medida"
                        value="{{ old('unidad_medida') }}"
                        maxlength="100"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                </div>

                <!-- Fecha Inicio -->

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Fecha de Inicio
                    </label>

                    <input
                        type="date"
                        name="fecha_inicio"
                        value="{{ old('fecha_inicio') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                </div>

                <!-- Fecha Fin -->

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Fecha de Fin
                    </label>

                    <input
                        type="date"
                        name="fecha_fin"
                        value="{{ old('fecha_fin') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                </div>
                            </div>

            <!-- Botones -->

            <div class="flex justify-end gap-3 px-6 py-4 border-t bg-gray-50 rounded-b-lg">

                <a href="{{ route('metas.index', $objetivo->id) }}"
                   class="px-5 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-100">

                    Cancelar

                </a>

                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700">

                    <i class="bi bi-check-circle mr-2"></i>

                    Guardar Meta

                </button>

            </div>

        </div>

    </form>

</x-objetivos-layout>