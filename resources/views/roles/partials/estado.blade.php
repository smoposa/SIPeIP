<!-- Estado del rol -->
<div class="bg-gray-100 border-b border-gray-200">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Estado del rol
        </h4>

    </div>

</div>


<!-- Estado actual -->
<div class="px-4 py-4">

    <div class="flex flex-wrap items-center gap-y-2">

        <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
            Estado
        </span>

        <span class="px-2 py-1 text-xs rounded-full {{
            $rol->estado === 'Activo'
                ? 'bg-green-100 text-green-700'
                : 'bg-red-100 text-red-700'
        }}">
            {{ $rol->estado }}
        </span>


        @if(puedeHacer('roles', 'estado'))

            <a href="{{ route('roles.estado', $rol->id) }}"
               data-editar-estado-rol
               class="ml-10 text-sm text-blue-600
                      hover:text-blue-800 hover:underline">

                Editar

            </a>

        @endif

    </div>

</div>