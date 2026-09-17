<!-- Alineación con los Objetivos de Desarrollo Sostenible -->
<div class="mb-8">

    <div class="mb-5 border-b border-gray-200 bg-[#F3F2F1] px-4 py-2">

        <h2 class="text-sm font-semibold text-gray-700">
            Alineación con los Objetivos de Desarrollo Sostenible
        </h2>

    </div>

    <div class="pl-8">

        <!-- ODS -->
        <div class="mb-5 flex items-center gap-4">

            <label for="ods_id"
                   class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                ODS
                <span class="text-red-500">*</span>

            </label>

            <div class="min-w-0 flex-1">

                <select id="ods_id"
                        name="ods_id"
                        required
                        class="h-10 w-full min-w-0 rounded-md border-gray-300 px-3 text-sm">

                    <option value="">Seleccione</option>

                    @foreach($ods as $objetivo)

                        <option value="{{ $objetivo->id }}"
                            {{ old('ods_id') == $objetivo->id ? 'selected' : '' }}>

                            {{ $objetivo->codigo }} - {{ $objetivo->nombre }}

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
                        class="h-10 w-full min-w-0 rounded-md border-gray-300 px-3 text-sm">

                    <option value="">
                        Seleccione un ODS primero
                    </option>

                </select>

            </div>

        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const ods = document.getElementById('ods_id');
    const meta = document.getElementById('ods_meta_id');

    const metaSeleccionada =
        @json(old('ods_meta_id'));

    function cargarMetas(
        odsId,
        seleccionada = null
    ) {
        meta.innerHTML =
            '<option value="">Cargando...</option>';

        if (!odsId) {
            meta.innerHTML =
                '<option value="">Seleccione un ODS primero</option>';

            return;
        }

        fetch(`/objetivos/ods/${odsId}/metas`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(
                        'Error al obtener las metas.'
                    );
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
                    const option = new Option(
                        `${item.codigo} - ${item.nombre}`,
                        item.id
                    );

                    option.selected =
                        String(item.id) === String(seleccionada);

                    meta.add(option);
                });
            })
            .catch(error => {
                console.error(error);

                meta.innerHTML =
                    '<option value="">Error al cargar las metas</option>';
            });
    }

    ods.addEventListener('change', function () {
        cargarMetas(this.value);
    });

    if (ods.value) {
        cargarMetas(
            ods.value,
            metaSeleccionada
        );
    }
});
</script>