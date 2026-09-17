<x-planes-layout title="Crear Plan Institucional">

    @if(session('success'))

        <div id="alertSuccess"
             class="fixed right-5 top-5 z-50 rounded-lg bg-green-600 px-6 py-3 text-white shadow-lg">

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

    @include('planes.partials.modal-exito')

    <div class="min-w-0 max-w-full bg-white p-6 shadow-sm">

        <!-- Encabezado -->
        <div class="mb-4">

            <h2 class="text-2xl font-semibold leading-tight text-gray-800">
                Registrar un nuevo plan institucional
            </h2>

            <a href="{{ route('planes.listar') }}"
               class="mt-0.5 inline-flex items-center text-sm font-medium
                      text-blue-600 hover:text-blue-800">

                <i class="bi bi-arrow-left-short mr-1 text-lg"></i>

                Regresar

            </a>

        </div>

        <!-- Validaciones -->
        @if($errors->any())

            <div class="mb-5 rounded-lg border border-red-300 bg-red-50 p-4">

                <p class="mb-2 text-sm font-semibold text-red-700">
                    Revise los siguientes campos:
                </p>

                <ul class="list-inside list-disc text-sm text-red-700">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif

        @if(session('error'))

            <div class="mb-5 rounded-lg border border-red-300 bg-red-50 p-4
                        text-sm text-red-700">

                {{ session('error') }}

            </div>

        @endif

        <!-- Contenido con desplazamiento vertical -->
        <div class="w-full min-w-0 max-w-full overflow-y-auto overflow-x-hidden"
             style="height: calc(100vh - 190px);">

            <form method="POST"
                  action="{{ route('planes.store') }}"
                  class="w-full min-w-0 max-w-full">

                @csrf

                @include('planes.partials.barra-progreso')

                @include('planes.partials.informacion-general')

                @include('planes.partials.acciones')

            </form>

        </div>

    </div>

</x-planes-layout>