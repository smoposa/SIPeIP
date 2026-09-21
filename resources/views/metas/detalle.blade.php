<x-objetivos-layout title="Detalle de la Meta">

    <!-- Mensaje de éxito -->
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

    <!-- Barra de acciones -->
    @include('metas.partials.barra-menu')

    <!-- Scroll -->
    <div class="min-w-0 w-full max-w-full overflow-y-auto"
         style="
            height: calc(100vh - 180px);
            overflow-x: hidden;
         ">

        <div class="min-w-0 max-w-full bg-white p-6 shadow-sm">

            <!-- Cabecera -->
             @include('metas.partials.encabezado-detalle')

            <!-- Información general, Valores y período -->
            @include('metas.partials.informacion-general-detalle')

            <!-- Indicadores asignados -->
            @include('metas.partials.indicadores-asignados')

            <!-- Estado y auditoría -->
            @include('metas.partials.estado-auditoria')

        </div>

    </div>

</x-objetivos-layout>