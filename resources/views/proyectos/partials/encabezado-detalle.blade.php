<!-- Cabecera del proyecto -->
<div class="flex items-center gap-4 mb-0 pb-6">

    <div class="w-16 h-16 flex-shrink-0 rounded-full bg-[#2563EB]
                flex items-center justify-center text-white text-4xl">

        <i class="bi bi-kanban" aria-hidden="true"></i>

    </div>


    <div class="min-w-0">

        <h2 class="break-words text-xl font-semibold text-gray-800">
            {{ $proyecto->nombre }}
        </h2>

        <p class="text-gray-500">
            {{ $proyecto->codigo }}
        </p>

        <p class="mt-1 text-sm text-gray-500">
            {{ $proyecto->entidad?->nombre ?? 'Entidad no registrada' }}
        </p>

    </div>

</div>