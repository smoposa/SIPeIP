<x-objetivos-layout title="Editar Indicador">

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

                Editar Indicador

            </h2>

            <p class="mt-1 text-sm text-gray-500">

                Actualice la información del indicador institucional.

            </p>

        </div>

        <div class="overflow-y-auto"
             style="height: calc(100vh - 270px);">

            <form method="POST"
                  action="{{ route('indicadores.update', $indicador->id) }}">

                @csrf
                @method('PUT')

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
                                            {{ old('meta_id', $indicador->meta_id) == $meta->id ? 'selected' : '' }}>

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
                                    value="{{ $indicador->codigo }}"
                                    disabled
                                    class="w-full h-9 bg-gray-100 border border-gray-300 rounded-md px-3 text-sm">

                                <input
                                    type="hidden"
                                    name="codigo"
                                    value="{{ $indicador->codigo }}">

                            </div>

                        </div>

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
                                    value="{{ old('nombre', $indicador->nombre) }}"
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

                                    <option value="">

                                        Seleccione...

                                    </option>

                                    <option value="Resultado"
                                        {{ old('tipo', $indicador->tipo) == 'Resultado' ? 'selected' : '' }}>

                                        Resultado

                                    </option>

                                    <option value="Producto"
                                        {{ old('tipo', $indicador->tipo) == 'Producto' ? 'selected' : '' }}>

                                        Producto

                                    </option>

                                    <option value="Proceso"
                                        {{ old('tipo', $indicador->tipo) == 'Proceso' ? 'selected' : '' }}>

                                        Proceso

                                    </option>

                                    <option value="Impacto"
                                        {{ old('tipo', $indicador->tipo) == 'Impacto' ? 'selected' : '' }}>

                                        Impacto

                                    </option>

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
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">{{ old('formula', $indicador->formula) }}</textarea>

                            </div>

                        </div>

                        <!-- Unidad de medida -->

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

                                    <option value="Porcentaje" {{ old('unidad_medida', $indicador->unidad_medida) == 'Porcentaje' ? 'selected' : '' }}>Porcentaje</option>

                                    <option value="Número" {{ old('unidad_medida', $indicador->unidad_medida) == 'Número' ? 'selected' : '' }}>Número</option>

                                    <option value="Cantidad" {{ old('unidad_medida', $indicador->unidad_medida) == 'Cantidad' ? 'selected' : '' }}>Cantidad</option>

                                    <option value="Índice" {{ old('unidad_medida', $indicador->unidad_medida) == 'Índice' ? 'selected' : '' }}>Índice</option>

                                    <option value="Tasa" {{ old('unidad_medida', $indicador->unidad_medida) == 'Tasa' ? 'selected' : '' }}>Tasa</option>

                                    <option value="Razón" {{ old('unidad_medida', $indicador->unidad_medida) == 'Razón' ? 'selected' : '' }}>Razón</option>

                                    <option value="Promedio" {{ old('unidad_medida', $indicador->unidad_medida) == 'Promedio' ? 'selected' : '' }}>Promedio</option>

                                    <option value="Días" {{ old('unidad_medida', $indicador->unidad_medida) == 'Días' ? 'selected' : '' }}>Días</option>

                                    <option value="Horas" {{ old('unidad_medida', $indicador->unidad_medida) == 'Horas' ? 'selected' : '' }}>Horas</option>

                                    <option value="Minutos" {{ old('unidad_medida', $indicador->unidad_medida) == 'Minutos' ? 'selected' : '' }}>Minutos</option>

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

                                    <option value="Mensual"
                                        {{ old('frecuencia', $indicador->frecuencia) == 'Mensual' ? 'selected' : '' }}>
                                        Mensual
                                    </option>

                                    <option value="Bimestral"
                                        {{ old('frecuencia', $indicador->frecuencia) == 'Bimestral' ? 'selected' : '' }}>
                                        Bimestral
                                    </option>

                                    <option value="Trimestral"
                                        {{ old('frecuencia', $indicador->frecuencia) == 'Trimestral' ? 'selected' : '' }}>
                                        Trimestral
                                    </option>

                                    <option value="Cuatrimestral"
                                        {{ old('frecuencia', $indicador->frecuencia) == 'Cuatrimestral' ? 'selected' : '' }}>
                                        Cuatrimestral
                                    </option>

                                    <option value="Semestral"
                                        {{ old('frecuencia', $indicador->frecuencia) == 'Semestral' ? 'selected' : '' }}>
                                        Semestral
                                    </option>

                                    <option value="Anual"
                                        {{ old('frecuencia', $indicador->frecuencia) == 'Anual' ? 'selected' : '' }}>
                                        Anual
                                    </option>

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
                                            value="{{ $responsable->id }}"
                                            {{ old('responsable_id', $indicador->responsable_id) == $responsable->id ? 'selected' : '' }}>

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

                                    <option value="Activo"
                                        {{ old('estado', $indicador->estado) == 'Activo' ? 'selected' : '' }}>
                                        Activo
                                    </option>

                                    <option value="Inactivo"
                                        {{ old('estado', $indicador->estado) == 'Inactivo' ? 'selected' : '' }}>
                                        Inactivo
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                    <!-- Botones -->

                    <div class="flex justify-end gap-3 pt-6 border-t">

                        <a href="{{ route('indicadores.detalle', $indicador->id) }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">

                            Cancelar

                        </a>

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">

                            Guardar cambios

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</x-objetivos-layout>