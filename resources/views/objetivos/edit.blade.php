<x-objetivos-layout title="Editar OEI">

    <div class="mb-0 border-b border-gray-300 bg-white">

        <div class="flex">

            <a href="{{ route('objetivos.detalle', $objetivo->id) }}"
               class="mr-8 py-2 text-sm font-medium text-blue-500 hover:text-blue-800">

                <i class="bi bi-chevron-left"></i>
                Regresar

            </a>

        </div>

    </div>

    <div class="bg-white p-6 shadow-sm">

        <div class="mb-6">

            <h2 class="text-2xl font-semibold text-gray-800">
                Actualizar Objetivo Estratégico Institucional
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Modifique la información del Objetivo Estratégico Institucional.
            </p>

        </div>

        @if ($errors->any())

            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">

                <p class="mb-2 text-sm font-semibold text-red-700">
                    Revise los siguientes campos:
                </p>

                <ul class="list-inside list-disc text-sm text-red-700">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif

        @if(session('error'))

            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                {{ session('error') }}
            </div>

        @endif

        <div class="overflow-y-auto"
             style="height: calc(100vh - 300px);">

            <form method="POST"
                  action="{{ route('objetivos.update', $objetivo->id) }}">

                @csrf
                @method('PUT')

                <div class="space-y-5">

                    <!-- Plan -->
                    <div class="flex items-center">

                        <label for="plan_id"
                               class="w-52 flex-shrink-0 text-sm font-medium text-gray-700">
                            Plan
                            <span class="text-red-500">*</span>
                        </label>

                        <select id="plan_id"
                                name="plan_id"
                                required
                                class="h-9 flex-1 rounded-md border border-gray-300 px-3 text-sm">

                            @foreach($planes as $plan)

                                <option value="{{ $plan->id }}"
                                    {{ old('plan_id', $objetivo->plan_id) == $plan->id ? 'selected' : '' }}>

                                    {{ $plan->codigo }} - {{ $plan->nombre }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Código -->
                    <div class="flex items-center">

                        <label class="w-52 flex-shrink-0 text-sm font-medium text-gray-700">
                            Código
                        </label>

                        <input type="text"
                               value="{{ $objetivo->codigo }}"
                               readonly
                               class="h-9 flex-1 cursor-not-allowed rounded-md border border-gray-300 bg-gray-100 px-3 text-sm text-gray-500">

                    </div>

                    <!-- Objetivo PND -->
                    <div class="flex items-center">

                        <label for="pnd_id"
                               class="w-52 flex-shrink-0 text-sm font-medium text-gray-700">
                            Objetivo PND
                            <span class="text-red-500">*</span>
                        </label>

                        <select id="pnd_id"
                                name="pnd_id"
                                required
                                class="h-9 flex-1 rounded-md border border-gray-300 px-3 text-sm">

                            <option value="">Seleccione</option>

                            @foreach($pnd as $item)

                                <option value="{{ $item->id }}"
                                    {{ old('pnd_id', $objetivo->pnd_id) == $item->id ? 'selected' : '' }}>

                                    Objetivo {{ $item->numero }} - {{ $item->nombre }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Política PND -->
                    <div class="flex items-center">

                        <label for="pnd_politica_id"
                               class="w-52 flex-shrink-0 text-sm font-medium text-gray-700">
                            Política PND
                            <span class="text-red-500">*</span>
                        </label>

                        <select id="pnd_politica_id"
                                name="pnd_politica_id"
                                required
                                class="h-9 flex-1 rounded-md border border-gray-300 px-3 text-sm">

                            <option value="">Cargando políticas...</option>

                        </select>

                    </div>

                    <!-- ODS -->
                    <div class="flex items-center">

                        <label for="ods_id"
                               class="w-52 flex-shrink-0 text-sm font-medium text-gray-700">
                            ODS
                            <span class="text-red-500">*</span>
                        </label>

                        <select id="ods_id"
                                name="ods_id"
                                required
                                class="h-9 flex-1 rounded-md border border-gray-300 px-3 text-sm">

                            <option value="">Seleccione</option>

                            @foreach($ods as $item)

                                <option value="{{ $item->id }}"
                                    {{ old('ods_id', $objetivo->ods_id) == $item->id ? 'selected' : '' }}>

                                    {{ $item->codigo }} - {{ $item->nombre }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Meta ODS -->
                    <div class="flex items-center">

                        <label for="ods_meta_id"
                               class="w-52 flex-shrink-0 text-sm font-medium text-gray-700">
                            Meta ODS
                            <span class="text-red-500">*</span>
                        </label>

                        <select id="ods_meta_id"
                                name="ods_meta_id"
                                required
                                class="h-9 flex-1 rounded-md border border-gray-300 px-3 text-sm">

                            <option value="">Cargando metas...</option>

                        </select>

                    </div>

                    <!-- Nombre -->
                    <div class="flex items-center">

                        <label for="nombre"
                               class="w-52 flex-shrink-0 text-sm font-medium text-gray-700">
                            Nombre
                            <span class="text-red-500">*</span>
                        </label>

                        <input type="text"
                               id="nombre"
                               name="nombre"
                               maxlength="255"
                               value="{{ old('nombre', $objetivo->nombre) }}"
                               required
                               class="h-9 flex-1 rounded-md border border-gray-300 px-3 text-sm">

                    </div>

                    <!-- Descripción -->
                    <div class="flex items-start">

                        <label for="descripcion"
                               class="w-52 flex-shrink-0 pt-2 text-sm font-medium text-gray-700">
                            Descripción
                        </label>

                        <textarea id="descripcion"
                                  name="descripcion"
                                  rows="4"
                                  maxlength="1000"
                                  class="flex-1 rounded-md border border-gray-300 px-3 py-2 text-sm">{{ old('descripcion', $objetivo->descripcion) }}</textarea>

                    </div>

                    <div class="mt-6 flex justify-end gap-3">

                        <button type="submit"
                                class="rounded-md bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">

                            Actualizar

                        </button>

                        <a href="{{ route('objetivos.detalle', $objetivo->id) }}"
                           class="rounded-md bg-gray-200 px-5 py-2 text-gray-700 hover:bg-gray-300">

                            Cancelar

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const pnd = document.getElementById('pnd_id');
            const politica = document.getElementById('pnd_politica_id');
            const ods = document.getElementById('ods_id');
            const meta = document.getElementById('ods_meta_id');

            const politicaSeleccionada = @json(
                old('pnd_politica_id', $objetivo->pnd_politica_id)
            );

            const metaSeleccionada = @json(
                old('ods_meta_id', $objetivo->ods_meta_id)
            );

            function cargarPoliticas(
                pndId,
                seleccionada = null
            ) {
                politica.innerHTML =
                    '<option value="">Cargando políticas...</option>';

                if (!pndId) {
                    politica.innerHTML =
                        '<option value="">Seleccione un objetivo primero</option>';

                    return;
                }

                fetch(`/objetivos/pnd/${pndId}/politicas`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error();
                        }

                        return response.json();
                    })
                    .then(data => {
                        politica.innerHTML =
                            '<option value="">Seleccione una política</option>';

                        data.forEach(item => {
                            const option = new Option(
                                `${item.codigo} - ${item.nombre}`,
                                item.id
                            );

                            option.selected =
                                String(item.id) === String(seleccionada);

                            politica.add(option);
                        });
                    })
                    .catch(() => {
                        politica.innerHTML =
                            '<option value="">Error al cargar las políticas</option>';
                    });
            }

            function cargarMetas(
                odsId,
                seleccionada = null
            ) {
                meta.innerHTML =
                    '<option value="">Cargando metas...</option>';

                if (!odsId) {
                    meta.innerHTML =
                        '<option value="">Seleccione un ODS primero</option>';

                    return;
                }

                fetch(`/objetivos/ods/${odsId}/metas`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error();
                        }

                        return response.json();
                    })
                    .then(data => {
                        meta.innerHTML =
                            '<option value="">Seleccione una meta ODS</option>';

                        data.forEach(item => {
                            const option = new Option(
                                `${item.codigo} - ${item.nombre}`,
                                item.id
                            );

                            option.selected =
                                String(item.id) === String(seleccionada);

                            meta.add(option);
                        });
                    })
                    .catch(() => {
                        meta.innerHTML =
                            '<option value="">Error al cargar las metas</option>';
                    });
            }

            pnd.addEventListener('change', function () {
                cargarPoliticas(this.value);
            });

            ods.addEventListener('change', function () {
                cargarMetas(this.value);
            });

            cargarPoliticas(
                pnd.value,
                politicaSeleccionada
            );

            cargarMetas(
                ods.value,
                metaSeleccionada
            );
        });
    </script>

</x-objetivos-layout>