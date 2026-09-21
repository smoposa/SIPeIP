<x-planes-layout title="Detalle del Plan Institucional">

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
     @include('planes.partials.barra-menu')


    <!-- Scroll vertical -->
    <div class="overflow-y-auto" style="height: calc(100vh - 100px);">

        <div class="bg-white p-6 shadow-sm">

            <!-- Cabecera -->
            @include('planes.partials.encabezado-detalle')

            <!-- Información General y Datos-->
            @include('planes.partials.informacion-general-detalle')

            <!-- Objetivos estratégicos institucionales -->
            @include('planes.partials.objetivos-estrategicos')

            <!-- Estado y versión del plan -->
            @include('planes.partials.estado-auditoria')


        </div>

    </div>

</x-planes-layout>
