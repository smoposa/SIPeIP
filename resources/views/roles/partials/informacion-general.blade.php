<!-- Cabecera del rol -->
<div class="flex min-w-0 items-center gap-4 mb-0 pb-6">

    <div class="w-16 h-16 flex-shrink-0 rounded-full bg-[#c8b112]
                flex items-center justify-center
                text-white text-3xl">

        <i class="bi bi-key-fill" aria-hidden="true"></i>

    </div>


    <div class="min-w-0">

        <h2 class="break-words text-xl font-semibold text-gray-800">
            {{ $rol->nombre }}
        </h2>

        <p class="break-words text-gray-500">
            {{ \Illuminate\Support\Str::limit(
                $rol->descripcion ?? 'Sin descripción registrada',
                55
            ) }}
        </p>

    </div>

</div>


<!-- Información general -->
<div class="bg-gray-100 border-b border-gray-200">

    <div class="flex justify-between items-center px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Información general
        </h4>


        @if(puedeHacer('roles', 'editar'))

            <a href="{{ route('roles.edit', $rol->id) }}"
               data-editar-rol
               class="text-sm text-blue-600
                      hover:text-blue-800 hover:underline">

                Editar

            </a>

        @endif

    </div>

</div>


<!-- Datos del rol -->
<div class="px-4 py-5">

    <dl class="min-w-0 space-y-5">

        <!-- Nombre -->
        <div class="flex min-w-0 items-start gap-4">

            <dt class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                Nombre
            </dt>

            <dd class="min-w-0 flex-1 break-words text-sm text-gray-600">
                {{ $rol->nombre }}
            </dd>

        </div>


        <!-- Descripción -->
        <div class="flex min-w-0 items-start gap-4">

            <dt class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
                Descripción
            </dt>

            <dd class="min-w-0 flex-1 whitespace-pre-line break-words text-sm leading-6 text-gray-600">{{ $rol->descripcion ?: 'No se ha registrado una descripción para este rol.' }}</dd>

        </div>

    </dl>

</div>