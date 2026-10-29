<x-programas-layout title="Editar programa">

    <!-- Migas de pan -->
    <x-slot name="breadcrumbs">

        <nav aria-label="Migas de pan">

            <ol class="flex flex-wrap items-center gap-2 text-xs">

                <li>
                    <a href="{{ route('programas.listar') }}"
                       class="text-gray-500 hover:text-blue-600">
                        Programas de inversión
                    </a>
                </li>

                <li aria-hidden="true" class="text-gray-400">/</li>

                <li>
                    <a href="{{ route('programas.detalle', $programa->id) }}"
                       class="text-gray-500 hover:text-blue-600">
                        Detalle del programa
                    </a>
                </li>

                <li aria-hidden="true" class="text-gray-400">/</li>

                <li aria-current="page"
                    class="font-medium text-gray-700">
                    Editar programa
                </li>

            </ol>

        </nav>

    </x-slot>


    <!-- Notificaciones -->
    @include('programas.partials.avisos')


    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-0">

        <div class="flex gap-6">

            <a href="{{ route('programas.detalle', $programa->id) }}"
               class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">

                <i class="bi bi-chevron-left" aria-hidden="true"></i>
                Regresar

            </a>

        </div>

    </div>


    <!-- Información -->
    <div class="bg-white p-6 shadow-sm">

        <!-- Encabezado -->
        <div class="mb-6">

            <h2 class="text-2xl font-semibold text-gray-800">
                Actualizar información del programa
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                A continuación puede actualizar los datos generales
                y la alineación estratégica del programa.
            </p>

        </div>


        <!-- Validaciones -->
        @if($errors->any())

            <div role="alert"
                 class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">

                <ul class="list-disc list-inside text-sm text-red-700">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        <!-- Scroll -->
        <div class="overflow-y-auto"
             style="height: calc(100vh - 300px);">

            <form method="POST"
                  action="{{ route('programas.update', $programa->id) }}">

                @csrf
                @method('PUT')


                <!-- Campos -->
                @include('programas.partials.form-editar')


                <!-- Botones -->
                <div class="flex justify-end gap-3 mt-10 pr-8">

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">

                        Actualizar

                    </button>


                    <a href="{{ route('programas.detalle', $programa->id) }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">

                        Cancelar

                    </a>

                </div>

            </form>

        </div>

    </div>

</x-programas-layout>