<x-objetivos-layout title="Crear Meta">

    <!-- Mensaje de éxito -->
    @if(session('success'))

        <div id="alertSuccess"
             class="fixed right-5 top-5 z-50 rounded-lg
                    bg-green-600 px-6 py-3 text-white shadow-lg">

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

    <!-- Modal de registro exitoso -->
    @include('metas.partials.modal-exito')

    <!-- Contenido principal -->
    <div class="flex min-w-0 max-w-full flex-col overflow-hidden
                bg-white p-6 shadow-sm"
         style="height: calc(100dvh - 51px);">

        <!-- Encabezado -->
        <div class="mb-4 flex-shrink-0">

            <h2 class="text-2xl font-semibold leading-tight text-gray-800">
                Registrar una nueva meta institucional
            </h2>

            <a href="{{ route('metas.listar') }}"
               class="mt-0.5 inline-flex items-center text-sm font-medium
                      text-blue-600 hover:text-blue-800">

                <i class="bi bi-arrow-left-short mr-1 text-lg"></i>

                Regresar

            </a>

        </div>

        <!-- Validaciones -->
        @if($errors->any())

            <div class="mb-5 flex-shrink-0 rounded-lg border
                        border-red-300 bg-red-50 p-4">

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

        <!-- Mensaje de error -->
        @if(session('error'))

            <div class="mb-5 flex-shrink-0 rounded-lg border
                        border-red-300 bg-red-50 p-4 text-sm text-red-700">

                {{ session('error') }}

            </div>

        @endif

        <!-- Scroll interno -->
        <div class="min-h-0 min-w-0 w-full max-w-full flex-1
                    overflow-y-auto overflow-x-hidden">

            <form method="POST"
                  action="{{ route('metas.store') }}"
                  class="w-full min-w-0 max-w-full">

                @csrf

                @include('metas.partials.barra-progreso')

                @if($planSeleccionado && $objetivoSeleccionado)

                    @include('metas.partials.encabezado')

                @endif

                @include('metas.partials.informacion-general')

                @include('metas.partials.acciones')

            </form>

        </div>

    </div>

</x-objetivos-layout>