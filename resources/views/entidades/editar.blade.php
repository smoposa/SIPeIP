<x-entidades-layout title="Editar Entidad">

    @if(session('success'))
        <div id="alertSuccess"
             class="fixed top-5 right-5 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">

            {{ session('success') }}

        </div>

        <script>
            setTimeout(() => {
                const alerta = document.getElementById('alertSuccess');

                if (alerta) {
                    alerta.remove();
                }
            }, 3000);
        </script>
    @endif


    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-0">

        <div class="flex">

            <a href="{{ route('entidades.detalle', $entidad->id) }}"
               class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">

                <i class="bi bi-chevron-left"></i>
                Regresar

            </a>

        </div>

    </div>


    <!-- Información -->
    <div class="bg-white p-6 shadow-sm">

        <!-- Encabezado -->
        <div class="mb-6">

            <h2 class="text-2xl font-semibold text-gray-800">
                Actualizar información de la entidad
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                A continuación puede actualizar los datos de la entidad.
            </p>

        </div>


        <!-- Validaciones -->
        @if ($errors->any())

            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">

                <ul class="list-disc list-inside text-sm text-red-700">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        <!-- Scroll del contenido -->
        <div class="overflow-y-auto"
             style="height: calc(100vh - 300px);">

            <form method="POST"
                  action="{{ route('entidades.update', $entidad->id) }}">

                @csrf
                @method('PUT')


                <!-- Campos del formulario -->
                @include('entidades.partials.form')


                <!-- Botones -->
                <div class="flex mt-6">

                    <div class="w-48 flex-shrink-0"></div>

                    <div class="w-2/3 flex justify-end gap-3">

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">

                            Actualizar

                        </button>

                        <a href="{{ route('entidades.detalle', $entidad->id) }}"
                           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">

                            Cancelar

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

</x-entidades-layout>