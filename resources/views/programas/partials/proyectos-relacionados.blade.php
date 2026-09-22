<!-- Proyectos relacionados -->
<div class="mt-4 border-b border-gray-200 bg-gray-100">

    <div class="flex items-center justify-between px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Proyectos relacionados
        </h4>

        <span class="rounded-full bg-blue-100 px-3 py-1
                     text-xs font-semibold text-blue-700">

            {{ $programa->proyectos->count() }}
            {{ $programa->proyectos->count() === 1 ? 'proyecto' : 'proyectos' }}

        </span>

    </div>

</div>

<div class="px-4 py-5">

    @forelse($programa->proyectos as $proyecto)

        <div class="mb-3 rounded-md border border-gray-200
                    bg-gray-50 px-4 py-3 last:mb-0">

            <div class="flex flex-col justify-between gap-3
                        lg:flex-row lg:items-start">

                <div class="min-w-0 flex-1">

                    <!-- Código y estado -->
                    <div class="flex flex-wrap items-center gap-2">

                        <p class="font-mono text-xs font-semibold text-[#024687]">
                            {{ $proyecto->codigo ?? 'Sin código' }}
                        </p>

                        @if($proyecto->estado === 'Activo')

                            <span class="rounded-full bg-green-100 px-2.5 py-1
                                         text-xs font-medium text-green-700">
                                Activo
                            </span>

                        @else

                            <span class="rounded-full bg-red-100 px-2.5 py-1
                                         text-xs font-medium text-red-700">
                                Inactivo
                            </span>

                        @endif

                    </div>

                    <!-- Nombre -->
                    <p class="mt-1 break-words text-sm font-medium text-gray-800">
                        {{ $proyecto->nombre ?? 'No registra' }}
                    </p>

                    <!-- Información complementaria -->
                    <div class="mt-2 space-y-1 text-xs text-gray-500">

                        <p>
                            <span class="font-semibold text-gray-600">
                                Período:
                            </span>

                            @if($proyecto->periodo_inicio && $proyecto->periodo_fin)

                                {{ $proyecto->periodo_inicio }}
                                -
                                {{ $proyecto->periodo_fin }}

                            @else

                                No registra

                            @endif
                        </p>

                        <p>
                            <span class="font-semibold text-gray-600">
                                Estado del proceso:
                            </span>

                            {{ $proyecto->estado_proceso ?? 'No registra' }}
                        </p>

                        <p>
                            <span class="font-semibold text-gray-600">
                                Responsable:
                            </span>

                            {{ $proyecto->responsable?->name ?? 'No registra' }}
                        </p>

                    </div>

                </div>

                <!-- Ver detalle -->
                <a href="{{ route('proyectos.detalle', $proyecto->id) }}"
                   class="inline-flex items-center justify-center rounded-md
                          border border-blue-200 px-3 py-2 text-sm
                          font-medium text-blue-700 hover:bg-blue-50">

                    <i class="bi bi-eye me-2"></i>
                    Ver detalle

                </a>

            </div>

        </div>

    @empty

        <div class="rounded-lg border border-dashed border-gray-300
                    bg-gray-50 px-6 py-8 text-center">

            <div class="mx-auto flex h-12 w-12 items-center
                        justify-center rounded-full bg-blue-100
                        text-xl text-blue-600">

                <i class="bi bi-folder-plus"></i>

            </div>

            <p class="mt-3 text-sm font-semibold text-gray-700">
                No existen proyectos registrados en este programa.
            </p>

            <p class="mt-1 text-sm text-gray-500">
                Registre el primer proyecto para continuar con la inversión pública.
            </p>

            @if(puedeVer('proyectos') && $programa->estado === 'Activo')

                <a href="{{ route(
                    'proyectos.create',
                    ['programa_id' => $programa->id]
                ) }}"
                   class="mt-4 inline-flex items-center rounded-md
                          bg-blue-600 px-4 py-2 text-sm font-medium
                          text-white hover:bg-blue-700">

                    <i class="bi bi-plus-lg me-2"></i>
                    Registrar primer proyecto

                </a>

            @endif

        </div>

    @endforelse

</div>