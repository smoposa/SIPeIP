<x-objetivos-layout title="Editar Indicador">

    <!-- Barra de acciones -->
    <div class="border-b border-gray-300 bg-white">

        <div class="flex">

            <a href="{{ route('indicadores.detalle', $indicador->id) }}"
               class="mr-8 py-2 text-sm font-medium
                      text-blue-600 hover:text-blue-800">

                <i class="bi bi-chevron-left"></i>
                Regresar

            </a>

        </div>

    </div>

    <div class="min-w-0 bg-white p-6 shadow-sm">

        <!-- Encabezado -->
        <div class="mb-6">

            <h2 class="text-2xl font-semibold text-gray-800">
                Editar indicador institucional
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Actualice la información del indicador institucional.
            </p>

        </div>

        <!-- Validaciones -->
        @if($errors->any())

            <div class="mb-6 rounded-lg border border-red-300 bg-red-50 p-4">

                <p class="mb-2 text-sm font-semibold text-red-700">
                    Revise los siguientes campos:
                </p>

                <ul class="list-inside list-disc text-sm text-red-700">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif

        <!-- Scroll -->
        <div class="min-w-0 w-full overflow-x-hidden overflow-y-auto"
             style="height: calc(100vh - 270px);">

            <form method="POST"
                  action="{{ route('indicadores.update', $indicador->id) }}"
                  class="min-w-0 w-full">

                @csrf
                @method('PUT')

                <!-- Información general -->
                <div class="mb-8">

                    <div class="mb-5 border-b border-gray-200
                                bg-[#F3F2F1] px-4 py-2">

                        <h3 class="text-sm font-semibold text-gray-700">
                            Información General
                        </h3>

                    </div>

                    <div class="min-w-0 pl-8">

                        <!-- Meta -->
                        <div class="mb-5 flex min-w-0 items-center gap-4">

                            <label for="meta_id"
                                   class="w-52 flex-shrink-0
                                          text-sm font-semibold text-gray-700">

                                Meta institucional
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="min-w-0 flex-1">

                                <select id="meta_id"
                                        name="meta_id"
                                        required
                                        class="h-10 w-full min-w-0 rounded-md
                                               border-gray-300 px-3 text-sm">

                                    <option value="">Seleccione una meta</option>

                                    @foreach($metas as $meta)

                                        <option value="{{ $meta->id }}"
                                            {{ old('meta_id', $indicador->meta_id) == $meta->id ? 'selected' : '' }}>

                                            {{ $meta->codigo }} - {{ $meta->nombre }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <!-- Código -->
                        <div class="mb-5 flex min-w-0 items-center gap-4">

                            <label for="codigo"
                                   class="w-52 flex-shrink-0
                                          text-sm font-semibold text-gray-700">
                                Código
                            </label>

                            <div class="min-w-0 flex-1">

                                <input type="text"
                                       id="codigo"
                                       value="{{ $indicador->codigo }}"
                                       readonly
                                       class="h-10 w-full min-w-0 cursor-not-allowed
                                              rounded-md border-gray-300 bg-gray-100
                                              px-3 text-sm text-gray-600">

                            </div>

                        </div>

                        <!-- Nombre -->
                        <div class="mb-5 flex min-w-0 items-center gap-4">

                            <label for="nombre"
                                   class="w-52 flex-shrink-0
                                          text-sm font-semibold text-gray-700">

                                Nombre del indicador
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="min-w-0 flex-1">

                                <input type="text"
                                       id="nombre"
                                       name="nombre"
                                       maxlength="255"
                                       value="{{ old('nombre', $indicador->nombre) }}"
                                       required
                                       class="h-10 w-full min-w-0 rounded-md
                                              border-gray-300 px-3 text-sm">

                            </div>

                        </div>

                        <!-- Tipo -->
                        <div class="flex min-w-0 items-center gap-4">

                            <label for="tipo"
                                   class="w-52 flex-shrink-0
                                          text-sm font-semibold text-gray-700">

                                Tipo
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="min-w-0 flex-1">

                                <select id="tipo"
                                        name="tipo"
                                        required
                                        class="h-10 w-full min-w-0 rounded-md
                                               border-gray-300 px-3 text-sm">

                                    <option value="">Seleccione un tipo</option>

                                    @foreach([
                                        'Resultado',
                                        'Producto',
                                        'Gestión',
                                        'Proceso',
                                        'Impacto',
                                    ] as $tipo)

                                        <option value="{{ $tipo }}"
                                            {{ old('tipo', $indicador->tipo) == $tipo ? 'selected' : '' }}>

                                            {{ $tipo }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Medición -->
                <div class="mb-8">

                    <div class="mb-5 border-b border-gray-200
                                bg-[#F3F2F1] px-4 py-2">

                        <h3 class="text-sm font-semibold text-gray-700">
                            Medición
                        </h3>

                    </div>

                    <div class="min-w-0 pl-8">

                        <!-- Fórmula -->
                        <div class="mb-5 flex min-w-0 items-start gap-4">

                            <label for="formula"
                                   class="w-52 flex-shrink-0 pt-2
                                          text-sm font-semibold text-gray-700">

                                Fórmula
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="min-w-0 flex-1">

                                <textarea id="formula"
                                          name="formula"
                                          rows="4"
                                          required
                                          class="w-full min-w-0 rounded-md
                                                 border-gray-300 px-3 py-2 text-sm">{{ old('formula', $indicador->formula) }}</textarea>

                            </div>

                        </div>

                        <!-- Unidad -->
                        <div class="mb-5 flex min-w-0 items-center gap-4">

                            <label for="unidad_medida"
                                   class="w-52 flex-shrink-0
                                          text-sm font-semibold text-gray-700">

                                Unidad de medida
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="min-w-0 flex-1">

                                <select id="unidad_medida"
                                        name="unidad_medida"
                                        required
                                        class="h-10 w-full min-w-0 rounded-md
                                               border-gray-300 px-3 text-sm">

                                    <option value="">Seleccione una unidad</option>

                                    @foreach([
                                        'Porcentaje',
                                        'Número',
                                        'Personas',
                                        'Beneficiarios',
                                        'Centros de Salud',
                                        'Hospitales',
                                        'Establecimientos',
                                        'Kilómetros',
                                        'Metros cuadrados',
                                        'Documentos',
                                        'Procesos',
                                        'Capacitaciones',
                                        'Minutos',
                                        'Horas',
                                        'Días',
                                        'Meses',
                                        'Años',
                                        'Unidades',
                                        'Otro',
                                    ] as $unidad)

                                        <option value="{{ $unidad }}"
                                            {{ old('unidad_medida', $indicador->unidad_medida) == $unidad ? 'selected' : '' }}>

                                            {{ $unidad }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <!-- Frecuencia -->
                        <div class="flex min-w-0 items-center gap-4">

                            <label for="frecuencia"
                                   class="w-52 flex-shrink-0
                                          text-sm font-semibold text-gray-700">

                                Frecuencia de medición
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="min-w-0 flex-1">

                                <select id="frecuencia"
                                        name="frecuencia"
                                        required
                                        class="h-10 w-full min-w-0 rounded-md
                                               border-gray-300 px-3 text-sm">

                                    <option value="">Seleccione una frecuencia</option>

                                    @foreach([
                                        'Mensual',
                                        'Bimestral',
                                        'Trimestral',
                                        'Cuatrimestral',
                                        'Semestral',
                                        'Anual',
                                    ] as $frecuencia)

                                        <option value="{{ $frecuencia }}"
                                            {{ old('frecuencia', $indicador->frecuencia) == $frecuencia ? 'selected' : '' }}>

                                            {{ $frecuencia }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Responsable -->
                <div class="mb-8">

                    <div class="mb-5 border-b border-gray-200
                                bg-[#F3F2F1] px-4 py-2">

                        <h3 class="text-sm font-semibold text-gray-700">
                            Responsable
                        </h3>

                    </div>

                    <div class="min-w-0 pl-8">

                        <div class="flex min-w-0 items-center gap-4">

                            <label for="responsable_id"
                                   class="w-52 flex-shrink-0
                                          text-sm font-semibold text-gray-700">

                                Responsable
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="min-w-0 flex-1">

                                <select id="responsable_id"
                                        name="responsable_id"
                                        required
                                        class="h-10 w-full min-w-0 rounded-md
                                               border-gray-300 px-3 text-sm">

                                    <option value="">Seleccione un responsable</option>

                                    @foreach($responsables as $responsable)

                                        <option value="{{ $responsable->id }}"
                                            {{ old('responsable_id', $indicador->responsable_id) == $responsable->id ? 'selected' : '' }}>

                                            {{ $responsable->nombres }}
                                            {{ $responsable->apellidos }}

                                            @if($responsable->cargo)
                                                - {{ $responsable->cargo }}
                                            @endif

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Acciones -->
                <div class="mt-8 border-t border-gray-200 pt-6">

                    <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">

                        <button type="submit"
                                class="inline-flex h-10 items-center justify-center
                                       gap-2 rounded-md bg-[#024687] px-5
                                       text-sm font-medium text-white
                                       transition hover:bg-[#01325f]">

                            <i class="bi bi-check-circle"></i>
                            Guardar cambios

                        </button>

                        <a href="{{ route('indicadores.detalle', $indicador->id) }}"
                           class="inline-flex h-10 items-center justify-center
                                  rounded-md bg-gray-200 px-5 text-sm
                                  font-medium text-gray-700
                                  transition hover:bg-gray-300">

                            Cancelar

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

</x-objetivos-layout>