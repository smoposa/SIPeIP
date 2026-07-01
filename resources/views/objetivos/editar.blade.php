<x-objetivos-layout title="Editar Objetivo Estratégico">

    <!-- Barra de navegación -->

    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="{{ route('objetivos.detalle', $objetivo->id) }}"
                class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Información General
            </a>

            <a href="#"
                class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Metas (0)
            </a>

            <a href="#"
                class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Indicadores (0)
            </a>

            <a href="#"
                class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Proyectos (0)
            </a>

            <a href="#"
                class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Alineación
            </a>
            

            <a href="#"
                class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Historial
            </a>

            <a href="{{ route('objetivos.edit', $objetivo->id) }}"
                class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Editar
            </a>

        </div>

    </div>


    <!-- Encabezado -->

    <div class="flex items-start justify-between mb-8">

        <div>

            <div class="flex items-center gap-3 mb-2">

                <span
                    class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">

                    {{ $objetivo->codigo }}

                </span>

                @if($objetivo->estado == 'Activo')

                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                        {{ $objetivo->estado }}

                    </span>

                @else

                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">

                        {{ $objetivo->estado }}

                    </span>

                @endif

                <span
                    class="inline-flex items-center px-3 py-1 rounded-full bg-purple-100 text-purple-700 text-xs font-semibold">

                    Objetivo Estratégico Institucional

                </span>

            </div>

            <h2 class="text-2xl font-semibold text-gray-800">

                Editar Objetivo Estratégico

            </h2>

            <p class="mt-2 text-gray-600">

                Actualice la información del objetivo estratégico institucional.

            </p>

        </div>


        <div class="flex gap-3">

            <a href="{{ route('objetivos.detalle', $objetivo->id) }}"
                class="inline-flex items-center px-4 py-2 border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 rounded-lg">

                <i class="bi bi-arrow-left mr-2"></i>

                Cancelar

            </a>

        </div>

    </div>


    <!-- Tarjetas Resumen -->

    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">

        <div class="bg-white border rounded-lg p-5">

            <p class="text-sm text-gray-500">

                Código

            </p>

            <h4 class="mt-2 text-xl font-semibold text-gray-800">

                {{ $objetivo->codigo }}

            </h4>

        </div>

        <div class="bg-white border rounded-lg p-5">

            <p class="text-sm text-gray-500">

                Estado

            </p>

            <h4 class="mt-2 text-lg font-semibold text-green-700">

                {{ $objetivo->estado }}

            </h4>

        </div>

        <div class="bg-white border rounded-lg p-5">

            <p class="text-sm text-gray-500">

                Responsable

            </p>

            <h4 class="mt-2 text-lg font-semibold text-gray-800">

                Dirección de Planificación

            </h4>

        </div>

        <div class="bg-white border rounded-lg p-5">

            <p class="text-sm text-gray-500">

                Última Actualización

            </p>

            <h4 class="mt-2 text-lg font-semibold text-gray-800">

                {{ $objetivo->updated_at->format('d/m/Y') }}

            </h4>

        </div>

    </div>


    <!-- Estadísticas -->

    <div class="grid grid-cols-2 md:grid-cols-4 gap-5 mb-8">

        <div class="bg-white border rounded-lg p-5 text-center">

            <p class="text-sm text-gray-500">

                Metas

            </p>

            <h3 class="mt-2 text-3xl font-bold text-blue-600">

                0

            </h3>

        </div>

        <div class="bg-white border rounded-lg p-5 text-center">

            <p class="text-sm text-gray-500">

                Indicadores

            </p>

            <h3 class="mt-2 text-3xl font-bold text-green-600">

                0

            </h3>

        </div>

        <div class="bg-white border rounded-lg p-5 text-center">

            <p class="text-sm text-gray-500">

                Proyectos

            </p>

            <h3 class="mt-2 text-3xl font-bold text-amber-600">

                0

            </h3>

        </div>

        <div class="bg-white border rounded-lg p-5 text-center">

            <p class="text-sm text-gray-500">

                Seguimientos

            </p>

            <h3 class="mt-2 text-3xl font-bold text-purple-600">

                0

            </h3>

        </div>

    </div>


    <!-- Formulario -->

    <form action="{{ route('objetivos.update', $objetivo->id) }}" method="POST">

        @csrf

        @method('PUT')

        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">

            <div class="px-6 py-4 border-b bg-gray-50">

                <h3 class="text-lg font-semibold text-gray-800">

                    Información General

                </h3>

            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Código -->

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">

                        Código

                    </label>

                    <input
                        type="text"
                        name="codigo"
                        value="{{ old('codigo', $objetivo->codigo) }}"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                    @error('codigo')

                        <p class="mt-2 text-sm text-red-600">

                            {{ $message }}

                        </p>

                    @enderror

                </div>

                <!-- Tipo -->

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">

                        Tipo de Objetivo

                    </label>

                    <select
                        name="tipo"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                        <option value="OEI" {{ old('tipo',$objetivo->tipo)=='OEI' ? 'selected' : '' }}>

                            Objetivo Estratégico Institucional

                        </option>

                        <option value="PND" {{ old('tipo',$objetivo->tipo)=='PND' ? 'selected' : '' }}>

                            Plan Nacional de Desarrollo

                        </option>

                        <option value="ODS" {{ old('tipo',$objetivo->tipo)=='ODS' ? 'selected' : '' }}>

                            Objetivo de Desarrollo Sostenible

                        </option>

                    </select>

                </div>
                                <!-- Nombre -->

                <div class="md:col-span-2">

                    <label class="block text-sm font-medium text-gray-700 mb-2">

                        Nombre

                    </label>

                    <input
                        type="text"
                        name="nombre"
                        value="{{ old('nombre', $objetivo->nombre) }}"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                    @error('nombre')

                        <p class="mt-2 text-sm text-red-600">

                            {{ $message }}

                        </p>

                    @enderror

                </div>


                <!-- Descripción -->

                <div class="md:col-span-2">

                    <label class="block text-sm font-medium text-gray-700 mb-2">

                        Descripción

                    </label>

                    <textarea
                        name="descripcion"
                        rows="6"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('descripcion', $objetivo->descripcion) }}</textarea>

                    @error('descripcion')

                        <p class="mt-2 text-sm text-red-600">

                            {{ $message }}

                        </p>

                    @enderror

                </div>


                <!-- Estado -->

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">

                        Estado

                    </label>

                    <select
                        name="estado"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                        <option value="Activo"
                            {{ old('estado', $objetivo->estado) == 'Activo' ? 'selected' : '' }}>

                            Activo

                        </option>

                        <option value="Inactivo"
                            {{ old('estado', $objetivo->estado) == 'Inactivo' ? 'selected' : '' }}>

                            Inactivo

                        </option>

                    </select>

                </div>


                <!-- Fecha Creación -->

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">

                        Fecha de Creación

                    </label>

                    <input
                        type="text"
                        value="{{ $objetivo->created_at->format('d/m/Y') }}"
                        class="w-full rounded-lg bg-gray-100 border-gray-300"
                        readonly>

                </div>


                <!-- Fecha Actualización -->

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">

                        Última Actualización

                    </label>

                    <input
                        type="text"
                        value="{{ $objetivo->updated_at->format('d/m/Y') }}"
                        class="w-full rounded-lg bg-gray-100 border-gray-300"
                        readonly>

                </div>


                <!-- Responsable -->

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">

                        Responsable

                    </label>

                    <input
                        type="text"
                        value="Dirección de Planificación"
                        class="w-full rounded-lg bg-gray-100 border-gray-300"
                        readonly>

                </div>

            </div>


            <!-- Botones -->

            <div class="px-6 py-4 border-t bg-gray-50 flex justify-end gap-3">

                <a href="{{ route('objetivos.detalle', $objetivo->id) }}"
                    class="inline-flex items-center px-5 py-2.5 border border-gray-300 bg-white hover:bg-gray-100 rounded-lg text-gray-700">

                    <i class="bi bi-x-circle mr-2"></i>

                    Cancelar

                </a>

                <button
                    type="submit"
                    class="inline-flex items-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">

                    <i class="bi bi-check-circle mr-2"></i>

                    Guardar Cambios

                </button>

            </div>

        </div>

    </form>


    <!-- Módulos Relacionados -->

    <div class="mt-8">

        <h3 class="text-lg font-semibold text-gray-800 mb-5">

            Módulos Relacionados

        </h3>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-5">

            <!-- Metas -->

            <div class="bg-white border border-gray-200 rounded-lg p-6 hover:border-blue-500 hover:shadow-md transition">

                <div class="flex items-center justify-between">

                    <div>

                        <h4 class="text-lg font-semibold text-gray-800">

                            Metas

                        </h4>

                        <p class="text-sm text-gray-500 mt-1">

                            0 registradas

                        </p>

                    </div>

                    <i class="bi bi-bullseye text-3xl text-blue-600"></i>

                </div>

                <div class="mt-5">

                    <a href="#"
                        class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">

                        Administrar

                        <i class="bi bi-arrow-right-short text-lg ml-1"></i>

                    </a>

                </div>

            </div>


            <!-- Indicadores -->

            <div class="bg-white border border-gray-200 rounded-lg p-6 hover:border-green-500 hover:shadow-md transition">

                <div class="flex items-center justify-between">

                    <div>

                        <h4 class="text-lg font-semibold text-gray-800">

                            Indicadores

                        </h4>

                        <p class="text-sm text-gray-500 mt-1">

                            0 registrados

                        </p>

                    </div>

                    <i class="bi bi-graph-up-arrow text-3xl text-green-600"></i>

                </div>

                <div class="mt-5">

                    <a href="#"
                        class="inline-flex items-center text-sm font-medium text-green-600 hover:text-green-700">

                        Administrar

                        <i class="bi bi-arrow-right-short text-lg ml-1"></i>

                    </a>

                </div>

            </div>
                        <!-- Proyectos -->

            <div class="bg-white border border-gray-200 rounded-lg p-6 hover:border-amber-500 hover:shadow-md transition">

                <div class="flex items-center justify-between">

                    <div>

                        <h4 class="text-lg font-semibold text-gray-800">

                            Proyectos

                        </h4>

                        <p class="text-sm text-gray-500 mt-1">

                            0 registrados

                        </p>

                    </div>

                    <i class="bi bi-diagram-3-fill text-3xl text-amber-500"></i>

                </div>

                <div class="mt-5">

                    <a href="#"
                        class="inline-flex items-center text-sm font-medium text-amber-600 hover:text-amber-700">

                        Administrar

                        <i class="bi bi-arrow-right-short text-lg ml-1"></i>

                    </a>

                </div>

            </div>


            <!-- Alineación -->

            <div class="bg-white border border-gray-200 rounded-lg p-6 hover:border-cyan-500 hover:shadow-md transition">

                <div class="flex items-center justify-between">

                    <div>

                        <h4 class="text-lg font-semibold text-gray-800">

                            Alineación

                        </h4>

                        <p class="text-sm text-gray-500 mt-1">

                            ODS y PND

                        </p>

                    </div>

                    <i class="bi bi-link-45deg text-3xl text-cyan-600"></i>

                </div>

                <div class="mt-5">

                    <a href="#"
                        class="inline-flex items-center text-sm font-medium text-cyan-600 hover:text-cyan-700">

                        Administrar

                        <i class="bi bi-arrow-right-short text-lg ml-1"></i>

                    </a>

                </div>

            </div>


            <!-- Historial -->

            <div class="bg-white border border-gray-200 rounded-lg p-6 hover:border-gray-500 hover:shadow-md transition">

                <div class="flex items-center justify-between">

                    <div>

                        <h4 class="text-lg font-semibold text-gray-800">

                            Historial

                        </h4>

                        <p class="text-sm text-gray-500 mt-1">

                            Últimos cambios

                        </p>

                    </div>

                    <i class="bi bi-clock-history text-3xl text-gray-600"></i>

                </div>

                <div class="mt-5">

                    <a href="#"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-black">

                        Consultar

                        <i class="bi bi-arrow-right-short text-lg ml-1"></i>

                    </a>

                </div>

            </div>

        </div>

    </div>


    <!-- Información -->

    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-5">

        <div class="flex items-start">

            <i class="bi bi-info-circle-fill text-blue-600 text-xl mr-3"></i>

            <div>

                <h4 class="font-semibold text-blue-800">

                    Información

                </h4>

                <p class="mt-1 text-sm text-blue-700 leading-6">

                    Desde esta pantalla podrá actualizar la información general del
                    Objetivo Estratégico Institucional. Las modificaciones realizadas
                    serán registradas en el historial del sistema para garantizar la
                    trazabilidad de los cambios y mantener la integridad de la
                    planificación institucional del SIPeIP.

                </p>

            </div>

        </div>

    </div>

</x-objetivos-layout>