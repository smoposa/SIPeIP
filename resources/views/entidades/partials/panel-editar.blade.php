@php
    $recuperarFormulario =
        (string) old('_entidad_form', '') === (string) $entidad->id;

    $camposEntidad = [
        'codigoInstitucional' => [
            'etiqueta' => 'Código institucional',
            'tipo' => 'text',
            'maximo' => 50,
            'obligatorio' => true,
        ],
        'ruc' => [
            'etiqueta' => 'RUC',
            'tipo' => 'text',
            'maximo' => 13,
            'obligatorio' => true,
        ],
        'nombre' => [
            'etiqueta' => 'Nombre de la entidad',
            'tipo' => 'text',
            'maximo' => 255,
            'obligatorio' => true,
        ],
        'siglas' => [
            'etiqueta' => 'Siglas',
            'tipo' => 'text',
            'maximo' => 50,
            'obligatorio' => false,
        ],
        'tipoEntidad' => [
            'etiqueta' => 'Tipo de entidad',
            'tipo' => 'select',
            'obligatorio' => true,
            'opciones' => [
                'Secretaría',
                'Ministerio',
                'GAD Provincial',
                'GAD Municipal',
                'GAD Parroquial',
            ],
        ],
        'nivelGobierno' => [
            'etiqueta' => 'Nivel de gobierno',
            'tipo' => 'select',
            'obligatorio' => true,
            'opciones' => [
                'Central',
                'Provincial',
                'Municipal',
                'Parroquial',
            ],
        ],
        'provincia' => [
            'etiqueta' => 'Provincia',
            'tipo' => 'text',
            'maximo' => 100,
            'obligatorio' => true,
        ],
        'canton' => [
            'etiqueta' => 'Cantón',
            'tipo' => 'text',
            'maximo' => 100,
            'obligatorio' => true,
        ],
        'parroquia' => [
            'etiqueta' => 'Parroquia',
            'tipo' => 'text',
            'maximo' => 100,
            'obligatorio' => false,
        ],
        'telefono' => [
            'etiqueta' => 'Teléfono',
            'tipo' => 'text',
            'maximo' => 30,
            'obligatorio' => false,
        ],
        'correoInstitucional' => [
            'etiqueta' => 'Correo institucional',
            'tipo' => 'email',
            'maximo' => 255,
            'obligatorio' => false,
        ],
        'direccion' => [
            'etiqueta' => 'Dirección',
            'tipo' => 'textarea',
            'maximo' => 255,
            'obligatorio' => false,
        ],
    ];

    $claseCampoEntidad = 'mt-1 w-full rounded-md border border-gray-300
                         px-3 py-2 text-sm text-gray-700
                         focus:border-blue-500 focus:ring-blue-500';
@endphp


@if(puedeHacer('entidades', 'editar'))

    <!-- Panel lateral de edición -->
    <dialog
        id="panelEditarEntidad"
        aria-labelledby="tituloPanelEditarEntidad"
        class="bg-white p-0 shadow-xl"
        style="position: fixed; inset: 0 0 0 auto; margin: 0 0 0 auto;
               width: min(100%, 480px); height: 100dvh;
               max-width: 100%; max-height: none; border: 0;">

        <form
            id="formularioEditarEntidad"
            method="POST"
            action="{{ route('entidades.update', $entidad->id) }}"
            class="flex h-full flex-col">

            @csrf
            @method('PUT')

            <input
                type="hidden"
                name="_entidad_form"
                value="{{ $entidad->id }}">


            <!-- Encabezado -->
            <div class="flex shrink-0 items-center justify-between gap-4
                        border-b border-gray-200 px-6 py-4">

                <div class="min-w-0">

                    <h2 id="tituloPanelEditarEntidad"
                        class="text-xl font-semibold text-gray-800">

                        Editar entidad

                    </h2>

                    <p class="mt-1 break-words text-sm text-gray-500">
                        {{ $entidad->nombre }}
                    </p>

                </div>


                <!-- Cerrar panel -->
                <button
                    type="button"
                    data-cerrar-panel-entidad
                    aria-label="Cerrar panel"
                    class="shrink-0 p-2 text-gray-500
                           hover:bg-gray-100 hover:text-gray-800">

                    <i class="bi bi-x-lg" aria-hidden="true"></i>

                </button>

            </div>


            <!-- Contenido del formulario -->
            <div class="min-h-0 flex-1 overflow-y-auto px-6 py-5">

                <!-- Errores de validación -->
                @if($recuperarFormulario && $errors->any())

                    <div
                        id="erroresPanelEntidad"
                        role="alert"
                        class="mb-5 rounded-md bg-red-50 px-4 py-3
                               text-sm text-red-800">

                        <p class="mb-2 font-semibold">
                            Revise los datos ingresados:
                        </p>

                        <ul class="list-inside list-disc">

                            @foreach($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <p class="mb-5 text-xs text-gray-500">
                    Los campos con
                    <span class="text-red-500">*</span>
                    son obligatorios.
                </p>


                <!-- Campos de la entidad -->
                <div class="space-y-5">

                    @foreach($camposEntidad as $nombreCampo => $campo)

                        @php
                            $valorCampo = $recuperarFormulario
                                ? old($nombreCampo)
                                : $entidad->{$nombreCampo};

                            $idCampo = 'editarEntidad_' . $nombreCampo;
                        @endphp

                        <div>

                            <label for="{{ $idCampo }}"
                                   class="block text-sm font-medium text-gray-700">

                                {{ $campo['etiqueta'] }}

                                @if($campo['obligatorio'])

                                    <span class="text-red-500">*</span>

                                @endif

                            </label>


                            @if($campo['tipo'] === 'select')

                                <select
                                    id="{{ $idCampo }}"
                                    name="{{ $nombreCampo }}"
                                    @required($campo['obligatorio'])
                                    class="{{ $claseCampoEntidad }}">

                                    <option value="">Seleccione</option>

                                    <!-- Conservar valores existentes fuera de la lista -->
                                    @if(
                                        filled($valorCampo)
                                        && !in_array($valorCampo, $campo['opciones'], true)
                                    )

                                        <option value="{{ $valorCampo }}" selected>
                                            {{ $valorCampo }}
                                        </option>

                                    @endif

                                    @foreach($campo['opciones'] as $opcion)

                                        <option value="{{ $opcion }}"
                                                @selected($valorCampo === $opcion)>

                                            {{ $opcion }}

                                        </option>

                                    @endforeach

                                </select>

                            @elseif($campo['tipo'] === 'textarea')

                                <textarea
                                    id="{{ $idCampo }}"
                                    name="{{ $nombreCampo }}"
                                    rows="3"
                                    maxlength="{{ $campo['maximo'] }}"
                                    @required($campo['obligatorio'])
                                    class="{{ $claseCampoEntidad }}">{{ $valorCampo }}</textarea>

                            @else

                                <input
                                    type="{{ $campo['tipo'] }}"
                                    id="{{ $idCampo }}"
                                    name="{{ $nombreCampo }}"
                                    value="{{ $valorCampo }}"
                                    maxlength="{{ $campo['maximo'] }}"
                                    @required($campo['obligatorio'])
                                    class="{{ $claseCampoEntidad }}">

                            @endif


                            @if($recuperarFormulario)

                                <x-input-error
                                    :messages="$errors->get($nombreCampo)"
                                    class="mt-1" />

                            @endif

                        </div>

                    @endforeach

                </div>

            </div>


            <!-- Acciones -->
            <div class="flex shrink-0 flex-wrap justify-end gap-3
                        border-t border-gray-200 bg-white px-6 py-4">

                <!-- Guardar cambios -->
                <button
                    type="submit"
                    class="inline-flex h-10 items-center justify-center gap-2
                           rounded-md bg-[#024687] px-5 text-sm
                           font-medium text-white transition hover:bg-[#01325f]
                           focus:outline-none focus:ring-2 focus:ring-blue-600
                           focus:ring-offset-2">

                    <i class="bi bi-check-circle" aria-hidden="true"></i>
                    Guardar cambios

                </button>


                <!-- Cancelar -->
                <button
                    type="button"
                    data-cerrar-panel-entidad
                    class="inline-flex h-10 items-center justify-center
                           rounded-md bg-gray-200 px-5 text-sm
                           font-medium text-gray-700 transition hover:bg-gray-300
                           focus:outline-none focus:ring-2 focus:ring-gray-400
                           focus:ring-offset-2">

                    Cancelar

                </button>

            </div>

        </form>

    </dialog>


    <style>
        #panelEditarEntidad::backdrop {
            background: rgb(0 0 0 / 20%);
        }
    </style>

@endif