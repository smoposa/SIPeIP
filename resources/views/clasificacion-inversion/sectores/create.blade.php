<x-catalogos-layout title="Nuevo sector">

    <div class="mx-auto max-w-3xl space-y-5">

        {{-- Encabezado --}}
        <div class="rounded-lg border border-gray-200 bg-white">

            <div class="flex items-center gap-3 px-5 py-4">

                <div class="flex h-11 w-11 flex-shrink-0 items-center
                            justify-center rounded-lg border border-gray-200
                            bg-gray-100">

                    <i class="bi bi-diagram-2 text-xl text-gray-600"></i>

                </div>

                <div>

                    <p class="text-xs font-medium uppercase
                              tracking-wide text-gray-400">
                        Clasificación de la inversión
                    </p>

                    <h3 class="text-lg font-semibold text-gray-800">
                        Registrar sector
                    </h3>

                    <p class="mt-0.5 text-sm text-gray-500">
                        Registre un sector y relaciónelo con su macrosector.
                    </p>

                </div>

            </div>

        </div>

        {{-- Errores generales --}}
        @if($errors->any())

            <div
                class="rounded-lg border border-red-200
                       bg-red-50 px-4 py-3"
                role="alert"
            >
                <div class="flex items-start gap-3">

                    <i class="bi bi-exclamation-circle
                              mt-0.5 text-red-600"></i>

                    <div>

                        <p class="text-sm font-medium text-red-700">
                            No se pudo registrar el sector.
                        </p>

                        <p class="mt-1 text-xs text-red-600">
                            Revise los campos señalados e intente nuevamente.
                        </p>

                    </div>

                </div>

            </div>

        @endif

        {{-- Formulario --}}
        <div class="rounded-lg border border-gray-200 bg-white">

            <form
                method="POST"
                action="{{ route(
                    'clasificacion-inversion.sectores.store'
                ) }}"
            >
                @csrf

                <div class="p-5">

                    @include(
                        'clasificacion-inversion.sectores.partials.form'
                    )

                </div>

                <div class="flex flex-col-reverse gap-2
                            border-t border-gray-200 bg-gray-50
                            px-5 py-4 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('clasificacion-inversion.index') }}"
                        class="inline-flex items-center justify-center gap-2
                               rounded-md border border-gray-300 bg-white
                               px-4 py-2 text-sm font-medium text-gray-700
                               transition hover:bg-gray-100"
                    >
                        <i class="bi bi-arrow-left"></i>

                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2
                               rounded-md bg-blue-600 px-4 py-2
                               text-sm font-medium text-white
                               transition hover:bg-blue-700"
                    >
                        <i class="bi bi-check-lg"></i>

                        Guardar sector
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-catalogos-layout>