
            <!-- Estado -->
            <div class="border-b border-gray-200 bg-gray-100">

                <div class="px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        Estado de la meta
                    </h4>

                </div>

            </div>

            <div class="px-4 py-4">

                <div class="flex items-center">

                    <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                        Estado
                    </span>

                    @if($meta->estado === 'Activo')

                        <span class="rounded-full bg-green-100 px-2 py-1 text-xs text-green-700">
                            Habilitada
                        </span>

                    @else

                        <span class="rounded-full bg-red-100 px-2 py-1 text-xs text-red-700">
                            Deshabilitada
                        </span>

                    @endif

                    <a href="{{ route('metas.editarestado', $meta->id) }}"
                       class="ml-10 text-sm text-blue-600 hover:text-blue-800 hover:underline">

                        Editar

                    </a>

                </div>

            </div>

            <!-- Auditoría -->
            <div class="border-b border-gray-200 bg-gray-100">

                <div class="px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        Auditoría
                    </h4>

                </div>

            </div>

            <div class="px-4 py-4">

                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

                    <!-- Usuario creador -->
                    <div>

                        <p class="text-sm font-semibold text-gray-700">
                            Registrado por
                        </p>

                        <p class="mt-1 text-sm text-gray-600">

                            {{ $meta->usuario?->nombres
                                ?? $meta->usuario?->name
                                ?? 'No registra' }}

                            {{ $meta->usuario?->apellidos }}

                        </p>

                    </div>

                    <!-- Creación -->
                    <div>

                        <p class="text-sm font-semibold text-gray-700">
                            Fecha de creación
                        </p>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ $meta->created_at?->format('d/m/Y H:i') ?? 'No registra' }}
                        </p>

                    </div>

                    <!-- Actualización -->
                    <div>

                        <p class="text-sm font-semibold text-gray-700">
                            Última actualización
                        </p>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ $meta->updated_at?->format('d/m/Y H:i') ?? 'No registra' }}
                        </p>

                    </div>

                </div>

            </div>