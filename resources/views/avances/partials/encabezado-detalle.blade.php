<!-- Cabecera del avance -->
<div class="flex flex-wrap items-center justify-between gap-4 pb-6">

    <div class="flex min-w-0 items-center gap-4">

        <div class="w-16 h-16 flex-shrink-0 rounded-full bg-[#0F766E]
                    flex items-center justify-center
                    text-white text-3xl">

            <i class="bi bi-graph-up-arrow" aria-hidden="true"></i>

        </div>


        <div class="min-w-0">

            <h2 class="break-words text-xl font-semibold text-gray-800">
                Avance físico
            </h2>

            <p class="break-words text-gray-500">
                {{ $avance->proyecto?->codigo ?? 'Sin código de proyecto' }}
                ·
                Período {{ $avance->periodo }} - {{ $avance->anio }}
            </p>

            <p class="mt-1 break-words text-sm text-gray-500">
                {{ $avance->proyecto?->nombre ?? 'Proyecto no registrado' }}
            </p>

        </div>

    </div>


    <!-- Estado -->
    <div class="ml-auto flex-shrink-0 text-right">

        <p class="text-xs text-gray-500">
            Estado
        </p>

        <span class="inline-flex mt-1 px-3 py-1
                     text-sm font-semibold rounded-md {{
                         $avance->estado === 'Cerrado'
                             ? 'bg-green-100 text-green-700'
                             : 'bg-gray-100 text-gray-700'
                     }}">

            {{ $avance->estado }}

        </span>

    </div>

</div>