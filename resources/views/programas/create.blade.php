<x-programas-layout title="Crear programa">

    <div class="mx-auto max-w-5xl space-y-5">

        {{-- Encabezado --}}
        <div class="rounded-lg border border-gray-200 bg-white">

            <div class="flex flex-col gap-4 px-5 py-4
                        sm:flex-row sm:items-center sm:justify-between">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 flex-shrink-0 items-center
                                justify-center rounded-lg border
                                border-gray-200 bg-gray-100">

                        <i class="bi bi-collection text-xl text-gray-600"></i>

                    </div>

                    <div>

                        <p class="text-xs font-medium uppercase
                                  tracking-wide text-gray-400">
                            Inversión pública
                        </p>

                        <h2 class="text-lg font-semibold text-gray-800">
                            Registrar programa de inversión
                        </h2>

                        <p class="mt-0.5 text-sm text-gray-500">
                            Registre el programa y alinéelo con la
                            planificación institucional de la entidad.
                        </p>

                    </div>

                </div>

                <a
                    href="{{ route('programas.listar') }}"
                    class="inline-flex items-center justify-center gap-2
                           rounded-md border border-gray-300 bg-white
                           px-4 py-2 text-sm font-medium text-gray-700
                           transition hover:bg-gray-50"
                >
                    <i class="bi bi-arrow-left"></i>

                    Regresar
                </a>

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
                            No se pudo registrar el programa.
                        </p>

                        <p class="mt-1 text-xs text-red-600">
                            Revise los campos señalados e intente nuevamente.
                        </p>

                    </div>

                </div>

            </div>

        @endif

        {{-- Formulario --}}
        <form
            method="POST"
            action="{{ route('programas.store') }}"
        >
            @csrf

            <div
                class="overflow-y-auto pr-1"
                style="height: calc(100vh - 220px); min-height: 420px;"
            >
                @include(
                    'programas.partials.contexto-planificacion'
                )

                @include(
                    'programas.partials.informacion-general'
                )

                @include(
                    'programas.partials.estado'
                )

                @include(
                    'programas.partials.acciones'
                )
            </div>

        </form>

    </div>

</x-programas-layout>