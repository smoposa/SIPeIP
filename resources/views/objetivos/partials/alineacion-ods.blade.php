<!-- Alineación con los Objetivos de Desarrollo Sostenible -->
<div class="mb-8">

    <!-- Encabezado -->
    <div class="bg-[#F3F2F1] border-b border-gray-200 px-4 py-2 mb-5">

        <h2 class="text-sm font-semibold text-gray-700">
            Alineación con los Objetivos de Desarrollo Sostenible
        </h2>

    </div>

    <!-- Contenido -->
    <div class="pl-8">

        <!-- ODS -->
        <div class="flex items-center mb-5">

            <label for="ods_id"
                   class="w-52 text-sm font-semibold text-gray-700">
                ODS
                <span class="text-red-500">*</span>
            </label>

            <select
                id="ods_id"
                name="ods_id"
                class="flex-1 rounded-lg border-gray-300">

                <option value="">Seleccione</option>

                @foreach($ods as $objetivo)

                    <option value="{{ $objetivo->id }}"
                        {{ old('ods_id') == $objetivo->id ? 'selected' : '' }}>

                        {{ $objetivo->codigo }} - {{ $objetivo->nombre }}

                    </option>

                @endforeach

            </select>

        </div>

        <!-- Meta ODS -->
        <div class="flex items-center">

            <label for="meta_ods_id"
                   class="w-52 text-sm font-semibold text-gray-700">
                Meta ODS
                <span class="text-red-500">*</span>
            </label>

            <select
                id="meta_ods_id"
                name="meta_ods_id"
                class="flex-1 rounded-lg border-gray-300">

                <option value="">
                    Seleccione un ODS primero
                </option>

            </select>

        </div>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const ods = document.getElementById('ods_id');
        const meta = document.getElementById('meta_ods_id');

        ods.addEventListener('change', function () {

            meta.innerHTML =
                '<option value="">Cargando...</option>';

            if (!this.value) {

                meta.innerHTML =
                    '<option value="">Seleccione un ODS primero</option>';

                return;

            }

            fetch(`/objetivos/ods/${this.value}/metas`)

                .then(response => {

                    if (!response.ok) {
                        throw new Error('Error al obtener las metas.');
                    }

                    return response.json();

                })

                .then(data => {

                    meta.innerHTML =
                        '<option value="">Seleccione una meta ODS</option>';

                    if (data.length === 0) {

                        meta.innerHTML =
                            '<option value="">No existen metas registradas</option>';

                        return;

                    }

                    data.forEach(item => {

                        meta.innerHTML += `
                            <option value="${item.id}">
                                ${item.codigo} - ${item.nombre}
                            </option>
                        `;

                    });

                })

                .catch(error => {

                    console.error(error);

                    meta.innerHTML =
                        '<option value="">Error al cargar las metas</option>';

                });

        });

    });
</script>