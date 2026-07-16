<!-- Alineación con el Plan Nacional -->
<div class="mb-8">

    <!-- Encabezado -->
    <div class="bg-[#F3F2F1] border-b border-gray-200 px-4 py-2 mb-5">

        <h2 class="text-sm font-semibold text-gray-700">
            Alineación con el Plan Nacional de Desarrollo
        </h2>

    </div>

    <!-- Contenido -->
    <div class="pl-8">

        <!-- Objetivo PND -->
        <div class="flex items-center mb-5">

            <label for="pnd_id"
                   class="w-52 text-sm font-semibold text-gray-700">
                Objetivo del PND
                <span class="text-red-500">*</span>
            </label>

            <select
                id="pnd_id"
                name="pnd_id"
                class="flex-1 rounded-lg border-gray-300">

                <option value="">Seleccione</option>

                @foreach($pnd as $objetivo)

                    <option value="{{ $objetivo->id }}"
                        {{ old('pnd_id') == $objetivo->id ? 'selected' : '' }}>

                        {{ $objetivo->codigo }} - {{ $objetivo->nombre }}

                    </option>

                @endforeach

            </select>

        </div>

        <!-- Política Pública -->
        <div class="flex items-center">

            <label for="politica_id"
                   class="w-52 text-sm font-semibold text-gray-700">
                Política Pública
                <span class="text-red-500">*</span>
            </label>

            <select
                id="politica_id"
                name="politica_id"
                class="flex-1 rounded-lg border-gray-300">

                <option value="">
                    Seleccione un objetivo primero
                </option>

            </select>

        </div>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const objetivo = document.getElementById('pnd_id');
    const politica = document.getElementById('politica_id');

    objetivo.addEventListener('change', function () {

        politica.innerHTML =
            '<option value="">Cargando...</option>';

        if (!this.value) {

            politica.innerHTML =
                '<option value="">Seleccione un objetivo primero</option>';

            return;

        }

        fetch(`/objetivos/pnd/${this.value}/politicas`)

            .then(response => {

                if (!response.ok) {
                    throw new Error('Error al obtener las políticas.');
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

                    politica.innerHTML += `
                        <option value="${item.id}">
                            ${item.codigo} - ${item.nombre}
                        </option>
                    `;

                });

            })

            .catch(error => {

                console.error(error);

                politica.innerHTML =
                    '<option value="">Error al cargar las políticas</option>';

            });

    });

});

</script>