<!-- Alineación con el Plan Nacional -->
<div class="mb-8">

    <div class="mb-5 border-b border-gray-200 bg-[#F3F2F1] px-4 py-2">

        <h2 class="text-sm font-semibold text-gray-700">
            Alineación con el Plan Nacional de Desarrollo
        </h2>

    </div>

    <div class="pl-8">

        <!-- Objetivo PND -->
        <div class="mb-5 flex items-center gap-4">

            <label for="pnd_id"
                   class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                Objetivo del PND
                <span class="text-red-500">*</span>

            </label>

            <div class="min-w-0 flex-1">

                <select id="pnd_id"
                        name="pnd_id"
                        required
                        class="h-10 w-full min-w-0 rounded-md border-gray-300 px-3 text-sm">

                    <option value="">Seleccione</option>

                    @foreach($pnd as $objetivo)

                        <option value="{{ $objetivo->id }}"
                            {{ old('pnd_id') == $objetivo->id ? 'selected' : '' }}>

                            Objetivo {{ $objetivo->numero }} - {{ $objetivo->nombre }}

                        </option>

                    @endforeach

                </select>

            </div>

        </div>

        <!-- Política Pública -->
        <div class="flex items-center gap-4">

            <label for="pnd_politica_id"
                   class="w-52 flex-shrink-0 text-sm font-semibold text-gray-700">

                Política Pública
                <span class="text-red-500">*</span>

            </label>

            <div class="min-w-0 flex-1">

                <select id="pnd_politica_id"
                        name="pnd_politica_id"
                        required
                        class="h-10 w-full min-w-0 rounded-md border-gray-300 px-3 text-sm">

                    <option value="">
                        Seleccione un objetivo primero
                    </option>

                </select>

            </div>

        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const objetivo = document.getElementById('pnd_id');
    const politica = document.getElementById('pnd_politica_id');

    const politicaSeleccionada =
        @json(old('pnd_politica_id'));

    function cargarPoliticas(
        objetivoId,
        seleccionada = null
    ) {
        politica.innerHTML =
            '<option value="">Cargando...</option>';

        if (!objetivoId) {
            politica.innerHTML =
                '<option value="">Seleccione un objetivo primero</option>';

            return;
        }

        fetch(`/objetivos/pnd/${objetivoId}/politicas`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(
                        'Error al obtener las políticas.'
                    );
                }

                return response.json();
            })
            .then(data => {
                politica.innerHTML =
                    '<option value="">Seleccione una política</option>';

                if (data.length === 0) {
                    politica.innerHTML =
                        '<option value="">No existen políticas registradas</option>';

                    return;
                }

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
            .catch(error => {
                console.error(error);

                politica.innerHTML =
                    '<option value="">Error al cargar las políticas</option>';
            });
    }

    objetivo.addEventListener('change', function () {
        cargarPoliticas(this.value);
    });

    if (objetivo.value) {
        cargarPoliticas(
            objetivo.value,
            politicaSeleccionada
        );
    }
});
</script>