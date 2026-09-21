<x-objetivos-layout title="Detalle OEI">

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

    <!-- Barra de acciones -->
     @include('objetivos.partials.barra-menu')

    <!-- Contenido -->
    <div class="min-w-0 w-full overflow-x-hidden overflow-y-auto"
         style="height: calc(100vh - 100px);">

        <div class="min-w-0 bg-white p-6 shadow-sm">

            <!-- Cabecera -->
            @include('objetivos.partials.encabezado-detalle')

            <!-- Información general -->
            @include('objetivos.partials.informacion-general-detalle')

            <!-- Metas institucionales -->
            @include('objetivos.partials.metas-institucionales')

            <!-- Estado y Auditoría -->
            @include('objetivos.partials.estado-auditoria')

        </div>

    </div>

</x-objetivos-layout>