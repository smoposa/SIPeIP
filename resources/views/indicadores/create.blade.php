<x-objetivos-layout title="Crear Indicador">

    {{-- ================= MENSAJE DE ÉXITO ================= --}}
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

    {{-- ================= CONTENIDO ================= --}}
<div class="bg-white p-6 shadow-sm">

    {{-- Encabezado --}}
    <div class="mb-1">

        <h2 class="text-2xl font-semibold text-gray-800 leading-tight">

            Registrar un nuevo indicador institucional

        </h2>

        <a href="{{ route('indicadores.listar') }}"
           class="inline-flex items-center mt-0.5 text-sm font-medium text-blue-600 hover:text-blue-800">

            <i class="bi bi-arrow-left-short text-lg mr-1"></i>

            Regresar

        </a>

    </div>

    @include('indicadores.partials.modal-exito')


    {{-- ================= MODAL DE ÉXITO ================= --}}
    @include('indicadores.partials.modal-exito')

    <div class="overflow-y-auto" style="height: calc(100vh - 270px);">

        <form method="POST"
              action="{{ route('indicadores.store') }}">

            @csrf

            @include('indicadores.partials.barra-progreso')

            @include('indicadores.partials.contexto-planificacion')

            @include('indicadores.partials.informacion-general')

            @include('indicadores.partials.estado')

            @include('indicadores.partials.acciones')

        </form>

    </div>






















    <!-- Barra -->
    <div class="bg-white border-b border-gray-300">

        <div class="flex">

            <a href="{{ route('indicadores.listar') }}"
                class="py-2 text-sm font-medium text-blue-600 hover:text-blue-800 mr-8">

                <i class="bi bi-chevron-left"></i>

                Regresar

            </a>

        </div>

    </div>

    <div class="bg-white pt-4 px-6 pb-6">

        <div class="mb-6">

            <h2 class="text-2xl font-semibold text-gray-800">
                Crear Indicador
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Complete la información para registrar un nuevo indicador institucional.
            </p>

        </div>

        <div class="overflow-y-auto" style="height: calc(100vh - 270px);">

            <form method="POST" action="{{ route('indicadores.store') }}">

                @csrf

                <div class="space-y-8">

                    <!-- Información General -->

                    <div>

                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">
                            Información General
                        </h3>

                        <!-- Meta -->

                        <div class="flex items-center mb-4">

                            <label class="w-44 text-sm font-medium text-gray-700">

                                Meta
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="flex-1">

                                <select
                                    name="meta_id"
                                    required
                                    class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm">

                                    <option value="">
                                        Seleccione...
                                    </option>

                                    @foreach($metas as $meta)

                                        <option
                                            value="{{ $meta->id }}"
                                            {{ old('meta_id') == $meta->id ? 'selected' : '' }}>

                                            {{ $meta->codigo }}
                                            -
                                            {{ $meta->nombre }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <!-- Código -->

                        <div class="flex items-center mb-4">

                            <label class="w-44 text-sm font-medium text-gray-700">
                                Código
                            </label>

                            <div class="flex-1">

                                <input
                                    type="text"
                                    value="{{ $codigo }}"
                                    disabled
                                    class="w-full h-9 bg-gray-100 border border-gray-300 rounded-md px-3 text-sm">

                            </div>

                        </div>

                        <!-- Campo oculto -->

                        <input type="hidden"
                               name="codigo"
                               value="{{ $codigo }}">

                        <!-- Nombre -->

                        <div class="flex items-center mb-4">

                            <label class="w-44 text-sm font-medium text-gray-700">

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

                        <!-- Tipo -->

                        <div class="flex items-center">

                            <label class="w-44 text-sm font-medium text-gray-700">

                                Tipo
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="flex-1">

                                <select
                                    name="tipo"
                                    required
                                    class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm">

                                    <option value="">Seleccione...</option>

                                    <option value="Resultado">Resultado</option>
                                    <option value="Producto">Producto</option>
                                    <option value="Proceso">Proceso</option>
                                    <option value="Impacto">Impacto</option>

                                </select>

                            </div>

                        </div>

                    </div>

                    <!-- Medición -->

                    <div>

                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">
                            Medición
                        </h3>

                        <!-- Fórmula -->

                        <div class="flex items-start mb-4">

                            <label class="w-44 pt-2 text-sm font-medium text-gray-700">

                                Fórmula
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="flex-1">

                                <textarea
                                    name="formula"
                                    rows="3"
                                    required
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">{{ old('formula') }}</textarea>

                            </div>

                        </div>

                        <!-- Unidad -->

                        <div class="flex items-center mb-4">

                            <label class="w-44 text-sm font-medium text-gray-700">

                                Unidad de medida
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="flex-1">

                                <select
                                    name="unidad_medida"
                                    required
                                    class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm">

                                    <option value="">Seleccione...</option>

                                    <option>Porcentaje</option>
                                    <option>Número</option>
                                    <option>Cantidad</option>
                                    <option>Índice</option>
                                    <option>Tasa</option>
                                    <option>Razón</option>
                                    <option>Promedio</option>
                                    <option>Días</option>
                                    <option>Horas</option>
                                    <option>Minutos</option>

                                </select>

                            </div>

                        </div>

                        <!-- Frecuencia -->

                        <div class="flex items-center">

                            <label class="w-44 text-sm font-medium text-gray-700">

                                Frecuencia
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="flex-1">

                                <select
                                    name="frecuencia"
                                    required
                                    class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm">

                                    <option value="">Seleccione...</option>

                                    <option>Mensual</option>
                                    <option>Bimestral</option>
                                    <option>Trimestral</option>
                                    <option>Cuatrimestral</option>
                                    <option>Semestral</option>
                                    <option>Anual</option>

                                </select>

                            </div>

                        </div>

                    </div>

                    <!-- Administración -->

                    <div>

                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">
                            Administración
                        </h3>

                        <!-- Responsable -->

                        <div class="flex items-center mb-4">

                            <label class="w-44 text-sm font-medium text-gray-700">

                                Responsable
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="flex-1">

                                <select
                                    name="responsable_id"
                                    required
                                    class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm">

                                    <option value="">Seleccione...</option>

                                    @foreach($responsables as $responsable)

                                        <option
                                            value="{{ $responsable->id }}">

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

                            <label class="w-44 text-sm font-medium text-gray-700">

                                Estado
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="flex-1">

                                <select
                                    name="estado"
                                    class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm">

                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>

                                </select>

                            </div>

                        </div>

                    </div>

                    <!-- Botones -->

                    <div class="flex justify-end gap-3 pt-6 border-t">

                        <a href="{{ route('indicadores.listar') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">

                            Cancelar

                        </a>

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">

                            Guardar Indicador

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</x-objetivos-layout>