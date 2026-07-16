<x-objetivos-layout title="Crear OEI">

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


    {{-- ================= MODAL PASO 2 COMPLETADO ================= --}}
    @if(session('objetivo_registrado'))

        <div id="modalObjetivo"
             class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

            <div class="bg-white rounded-xl shadow-xl w-[420px] p-6">

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
                       class="px-4 py-2 rounded-md bg-gray-200 hover:bg-gray-300 text-gray-700">

                        Volver al listado

                    </a>

                    <a href="{{ route('metas.create') }}"
                       class="px-4 py-2 rounded-md bg-[#18874E] hover:bg-green-700 text-white">

                        Continuar con Metas

                    </a>

                </div>

            </div>

        </div>

    @endif


    {{-- ================= CONTENIDO ================= --}}
    <div class="bg-white p-6 shadow-sm">

        {{-- Encabezado --}}
        <div class="mb-1">

            <h2 class="text-2xl font-semibold text-gray-800 leading-tight">
                Registrar un nuevo objetivo estratégico institucional
            </h2>

            <a href="{{ route('objetivos.listar') }}"
               class="inline-flex items-center mt-0.5 text-sm font-medium text-blue-600 hover:text-blue-800">

                <i class="bi bi-arrow-left-short text-lg mr-1"></i>

                Regresar

            </a>

        </div>



        <!-- Scroll -->
        <div class="overflow-y-auto" style="height: calc(100vh - 180px);">

            <!-- Formulario -->
            <form method="POST"
                action="{{ route('objetivos.store') }}">

                @csrf


                <!-- Barra de progreso -->
                @include('objetivos.partials.barra-progreso')

                <!-- Tarjeta de encabezado  -->
                @if($planSeleccionado)
                    @include('objetivos.partials.encabezado-plan')
                @endif


                @include('objetivos.partials.informacion-general')

                @include('objetivos.partials.alineacion-pnd')

                @include('objetivos.partials.alineacion-ods')

                @include('objetivos.partials.unidad-responsable')

                @include('objetivos.partials.estado')

                @include('objetivos.partials.acciones')

            </form>

        </div>
    
    </div>

</x-objetivos-layout>