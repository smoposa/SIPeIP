<x-objetivos-layout title="Editar Meta">

    <!-- Barra de acciones -->
    <div class="mb-0 border-b border-gray-300 bg-white">

        <div class="flex flex-wrap items-center">

            <a href="{{ route('metas.detalle', $meta->id) }}"
               class="mr-8 py-2 text-sm font-medium text-blue-500 hover:text-blue-800">

                <i class="bi bi-chevron-left"></i>

                Regresar

            </a>

        </div>

    </div>

    <!-- Contenido -->
    <div class="min-w-0 max-w-full bg-white p-6 shadow-sm">

        <!-- Encabezado -->
        <div class="mb-6">

            <h2 class="text-2xl font-semibold text-gray-800">
                Actualizar meta institucional
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Modifique la información general y los valores de la meta.
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

        @if(session('error'))

            <div class="mb-6 rounded-lg border border-red-300 bg-red-50 p-4 text-sm text-red-700">
                {{ session('error') }}
            </div>

        @endif

        <!-- Scroll -->
        <div class="min-w-0 w-full max-w-full overflow-y-auto"
             style="
                height: calc(100vh - 300px);
                overflow-x: hidden;
             ">

            <form method="POST"
                  action="{{ route('metas.update', $meta->id) }}"
                  class="min-w-0 w-full max-w-full"
                  style="overflow-x: hidden;">

                @csrf
                @method('PUT')

                <div class="space-y-8">

                    <!-- Información general -->
                    <div>

                        <div class="mb-5 border-b border-gray-200 bg-[#F3F2F1] px-4 py-2">

                            <h3 class="text-sm font-semibold text-gray-700">
                                Información general
                            </h3>

                        </div>

                        <div class="space-y-5 pl-8">

                            <!-- Objetivo -->
                            <div class="flex items-center gap-4">

                                <label for="objetivo_id"
                                       class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                                    Objetivo estratégico
                                    <span class="text-red-500">*</span>

                                </label>

                                <div class="min-w-0 flex-1">

                                    <select id="objetivo_id"
                                            name="objetivo_id"
                                            required
                                            class="h-10 w-full min-w-0 rounded-lg border-gray-300 px-3 text-sm focus:border-blue-500 focus:ring-blue-500">

                                        <option value="">
                                            Seleccione un objetivo
                                        </option>

                                        @foreach($objetivos as $objetivo)

                                            <option value="{{ $objetivo->id }}"
                                                {{ old(
                                                    'objetivo_id',
                                                    $meta->objetivo_id
                                                ) == $objetivo->id ? 'selected' : '' }}>

                                                {{ $objetivo->codigo }} - {{ $objetivo->nombre }}

                                            </option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>

                            <!-- Código -->
                            <div class="flex items-center gap-4">

                                <label for="codigo"
                                       class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">
                                    Código
                                </label>

                                <div class="min-w-0 flex-1">

                                    <input type="text"
                                           id="codigo"
                                           value="{{ $meta->codigo }}"
                                           readonly
                                           class="h-10 w-full min-w-0 cursor-not-allowed rounded-lg border-gray-300 bg-gray-100 px-3 text-sm text-gray-500">

                                </div>

                            </div>

                            <!-- Nombre -->
                            <div class="flex items-center gap-4">

                                <label for="nombre"
                                       class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                                    Nombre de la meta
                                    <span class="text-red-500">*</span>

                                </label>

                                <div class="min-w-0 flex-1">

                                    <input type="text"
                                           id="nombre"
                                           name="nombre"
                                           maxlength="255"
                                           value="{{ old('nombre', $meta->nombre) }}"
                                           required
                                           class="h-10 w-full min-w-0 rounded-lg border-gray-300 px-3 text-sm focus:border-blue-500 focus:ring-blue-500">

                                </div>

                            </div>

                            <!-- Descripción -->
                            <div class="flex items-start gap-4">

                                <label for="descripcion"
                                       class="w-52 flex-shrink-0 pt-2 text-sm font-semibold text-gray-700">
                                    Descripción
                                </label>

                                <div class="min-w-0 flex-1">

                                    <textarea id="descripcion"
                                              name="descripcion"
                                              rows="4"
                                              class="w-full min-w-0 rounded-lg border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500">{{ old('descripcion', $meta->descripcion) }}</textarea>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Valores -->
                    <div>

                        <div class="mb-5 border-b border-gray-200 bg-[#F3F2F1] px-4 py-2">

                            <h3 class="text-sm font-semibold text-gray-700">
                                Valores de la meta
                            </h3>

                        </div>

                        <div class="space-y-5 pl-8">

                            <!-- Línea base -->
                            <div class="flex items-center gap-4">

                                <label for="linea_base"
                                       class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                                    Línea base
                                    <span class="text-red-500">*</span>

                                </label>

                                <div class="min-w-0 flex-1">

                                    <input type="number"
                                           id="linea_base"
                                           name="linea_base"
                                           step="0.01"
                                           min="0"
                                           max="99999999.99"
                                           value="{{ old('linea_base', $meta->linea_base) }}"
                                           required
                                           class="h-10 w-full min-w-0 rounded-lg border-gray-300 px-3 text-sm focus:border-blue-500 focus:ring-blue-500">

                                </div>

                            </div>

                            <!-- Valor meta -->
                            <div class="flex items-center gap-4">

                                <label for="valor_meta"
                                       class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                                    Valor meta
                                    <span class="text-red-500">*</span>

                                </label>

                                <div class="min-w-0 flex-1">

                                    <input type="number"
                                           id="valor_meta"
                                           name="valor_meta"
                                           step="0.01"
                                           min="0"
                                           max="99999999.99"
                                           value="{{ old('valor_meta', $meta->valor_meta) }}"
                                           required
                                           class="h-10 w-full min-w-0 rounded-lg border-gray-300 px-3 text-sm focus:border-blue-500 focus:ring-blue-500">

                                </div>

                            </div>

                            <!-- Unidad de medida -->
                            <div class="flex items-center gap-4">

                                <label for="unidad_medida"
                                       class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                                    Unidad de medida
                                    <span class="text-red-500">*</span>

                                </label>

                                <div class="min-w-0 flex-1">

                                    @php
                                        $unidadesMedida = [
                                            'Porcentaje',
                                            'Número',
                                            'Cantidad',
                                            'Personas',
                                            'Beneficiarios',
                                            'Instituciones',
                                            'Centros de Salud',
                                            'Hospitales',
                                            'Establecimientos',
                                            'Kilómetros',
                                            'Metros cuadrados',
                                            'Hectáreas',
                                            'Dólares',
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
                                        ];
                                    @endphp

                                    <select id="unidad_medida"
                                            name="unidad_medida"
                                            required
                                            class="h-10 w-full min-w-0 rounded-lg border-gray-300 px-3 text-sm focus:border-blue-500 focus:ring-blue-500">

                                        <option value="">
                                            Seleccione una unidad
                                        </option>

                                        @foreach($unidadesMedida as $unidad)

                                            <option value="{{ $unidad }}"
                                                {{ old(
                                                    'unidad_medida',
                                                    $meta->unidad_medida
                                                ) === $unidad ? 'selected' : '' }}>

                                                {{ $unidad }}

                                            </option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Planificación -->
                    <div>

                        <div class="mb-5 border-b border-gray-200 bg-[#F3F2F1] px-4 py-2">

                            <h3 class="text-sm font-semibold text-gray-700">
                                Planificación y responsabilidad
                            </h3>

                        </div>

                        <div class="space-y-5 pl-8">

                            <!-- Período -->
                            <div class="flex items-center gap-4">

                                <label class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                                    Período de vigencia
                                    <span class="text-red-500">*</span>

                                </label>

                                <div class="flex min-w-0 flex-1 items-center gap-3">

                                    <input type="number"
                                           id="periodo_inicio"
                                           name="periodo_inicio"
                                           min="2000"
                                           max="2100"
                                           value="{{ old(
                                                'periodo_inicio',
                                                $meta->periodo_inicio
                                           ) }}"
                                           required
                                           class="h-10 w-32 rounded-lg border-gray-300 px-3 text-sm focus:border-blue-500 focus:ring-blue-500">

                                    <span class="font-semibold text-gray-500">
                                        -
                                    </span>

                                    <input type="number"
                                           id="periodo_fin"
                                           name="periodo_fin"
                                           min="2000"
                                           max="2100"
                                           value="{{ old(
                                                'periodo_fin',
                                                $meta->periodo_fin
                                           ) }}"
                                           required
                                           class="h-10 w-32 rounded-lg border-gray-300 px-3 text-sm focus:border-blue-500 focus:ring-blue-500">

                                </div>

                            </div>

                            <!-- Responsable -->
                            <div class="flex items-center gap-4">

                                <label for="responsable_id"
                                       class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                                    Responsable
                                    <span class="text-red-500">*</span>

                                </label>

                                <div class="min-w-0 flex-1">

                                    <select id="responsable_id"
                                            name="responsable_id"
                                            required
                                            class="h-10 w-full min-w-0 rounded-lg border-gray-300 px-3 text-sm focus:border-blue-500 focus:ring-blue-500">

                                        <option value="">
                                            Seleccione un responsable
                                        </option>

                                        @foreach($responsables as $responsable)

                                            <option value="{{ $responsable->id }}"
                                                {{ old(
                                                    'responsable_id',
                                                    $meta->responsable_id
                                                ) == $responsable->id ? 'selected' : '' }}>

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
                    <div class="border-t border-gray-200 pt-6">

                        <div class="flex flex-wrap justify-end gap-3">

                            <a href="{{ route('metas.detalle', $meta->id) }}"
                               class="inline-flex h-10 items-center justify-center rounded-lg bg-gray-200 px-5 text-sm font-medium text-gray-700 transition hover:bg-gray-300">

                                Cancelar

                            </a>

                            <button type="submit"
                                    class="inline-flex h-10 items-center justify-center rounded-lg bg-[#024687] px-5 text-sm font-medium text-white transition hover:bg-[#01325f]">

                                <i class="bi bi-check-circle mr-2"></i>

                                Actualizar meta

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</x-objetivos-layout>