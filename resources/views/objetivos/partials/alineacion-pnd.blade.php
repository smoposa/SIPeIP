<!-- Alineación con el Plan Nacional -->
<div class="mb-8">

    <div class="mb-5 border-b border-gray-200 bg-[#F3F2F1] px-4 py-2">

        <h2 class="text-sm font-semibold text-gray-700">
            Alineación con el Plan Nacional de Desarrollo
        </h2>

    </div>

    <div class="min-w-0 pl-8">

        <!-- Objetivo PND -->
        <div class="mb-5 flex min-w-0 flex-col gap-2 md:flex-row md:gap-4">

            <label for="pnd_id"
                   class="flex-shrink-0 text-sm font-semibold
                          text-gray-700 md:w-52 md:pt-2">

                Objetivo del PND
                <span class="text-red-500">*</span>

            </label>

            <div class="min-w-0 flex-1">

                <select id="pnd_id"
                        name="pnd_id"
                        required
                        aria-describedby="descripcionObjetivoPnd"
                        class="h-10 w-full min-w-0 rounded-md border-gray-300
                               px-3 text-sm focus:border-blue-500
                               focus:ring-blue-500">

                    <option value="">Seleccione un objetivo</option>

                    @foreach($pnd as $objetivo)

                        @php
                            $textoObjetivoPnd =
                                'Objetivo ' . $objetivo->numero .
                                ' - ' . $objetivo->nombre;
                        @endphp

                        <option value="{{ $objetivo->id }}"
                                data-descripcion="{{ $textoObjetivoPnd }}"
                                @selected(
                                    (string) old('pnd_id') === (string) $objetivo->id
                                )>

                            {{ $textoObjetivoPnd }}

                        </option>

                    @endforeach

                </select>

                <p id="descripcionObjetivoPnd"
                   aria-live="polite"
                   class="mt-2 break-words text-sm leading-relaxed
                          text-gray-600"></p>

            </div>

        </div>

        <!-- Política pública -->
        <div class="flex min-w-0 flex-col gap-2 md:flex-row md:gap-4">

            <div id="etiquetaPoliticaPnd"
                 class="flex-shrink-0 text-sm font-semibold
                        text-gray-700 md:w-52 md:pt-2">

                Política pública
                <span class="text-red-500">*</span>

            </div>

            <div class="min-w-0 flex-1">

                <details id="selectorPoliticaPnd"
                         class="rounded-md border border-gray-300 bg-white">

                    <!-- Selección actual -->
                    <summary id="resumenPoliticaPnd"
                             aria-labelledby="etiquetaPoliticaPnd textoPoliticaPnd"
                             class="flex cursor-pointer list-none items-start
                                    justify-between gap-3 rounded-md px-3 py-2
                                    text-sm focus:outline-none focus:ring-2
                                    focus:ring-blue-500">

                        <span id="textoPoliticaPnd"
                              class="min-w-0 flex-1 whitespace-normal
                                     break-words text-left leading-relaxed">

                            Seleccione un objetivo primero

                        </span>

                        <i class="bi bi-chevron-down mt-1 flex-shrink-0
                                  text-gray-500"
                           aria-hidden="true"></i>

                    </summary>

                    <!-- Opciones con texto completo -->
                    <div id="listaPoliticasPnd"
                         role="group"
                         aria-labelledby="etiquetaPoliticaPnd"
                         class="max-h-80 overflow-y-auto border-t
                                border-gray-200 p-2">

                        <p class="px-3 py-2 text-sm text-gray-500">
                            Seleccione un objetivo PND para consultar sus políticas.
                        </p>

                    </div>

                </details>

                <p id="mensajePoliticaPnd"
                   role="status"
                   aria-live="polite"
                   class="mt-2 break-words text-sm text-red-600"></p>

            </div>

        </div>

    </div>

</div>

<style>
    #resumenPoliticaPnd::-webkit-details-marker {
        display: none;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const objetivo = document.getElementById('pnd_id');
        const descripcionObjetivo = document.getElementById(
            'descripcionObjetivoPnd'
        );

        const selector = document.getElementById('selectorPoliticaPnd');
        const resumen = document.getElementById('resumenPoliticaPnd');
        const textoSeleccionado = document.getElementById('textoPoliticaPnd');
        const lista = document.getElementById('listaPoliticasPnd');
        const mensaje = document.getElementById('mensajePoliticaPnd');
        const formulario = objetivo.closest('form');

        const politicaAnterior = {{
            \Illuminate\Support\Js::from(old('pnd_politica_id'))
        }};

        const basePoliticas = {{
            \Illuminate\Support\Js::from(url('/objetivos/pnd'))
        }};

        let solicitud = null;
        let version = 0;


        // Mostrar el nombre completo del objetivo seleccionado.
        function mostrarObjetivo() {

            const opcion = objetivo.selectedOptions[0];

            descripcionObjetivo.textContent = opcion?.value
                ? opcion.dataset.descripcion ?? ''
                : '';

        }


        // Mostrar un mensaje dentro de la lista.
        function mostrarMensajeLista(texto) {

            const parrafo = document.createElement('p');

            parrafo.className = 'px-3 py-2 text-sm text-gray-500';
            parrafo.textContent = texto;

            lista.replaceChildren(parrafo);

        }


        // Cargar las políticas del objetivo seleccionado.
        async function cargarPoliticas(
            objetivoId,
            seleccionada = null
        ) {

            const versionActual = ++version;

            solicitud?.abort();

            selector.open = false;
            mensaje.textContent = '';

            textoSeleccionado.textContent = objetivoId
                ? 'Cargando políticas...'
                : 'Seleccione un objetivo primero';

            mostrarMensajeLista(
                objetivoId
                    ? 'Cargando políticas...'
                    : 'Seleccione un objetivo PND para consultar sus políticas.'
            );

            if (!objetivoId) {
                return;
            }

            const controlador = new AbortController();

            solicitud = controlador;

            try {

                const respuesta = await fetch(
                    `${basePoliticas}/${encodeURIComponent(objetivoId)}/politicas`,
                    {
                        signal: controlador.signal,
                        credentials: 'same-origin',
                        headers: {
                            'Accept': 'application/json'
                        }
                    }
                );

                if (!respuesta.ok) {
                    throw new Error('No se pudieron cargar las políticas.');
                }

                const registros = await respuesta.json();

                if (!Array.isArray(registros)) {
                    throw new Error('La respuesta no es válida.');
                }

                if (versionActual !== version) {
                    return;
                }

                textoSeleccionado.textContent = registros.length
                    ? 'Seleccione una política'
                    : 'No existen políticas disponibles';

                lista.replaceChildren();

                if (!registros.length) {

                    mostrarMensajeLista(
                        'No existen políticas disponibles para este objetivo.'
                    );

                    return;

                }

                registros.forEach(function (registro, indice) {

                    const textoCompleto = [
                        registro.codigo,
                        registro.nombre
                    ].filter(Boolean).join(' - ');

                    const etiqueta = document.createElement('label');

                    etiqueta.className =
                        'flex cursor-pointer items-start gap-3 rounded-md ' +
                        'px-3 py-3 hover:bg-blue-50';

                    const radio = document.createElement('input');

                    radio.type = 'radio';
                    radio.name = 'pnd_politica_id';
                    radio.id = `politicaPndOpcion-${indice}`;
                    radio.value = String(registro.id);
                    radio.required = true;

                    radio.className =
                        'mt-1 h-4 w-4 flex-shrink-0 border-gray-300 ' +
                        'text-blue-600 focus:ring-blue-500';

                    radio.checked = seleccionada != null
                        && String(registro.id) === String(seleccionada);

                    const texto = document.createElement('span');

                    texto.className =
                        'min-w-0 flex-1 whitespace-normal break-words ' +
                        'text-left text-sm leading-relaxed text-gray-700';

                    texto.textContent = textoCompleto;

                    etiqueta.append(radio, texto);
                    lista.append(etiqueta);

                    if (radio.checked) {
                        textoSeleccionado.textContent = textoCompleto;
                    }

                    radio.addEventListener('change', function () {

                        if (!radio.checked) {
                            return;
                        }

                        textoSeleccionado.textContent = textoCompleto;

                        mensaje.textContent = '';
                        selector.open = false;

                        resumen.focus({
                            preventScroll: true
                        });

                    });

                    // Abrir la lista si falta seleccionar una política.
                    radio.addEventListener('invalid', function () {

                        selector.open = true;

                        mensaje.textContent =
                            'Seleccione una política pública.';

                    });

                });

            } catch (error) {

                if (
                    error.name === 'AbortError'
                    || versionActual !== version
                ) {
                    return;
                }

                textoSeleccionado.textContent =
                    'No se pudieron cargar las políticas';

                mostrarMensajeLista(
                    'Vuelva a seleccionar el objetivo PND para intentar nuevamente.'
                );

                mensaje.textContent =
                    'No se pudieron cargar las políticas.';

            }

        }


        objetivo.addEventListener('change', function () {

            mostrarObjetivo();

            cargarPoliticas(objetivo.value);

        });


        // Impedir guardar mientras no exista una política seleccionada.
        formulario?.addEventListener('submit', function (evento) {

            const seleccionada = lista.querySelector(
                'input[name="pnd_politica_id"]:checked'
            );

            if (!seleccionada) {

                evento.preventDefault();

                mensaje.textContent =
                    'Seleccione una política pública antes de guardar.';

                selector.open = true;
                resumen.focus();

            }

        });


        mostrarObjetivo();

        if (objetivo.value) {
            cargarPoliticas(
                objetivo.value,
                politicaAnterior
            );
        }

    });
</script>