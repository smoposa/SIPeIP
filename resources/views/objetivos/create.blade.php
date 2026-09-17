<x-objetivos-layout title="Crear OEI">

    @if(session('success'))

        <div id="alertSuccess"
             class="fixed top-5 right-5 z-50 rounded-lg bg-green-600 px-6 py-3 text-white shadow-lg">

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

    @if(session('objetivo_registrado'))

        <div id="modalObjetivo"
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

            <div class="w-[420px] rounded-xl bg-white p-6 shadow-xl">

                <div class="text-center">

                    <i class="bi bi-check-circle-fill text-5xl text-green-600"></i>

                    <h2 class="mt-3 text-xl font-semibold text-gray-800">
                        Objetivo registrado correctamente
                    </h2>

                    <p class="mt-2 text-sm text-gray-500">
                        El objetivo estratégico institucional se registró exitosamente.
                    </p>

                </div>

                <div class="mt-6 flex justify-end gap-3">

                    <a href="{{ route('objetivos.listar') }}"
                       class="rounded-md bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300">

                        Volver al listado

                    </a>

                    <a href="{{ route('metas.create') }}"
                       class="rounded-md bg-[#18874E] px-4 py-2 text-white hover:bg-green-700">

                        Continuar con Metas

                    </a>

                </div>

            </div>

        </div>

    @endif

    <div class="bg-white p-6 shadow-sm">

        <div class="mb-4">

            <h2 class="text-2xl font-semibold leading-tight text-gray-800">
                Registrar un nuevo objetivo estratégico institucional
            </h2>

            <a href="{{ route('objetivos.listar') }}"
               class="mt-0.5 inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">

                <i class="bi bi-arrow-left-short mr-1 text-lg"></i>

                Regresar

            </a>

        </div>

        @if ($errors->any())

            <div class="mb-5 rounded-lg border border-red-300 bg-red-50 p-4">

                <p class="mb-2 text-sm font-semibold text-red-700">
                    Revise los siguientes campos:
                </p>

                <ul class="list-inside list-disc text-sm text-red-700">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif

        @if(session('error'))

            <div class="mb-5 rounded-lg border border-red-300 bg-red-50 p-4 text-sm text-red-700">
                {{ session('error') }}
            </div>

        @endif

        <div class="overflow-y-auto"
             style="height: calc(100vh - 230px);">

            <form method="POST"
                  action="{{ route('objetivos.store') }}">

                @csrf

                @include('objetivos.partials.barra-progreso')

                @if($planSeleccionado)
                    @include('objetivos.partials.encabezado-plan')
                @endif

                @include('objetivos.partials.informacion-general')

                @include('objetivos.partials.alineacion-pnd')

                @include('objetivos.partials.alineacion-ods')

                @include('objetivos.partials.acciones')

            </form>

        </div>

    </div>

</x-objetivos-layout>