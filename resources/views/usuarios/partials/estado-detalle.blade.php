<!-- Encabezado de estado -->
<div class="bg-gray-100 border-b border-gray-200">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Estado
        </h4>

    </div>

</div>


<!-- Estado del usuario -->
<div class="px-4 py-2">

    <div class="flex items-center mb-8">

        <span class="w-40 text-sm font-semibold text-gray-700">
            Estado del usuario
        </span>


        @if($usuario->estado == 'Activo')

            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                Habilitado
            </span>

        @else

            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">
                Deshabilitado
            </span>

        @endif


        @if(puedeHacer('usuarios', 'estado'))

            <a href="{{ route('usuarios.estado', $usuario->id) }}"
               class="ml-10 text-sm text-blue-600
                      hover:text-blue-800 hover:underline">

                Editar

            </a>

        @endif

    </div>

</div>