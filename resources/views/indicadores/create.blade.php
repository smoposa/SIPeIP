<x-objetivos-layout title="Crear Indicador">

    {{-- ================= MENSAJE DE ÉXITO ================= --}}
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

            Registrar un nuevo indicador institucional

        </h2>

        <a href="{{ route('indicadores.listar') }}"
           class="inline-flex items-center mt-0.5 text-sm font-medium text-blue-600 hover:text-blue-800">

            <i class="bi bi-arrow-left-short text-lg mr-1"></i>

            Regresar

        </a>

    </div>

    @include('indicadores.partials.modal-exito')


    {{-- ================= MODAL DE ÉXITO ================= --}}
    @include('indicadores.partials.modal-exito')

    <div class="overflow-y-auto" style="height: calc(100vh - 180px);">

        <form method="POST"
              action="{{ route('indicadores.store') }}">

            @csrf

            @include('indicadores.partials.barra-progreso')

            @include('indicadores.partials.contexto-planificacion')

            @include('indicadores.partials.informacion-general')

            @include('indicadores.partials.estado')

            @include('indicadores.partials.acciones')

        </form>

    </div>

</x-objetivos-layout>