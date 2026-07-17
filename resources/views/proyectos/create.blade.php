<x-proyectos-layout title="Crear Proyecto">

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

    @if ($errors->any())

        <div class="mb-4 rounded-md border border-red-300 bg-red-50 p-4">

            <h3 class="text-sm font-semibold text-red-800 mb-2">

                Se encontraron los siguientes errores:

            </h3>

            <ul class="list-disc list-inside text-sm text-red-700">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    {{-- ================= CONTENIDO ================= --}}
    <div class="bg-white p-6 shadow-sm">

        {{-- Encabezado --}}
        <div class="mb-1">

            <h2 class="text-2xl font-semibold text-gray-800 leading-tight">

                Registrar un nuevo proyecto de inversión

            </h2>

            <a href="{{ route('proyectos.listar') }}"
                class="inline-flex items-center mt-0.5 text-sm font-medium text-blue-600 hover:text-blue-800">

                <i class="bi bi-arrow-left-short text-lg mr-1"></i>

                Regresar

            </a>

        </div>

        @include('proyectos.partials.modal-exito')

        <!-- Scroll -->
        <div class="overflow-y-auto" style="height: calc(100vh - 180px);">

            <!-- Formulario -->
            <form method="POST"
                  action="{{ route('proyectos.store') }}">

                @csrf

                @include('proyectos.partials.barra-progreso')

                @include('proyectos.partials.contexto-programa')

                @include('proyectos.partials.informacion-general')

                @include('proyectos.partials.estado')

                @include('proyectos.partials.acciones')

            </form>

        </div>

    </div>

</x-proyectos-layout>