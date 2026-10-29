<!-- Encabezado -->
<div class="bg-gray-100 border-b border-gray-200">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Estado
        </h4>

    </div>

</div>


<!-- Estado del registro -->
<div class="px-4 py-4">

    <div class="flex items-start mb-6">

        <span class="w-40 flex-shrink-0 text-sm font-semibold text-gray-700">
            Estado del registro
        </span>

        <div class="min-w-0 flex-1">

            <div class="flex flex-wrap items-center gap-x-10 gap-y-2">

                @if($presupuesto->estado === 'Cerrado')

                    <span class="inline-flex rounded-full bg-green-100 px-2 py-1
                                 text-xs text-green-700">
                        Cerrado
                    </span>

                @elseif($presupuesto->estado === 'Borrador')

                    <span class="inline-flex rounded-full bg-gray-100 px-2 py-1
                                 text-xs text-gray-700">
                        Borrador
                    </span>

                @else

                    <span class="text-sm text-gray-600">
                        {{ $presupuesto->estado ?: 'Sin estado' }}
                    </span>

                @endif


                @if($presupuesto->estado === 'Borrador' && puedeHacer('presupuestos', 'editar'))

                    <a href="{{ route('presupuestos.edit', $presupuesto) }}"
                       class="text-sm text-blue-600 hover:text-blue-800 hover:underline">
                        Editar
                    </a>

                @endif

            </div>


            @if($presupuesto->estado === 'Cerrado')

                <p class="mt-2 text-xs text-gray-500">
                    El registro está cerrado y no puede modificarse.
                </p>

            @endif

        </div>

    </div>

</div>