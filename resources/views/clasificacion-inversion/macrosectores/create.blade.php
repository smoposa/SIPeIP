<x-catalogos-layout title="Nuevo macrosector">

    <div class="mx-auto max-w-3xl space-y-4">

        <!-- Barra de acciones -->
        <div class="flex items-center justify-between">

            <a
                href="{{ route('clasificacion-inversion.index') }}"
                class="inline-flex items-center gap-2 rounded-md
                       border border-gray-300 bg-white px-4 py-2
                       text-sm font-medium text-gray-700
                       transition hover:bg-gray-50"
            >
                <i class="bi bi-arrow-left"></i>

                Regresar
            </a>

        </div>


        <!-- Encabezado -->
        <div class="rounded-lg border border-gray-200 bg-white">

            <div class="flex items-center gap-3 px-5 py-4">

                <div class="flex h-11 w-11 flex-shrink-0 items-center
                            justify-center rounded-lg border border-gray-200
                            bg-gray-100">

                    <i class="bi bi-grid-1x2 text-xl text-gray-600"></i>

                </div>

                <div>

                    <p class="text-xs font-medium uppercase
                              tracking-wide text-gray-400">
                        Clasificación de la inversión
                    </p>

                    <h3 class="text-lg font-semibold text-gray-800">
                        Registrar macrosector
                    </h3>

                    <p class="mt-0.5 text-sm text-gray-500">
                        Cree el nivel principal de la clasificación
                        de intervención pública.
                    </p>

                </div>

            </div>

        </div>


        <!-- Errores generales -->
        @if($errors->any())

            <div class="rounded-md border border-red-200
                        bg-red-50 px-4 py-3">

                <div class="flex items-start gap-2">

                    <i class="bi bi-exclamation-circle
                              mt-0.5 text-red-500"></i>

                    <div>

                        <p class="text-sm font-medium text-red-700">
                            Revise la información ingresada.
                        </p>

                        <p class="mt-0.5 text-xs text-red-600">
                            Existen campos que necesitan ser corregidos.
                        </p>

                    </div>

                </div>

            </div>

        @endif


        <!-- Formulario -->
        <form
            method="POST"
            action="{{ route('clasificacion-inversion.macrosectores.store') }}"
            class="rounded-lg border border-gray-200 bg-white"
        >

            @csrf

            <div class="space-y-5 p-5">

                @include(
                    'clasificacion-inversion.macrosectores.partials.form'
                )

            </div>


            <!-- Acciones -->
            <div class="flex items-center justify-end gap-3
                        border-t border-gray-200 bg-gray-50
                        px-5 py-3">

                <a
                    href="{{ route('clasificacion-inversion.index') }}"
                    class="rounded-md border border-gray-300
                           bg-white px-4 py-2 text-sm font-medium
                           text-gray-700 transition hover:bg-gray-100"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center gap-2 rounded-md
                           bg-blue-600 px-4 py-2 text-sm font-medium
                           text-white transition hover:bg-blue-700"
                >
                    <i class="bi bi-check-lg"></i>

                    Guardar macrosector
                </button>

            </div>

        </form>

    </div>

</x-catalogos-layout>