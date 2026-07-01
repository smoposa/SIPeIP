<x-objetivos-layout title="Detalle del Indicador">

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

    <div class="flex items-start justify-between mb-6">

        <div>

            <div class="flex items-center gap-3">

                <a href="{{ route('indicadores.index', $indicador->meta_id) }}"
                   class="text-gray-500 hover:text-blue-600">

                    <i class="bi bi-arrow-left text-lg"></i>

                </a>

                <div>

                    <h2 class="text-2xl font-semibold text-gray-800">

                        {{ $indicador->nombre }}

                    </h2>

                    <p class="text-gray-500 mt-1">

                        {{ $indicador->codigo }}

                    </p>

                </div>

            </div>

        </div>

        <a href="{{ route('indicadores.edit', $indicador->id) }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">

            <i class="bi bi-pencil-square mr-2"></i>

            Editar Indicador

        </a>

    </div>

    <!-- Tarjeta -->

    <div class="bg-white border border-gray-200 rounded-lg mb-6">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 p-6">

            <div>

                <p class="text-xs uppercase text-gray-500">

                    Meta

                </p>

                <p class="mt-1 font-medium text-gray-800">

                    {{ $indicador->meta->codigo }}

                </p>

            </div>

            <div>

                <p class="text-xs uppercase text-gray-500">

                    Valor Actual

                </p>

                <p class="mt-1 font-medium text-gray-800">

                    {{ $indicador->valor_actual }}

                    {{ $indicador->unidad_medida }}

                </p>

            </div>

            <div>

                <p class="text-xs uppercase text-gray-500">

                    Frecuencia

                </p>

                <p class="mt-1 font-medium text-gray-800">

                    {{ $indicador->frecuencia ?? '-' }}

                </p>

            </div>

            <div>

                <p class="text-xs uppercase text-gray-500">

                    Estado

                </p>

                @if($indicador->estado == 'Activo')

                    <span class="inline-flex mt-1 px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                        Activo

                    </span>

                @else

                    <span class="inline-flex mt-1 px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">

                        Inactivo

                    </span>

                @endif

            </div>

        </div>

    </div>

    <!-- Información General -->

    <div class="bg-white border border-gray-200 rounded-lg">

        <div class="px-6 py-4 border-b border-gray-200">

            <h3 class="text-lg font-semibold text-gray-800">

                Información General

            </h3>

            <p class="text-sm text-gray-500 mt-1">

                Información principal del indicador.

            </p>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                        <!-- Código -->

            <div>

                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">
                    Código
                </label>

                <p class="text-gray-800 font-medium">

                    {{ $indicador->codigo }}

                </p>

            </div>

            <!-- Estado -->

            <div>

                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">
                    Estado
                </label>

                <p class="text-gray-800 font-medium">

                    {{ $indicador->estado }}

                </p>

            </div>

            <!-- Nombre -->

            <div class="md:col-span-2">

                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">
                    Nombre del Indicador
                </label>

                <p class="text-gray-800">

                    {{ $indicador->nombre }}

                </p>

            </div>

            <!-- Descripción -->

            <div class="md:col-span-2">

                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">
                    Descripción
                </label>

                <p class="text-gray-700 leading-relaxed">

                    {{ $indicador->descripcion ?: 'No se ha registrado una descripción para este indicador.' }}

                </p>

            </div>

            <!-- Fórmula -->

            <div class="md:col-span-2">

                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">
                    Fórmula
                </label>

                <p class="text-gray-800">

                    {{ $indicador->formula ?: '-' }}

                </p>

            </div>

            <!-- Línea Base -->

            <div>

                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">
                    Línea Base
                </label>

                <p class="text-gray-800">

                    {{ $indicador->linea_base ?? '-' }}

                </p>

            </div>

            <!-- Meta -->

            <div>

                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">
                    Meta
                </label>

                <p class="text-gray-800">

                    {{ $indicador->meta ?? '-' }}

                </p>

            </div>

            <!-- Valor Actual -->

            <div>

                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">
                    Valor Actual
                </label>

                <p class="text-gray-800">

                    {{ $indicador->valor_actual ?? '-' }}

                </p>

            </div>

            <!-- Unidad de Medida -->

            <div>

                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">
                    Unidad de Medida
                </label>

                <p class="text-gray-800">

                    {{ $indicador->unidad_medida ?? '-' }}

                </p>

            </div>

            <!-- Frecuencia -->

            <div>

                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">
                    Frecuencia
                </label>

                <p class="text-gray-800">

                    {{ $indicador->frecuencia ?? '-' }}

                </p>

            </div>

            <!-- Meta Asociada -->

            <div class="md:col-span-2">

                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">
                    Meta Asociada
                </label>

                <p class="text-gray-800">

                    {{ $indicador->meta->codigo }} - {{ $indicador->meta->nombre }}

                </p>

            </div>
                        <!-- Fecha de Registro -->

            <div>

                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">
                    Fecha de Registro
                </label>

                <p class="text-gray-800">

                    {{ $indicador->created_at->format('d/m/Y H:i') }}

                </p>

            </div>

            <!-- Última Actualización -->

            <div>

                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">
                    Última Actualización
                </label>

                <p class="text-gray-800">

                    {{ $indicador->updated_at->format('d/m/Y H:i') }}

                </p>

            </div>

        </div>

        <!-- Pie -->

        <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-200 bg-gray-50 rounded-b-lg">

            <a href="{{ route('indicadores.index', $indicador->meta_id) }}"
               class="px-5 py-2.5 border border-gray-300 rounded-lg bg-white text-gray-700 hover:bg-gray-100">

                Volver

            </a>

            <a href="{{ route('indicadores.edit', $indicador->id) }}"
               class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">

                <i class="bi bi-pencil-square mr-2"></i>

                Editar Indicador

            </a>

        </div>

    </div>

</x-objetivos-layout>