<x-objetivos-layout title="Detalle de la Meta">

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

                <a href="{{ route('metas.index', $meta->objetivo_id) }}"
                   class="text-gray-500 hover:text-blue-600">

                    <i class="bi bi-arrow-left text-lg"></i>

                </a>

                <div>

                    <h2 class="text-2xl font-semibold text-gray-800">

                        {{ $meta->nombre }}

                    </h2>

                    <p class="text-gray-500 mt-1">

                        {{ $meta->codigo }}

                    </p>

                </div>

            </div>

        </div>

        <a href="{{ route('metas.edit', $meta->id) }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">

            <i class="bi bi-pencil-square mr-2"></i>

            Editar Meta

        </a>

    </div>

    <!-- Tarjeta -->

    <div class="bg-white border border-gray-200 rounded-lg mb-6">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 p-6">

            <div>

                <p class="text-xs uppercase text-gray-500">

                    Objetivo

                </p>

                <p class="mt-1 font-medium text-gray-800">

                    {{ $meta->objetivo->codigo }}

                </p>

            </div>

            <div>

                <p class="text-xs uppercase text-gray-500">

                    Valor Meta

                </p>

                <p class="mt-1 font-medium text-gray-800">

                    {{ $meta->valor_meta }}

                    {{ $meta->unidad_medida }}

                </p>

            </div>

            <div>

                <p class="text-xs uppercase text-gray-500">

                    Período

                </p>

                <p class="mt-1 font-medium text-gray-800">

                    {{ optional($meta->fecha_inicio)->format('d/m/Y') }}
                    -
                    {{ optional($meta->fecha_fin)->format('d/m/Y') }}

                </p>

            </div>

            <div>

                <p class="text-xs uppercase text-gray-500">

                    Estado

                </p>

                @if($meta->estado=='Activo')

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

    <!-- Barra de navegación -->

    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">
                        <a href="#"
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Información General
            </a>

            <a href="{{ route('metas.indicadores', $meta->id) }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Indicadores
            </a>

            <a href="{{ route('metas.seguimiento', $meta->id) }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Seguimiento
            </a>

            <a href="{{ route('metas.presupuesto', $meta->id) }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Presupuesto
            </a>

            <a href="{{ route('indicadores.index', $meta->id) }}"
                class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Indicadores
            </a>

            <a href="{{ route('metas.historial', $meta->id) }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Historial
            </a>

        </div>

    </div>

    <!-- Información General -->

    <div class="bg-white border border-gray-200 rounded-lg">

        <div class="px-6 py-4 border-b border-gray-200">

            <h3 class="text-lg font-semibold text-gray-800">

                Información General

            </h3>

            <p class="text-sm text-gray-500 mt-1">

                Información principal de la meta institucional.

            </p>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">

            <!-- Código -->

            <div>

                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">
                    Código
                </label>

                <p class="text-gray-800 font-medium">

                    {{ $meta->codigo }}

                </p>

            </div>

            <!-- Estado -->

            <div>

                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">
                    Estado
                </label>

                <p class="text-gray-800 font-medium">

                    {{ $meta->estado }}

                </p>

            </div>

            <!-- Nombre -->

            <div class="md:col-span-2">

                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">
                    Nombre de la Meta
                </label>

                <p class="text-gray-800">

                    {{ $meta->nombre }}

                </p>

            </div>

            <!-- Descripción -->

            <div class="md:col-span-2">

                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">
                    Descripción
                </label>

                <p class="text-gray-700 leading-relaxed">

                    {{ $meta->descripcion ?: 'No se ha registrado una descripción para esta meta.' }}

                </p>

            </div>
                        <!-- Valor Meta -->

            <div>

                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">
                    Valor Meta
                </label>

                <p class="text-gray-800">

                    {{ $meta->valor_meta ?? '-' }}

                </p>

            </div>

            <!-- Unidad de Medida -->

            <div>

                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">
                    Unidad de Medida
                </label>

                <p class="text-gray-800">

                    {{ $meta->unidad_medida ?? '-' }}

                </p>

            </div>

            <!-- Fecha Inicio -->

            <div>

                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">
                    Fecha de Inicio
                </label>

                <p class="text-gray-800">

                    {{ optional($meta->fecha_inicio)->format('d/m/Y') ?? '-' }}

                </p>

            </div>

            <!-- Fecha Fin -->

            <div>

                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">
                    Fecha de Fin
                </label>

                <p class="text-gray-800">

                    {{ optional($meta->fecha_fin)->format('d/m/Y') ?? '-' }}

                </p>

            </div>

            <!-- Objetivo -->

            <div class="md:col-span-2">

                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">
                    Objetivo Estratégico
                </label>

                <p class="text-gray-800">

                    {{ $meta->objetivo->codigo }} - {{ $meta->objetivo->nombre }}

                </p>

            </div>

        </div>

        <!-- Pie -->

        <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-200 bg-gray-50 rounded-b-lg">

            <a href="{{ route('metas.index', $meta->objetivo_id) }}"
               class="px-5 py-2.5 border border-gray-300 rounded-lg bg-white text-gray-700 hover:bg-gray-100">

                Volver

            </a>

            <a href="{{ route('metas.edit', $meta->id) }}"
               class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">

                <i class="bi bi-pencil-square mr-2"></i>

                Editar Meta

            </a>

        </div>

    </div>

</x-objetivos-layout>