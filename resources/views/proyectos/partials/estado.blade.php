<div class="mb-6 rounded-lg border border-gray-200 bg-white p-6">

    <h3 class="mb-5 text-lg font-semibold text-gray-800">
        Estados del proyecto
    </h3>

    @if (isset($proyecto))

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

            {{-- Estado de ejecución --}}
            <div>
                <label for="estado"
                    class="mb-1 block text-sm font-medium text-gray-700">

                    Estado de ejecución
                    <span class="text-red-500">*</span>
                </label>

                <select
                    id="estado"
                    name="estado"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                    @foreach ($estadosEjecucion as $estado)
                        <option
                            value="{{ $estado->value }}"
                            @selected(
                                old(
                                    'estado',
                                    $proyecto->estado
                                ) === $estado->value
                            )>

                            {{ $estado->value }}
                        </option>
                    @endforeach

                </select>

                @error('estado')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Estado administrativo --}}
            <div>
                <p class="mb-1 text-sm font-medium text-gray-700">
                    Estado administrativo
                </p>

                <div class="rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-sm text-gray-700">
                    {{ $proyecto->estado_administrativo }}
                </div>

                <p class="mt-1 text-xs text-gray-500">
                    Se gestiona desde el detalle del proyecto.
                </p>
            </div>

            {{-- Estado del proceso --}}
            <div>
                <p class="mb-1 text-sm font-medium text-gray-700">
                    Estado del proceso
                </p>

                <div class="rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-sm text-gray-700">
                    {{ $proyecto->estado_proceso }}
                </div>

                <p class="mt-1 text-xs text-gray-500">
                    Se gestiona desde el detalle del proyecto.
                </p>
            </div>

        </div>

    @else

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

            <div class="rounded-md border border-gray-200 bg-gray-50 p-4">
                <p class="text-xs font-medium uppercase text-gray-500">
                    Ejecución inicial
                </p>

                <p class="mt-1 text-sm font-semibold text-gray-800">
                    Planificado
                </p>
            </div>

            <div class="rounded-md border border-gray-200 bg-gray-50 p-4">
                <p class="text-xs font-medium uppercase text-gray-500">
                    Estado administrativo
                </p>

                <p class="mt-1 text-sm font-semibold text-green-700">
                    Activo
                </p>
            </div>

            <div class="rounded-md border border-gray-200 bg-gray-50 p-4">
                <p class="text-xs font-medium uppercase text-gray-500">
                    Estado del proceso
                </p>

                <p class="mt-1 text-sm font-semibold text-gray-800">
                    Borrador
                </p>
            </div>

        </div>

    @endif

</div>