<!-- Cabecera de la entidad -->
<div class="flex items-center gap-4 mb-0 pb-6">

    <div class="w-16 h-16 flex-shrink-0 rounded-full bg-[#024687]
                flex items-center justify-center
                text-white text-3xl">

        <i class="bi bi-building" aria-hidden="true"></i>

    </div>


    <div class="min-w-0">

        <h2 class="break-words text-xl font-semibold text-gray-800">
            {{ $entidad->nombre }}
        </h2>

        <p class="break-words text-gray-500">
            {{ $entidad->siglas ?: 'Sin siglas' }}
        </p>

    </div>

</div>


<!-- Información básica -->
<div class="bg-gray-100 border-b border-gray-200">

    <div class="flex justify-between items-center px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Información básica
        </h4>


        @if(puedeHacer('entidades', 'editar'))

            <button
                type="button"
                data-editar-entidad
                aria-haspopup="dialog"
                aria-controls="panelEditarEntidad"
                class="text-sm text-blue-600
                       hover:text-blue-800 hover:underline">

                Editar

            </button>

        @endif

    </div>

</div>


@php
    $datosEntidad = [
        'Código Institucional' => $entidad->codigoInstitucional,
        'RUC' => $entidad->ruc,
        'Provincia' => $entidad->provincia,
        'Tipo de Entidad' => $entidad->tipoEntidad,
        'Cantón' => $entidad->canton,
        'Nivel de Gobierno' => $entidad->nivelGobierno,
        'Parroquia' => $entidad->parroquia,
        'Teléfono' => $entidad->telefono,
        'Dirección' => $entidad->direccion,
        'Correo Institucional' => $entidad->correoInstitucional,
    ];
@endphp


<!-- Datos de la entidad -->
<div class="px-4 py-2">

    <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-4 mb-6">

        @foreach($datosEntidad as $etiqueta => $valor)

            <div class="flex min-w-0 items-start">

                <dt class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                    {{ $etiqueta }}
                </dt>

                <dd class="min-w-0 flex-1 break-words text-sm text-gray-600">
                    {{ filled($valor) ? $valor : 'No registra' }}
                </dd>

            </div>

        @endforeach

    </dl>

</div>