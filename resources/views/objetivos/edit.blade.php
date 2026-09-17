<x-objetivos-layout title="Editar OEI">

    <!-- Barra de acciones -->
    <div class="mb-0 border-b border-gray-300 bg-white">

        <div class="flex flex-wrap items-center">

            <a href="{{ route('objetivos.detalle', $objetivo->id) }}"
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
                Actualizar Objetivo Estratégico Institucional
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Modifique la información del Objetivo Estratégico Institucional.
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
                height: calc(100vh - 230px);
                max-width: 100%;
                overflow-x: hidden;
             ">

            <form method="POST"
                  action="{{ route('objetivos.update', $objetivo->id) }}"
                  class="min-w-0 w-full max-w-full"
                  style="overflow-x: hidden;">

                @csrf
                @method('PUT')

                <div class="space-y-5">

                    <!-- Plan Institucional -->
                    <div class="flex items-center gap-4">

                        <label for="plan_id"
                               class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                            Plan
                            <span class="text-red-500">*</span>

                        </label>

                        <div class="min-w-0 flex-1">

                            <select id="plan_id"
                                    name="plan_id"
                                    required
                                    class="h-10 w-full min-w-0 rounded-md border-gray-300 px-3 text-sm focus:border-blue-500 focus:ring-blue-500">

                                @foreach($planes as $plan)

                                    <option value="{{ $plan->id }}"
                                        {{ old('plan_id', $objetivo->plan_id) == $plan->id ? 'selected' : '' }}>

                                        {{ $plan->codigo }} - {{ $plan->nombre }}

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
                                   value="{{ $objetivo->codigo }}"
                                   readonly
                                   class="h-10 w-full min-w-0 cursor-not-allowed rounded-md border-gray-300 bg-gray-100 px-3 text-sm text-gray-500">

                        </div>

                    </div>

                    <!-- Nombre -->
                    <div class="flex items-center gap-4">

                        <label for="nombre"
                               class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                            Nombre del objetivo
                            <span class="text-red-500">*</span>

                        </label>

                        <div class="min-w-0 flex-1">

                            <input type="text"
                                   id="nombre"
                                   name="nombre"
                                   maxlength="255"
                                   value="{{ old('nombre', $objetivo->nombre) }}"
                                   required
                                   class="h-10 w-full min-w-0 rounded-md border-gray-300 px-3 text-sm focus:border-blue-500 focus:ring-blue-500">

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
                                      class="w-full min-w-0 rounded-md border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500">{{ old('descripcion', $objetivo->descripcion) }}</textarea>

                        </div>

                    </div>

                    <!-- Objetivo PND -->
                    <div class="flex items-center gap-4">

                        <label for="pnd_id"
                               class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                            Objetivo del PND
                            <span class="text-red-500">*</span>

                        </label>

                        <div class="min-w-0 flex-1">

                            <select id="pnd_id"
                                    name="pnd_id"
                                    required
                                    class="h-10 w-full min-w-0 rounded-md border-gray-300 px-3 text-sm focus:border-blue-500 focus:ring-blue-500">

                                @foreach($pnd as $item)

                                    <option value="{{ $item->id }}"
                                        {{ old('pnd_id', $objetivo->pnd_id) == $item->id ? 'selected' : '' }}>

                                        Objetivo {{ $item->numero }} - {{ $item->nombre }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <!-- Política PND -->
                    <div class="flex items-center gap-4">

                        <label for="pnd_politica_id"
                               class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                            Política pública
                            <span class="text-red-500">*</span>

                        </label>

                        <div class="min-w-0 flex-1">

                            <select id="pnd_politica_id"
                                    name="pnd_politica_id"
                                    required
                                    class="h-10 w-full min-w-0 rounded-md border-gray-300 px-3 text-sm focus:border-blue-500 focus:ring-blue-500">

                                <option value="">Cargando políticas...</option>

                            </select>

                        </div>

                    </div>

                    <!-- ODS -->
                    <div class="flex items-center gap-4">

                        <label for="ods_id"
                               class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                            ODS
                            <span class="text-red-500">*</span>

                        </label>

                        <div class="min-w-0 flex-1">

                            <select id="ods_id"
                                    name="ods_id"
                                    required
                                    class="h-10 w-full min-w-0 rounded-md border-gray-300 px-3 text-sm focus:border-blue-500 focus:ring-blue-500">

                                @foreach($ods as $item)

                                    <option value="{{ $item->id }}"
                                        {{ old('ods_id', $objetivo->ods_id) == $item->id ? 'selected' : '' }}>

                                        {{ $item->codigo }} - {{ $item->nombre }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <!-- Meta ODS -->
                    <div class="flex items-center gap-4">

                        <label for="ods_meta_id"
                               class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                            Meta ODS
                            <span class="text-red-500">*</span>

                        </label>

                        <div class="min-w-0 flex-1">

                            <select id="ods_meta_id"
                                    name="ods_meta_id"
                                    required
                                    class="h-10 w-full min-w-0 rounded-md border-gray-300 px-3 text-sm focus:border-blue-500 focus:ring-blue-500">

                                <option value="">Cargando metas...</option>

                            </select>

                        </div>

                    </div>

                    <!-- Acciones -->
                    <div class="mt-8 border-t border-gray-200 pt-6">

                        <div class="flex flex-wrap justify-end gap-3">

                            <a href="{{ route('objetivos.detalle', $objetivo->id) }}"
                               class="inline-flex h-10 items-center justify-center rounded-lg bg-gray-200 px-5 text-sm font-medium text-gray-700 transition hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">

                                Cancelar

                            </a>

                            <button type="submit"
                                    class="inline-flex h-10 items-center justify-center rounded-lg bg-[#024687] px-5 text-sm font-medium text-white transition hover:bg-[#01325f] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">

                                <i class="bi bi-check-circle mr-2"></i>

                                Actualizar objetivo

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const objetivoPnd = document.getElementById('pnd_id');
            const politicaPnd = document.getElementById('pnd_politica_id');

            const ods = document.getElementById('ods_id');
            const metaOds = document.getElementById('ods_meta_id');

            const politicaSeleccionada = @json(
                old('pnd_politica_id', $objetivo->pnd_politica_id)
            );

            const metaSeleccionada = @json(
                old('ods_meta_id', $objetivo->ods_meta_id)
            );

            function cargarPoliticas(pndId, seleccionada = null) {
                politicaPnd.innerHTML =
                    '<option value="">Cargando políticas...</option>';

                if (!pndId) {
                    politicaPnd.innerHTML =
                        '<option value="">Seleccione un objetivo primero</option>';

                    return;
                }

                fetch(`/objetivos/pnd/${pndId}/politicas`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error al obtener las políticas.');
                        }

                        return response.json();
                    })
                    .then(data => {
                        politicaPnd.innerHTML =
                            '<option value="">Seleccione una política</option>';

                        if (data.length === 0) {
                            politicaPnd.innerHTML =
                                '<option value="">No existen políticas registradas</option>';

                            return;
                        }

                        data.forEach(item => {
                            const option = document.createElement('option');

                            option.value = item.id;
                            option.textContent =
                                `${item.codigo} - ${item.nombre}`;

                            option.selected =
                                String(item.id) === String(seleccionada);

                            politicaPnd.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error(error);

                        politicaPnd.innerHTML =
                            '<option value="">Error al cargar las políticas</option>';
                    });
            }

            function cargarMetas(odsId, seleccionada = null) {
                metaOds.innerHTML =
                    '<option value="">Cargando metas...</option>';

                if (!odsId) {
                    metaOds.innerHTML =
                        '<option value="">Seleccione un ODS primero</option>';

                    return;
                }

                fetch(`/objetivos/ods/${odsId}/metas`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error al obtener las metas.');
                        }

                        return response.json();
                    })
                    .then(data => {
                        metaOds.innerHTML =
                            '<option value="">Seleccione una meta ODS</option>';

                        if (data.length === 0) {
                            metaOds.innerHTML =
                                '<option value="">No existen metas registradas</option>';

                            return;
                        }

                        data.forEach(item => {
                            const option = document.createElement('option');

                            option.value = item.id;
                            option.textContent =
                                `${item.codigo} - ${item.nombre}`;

                            option.selected =
                                String(item.id) === String(seleccionada);

                            metaOds.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error(error);

                        metaOds.innerHTML =
                            '<option value="">Error al cargar las metas</option>';
                    });
            }

            objetivoPnd.addEventListener('change', function () {
                cargarPoliticas(this.value);
            });

            ods.addEventListener('change', function () {
                cargarMetas(this.value);
            });

            cargarPoliticas(
                objetivoPnd.value,
                politicaSeleccionada
            );

            cargarMetas(
                ods.value,
                metaSeleccionada
            );
        });
    </script>

</x-objetivos-layout>