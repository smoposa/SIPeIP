<x-planes-layout title="Detalle del Plan Institucional">

    @if(session('success'))

        <div id="alertSuccess"
             role="status"
             class="fixed right-5 top-5 z-50 rounded-lg bg-green-600
                    px-6 py-3 text-white shadow-lg">

            {{ session('success') }}

        </div>

        <script>
            setTimeout(() => {
                document.getElementById('alertSuccess')?.remove();
            }, 3000);
        </script>

    @endif

    @if(session('error'))

        <div role="alert"
             class="mb-4 rounded-md border border-red-300
                    bg-red-50 px-4 py-3 text-sm text-red-700">

            {{ session('error') }}

        </div>

    @endif

    <!-- Barra de acciones -->
    @include('planes.partials.barra-menu')

    <!-- Contenido -->
    <div class="overflow-y-auto"
         style="height: calc(100vh - 180px);">

        <div class="min-w-0 bg-white p-6 shadow-sm">

            @include('planes.partials.encabezado-detalle')

            @include('planes.partials.informacion-general-detalle')

            @include('planes.partials.objetivos-estrategicos')

            @include('planes.partials.estado-detalle')

            @include('planes.partials.auditoria')

        </div>

    </div>

    <!-- Paneles de edición -->
    @include('planes.edit')

    @include('planes.editarestado')

    <!-- Comportamiento del detalle -->
    @include('planes.partials.script')

</x-planes-layout>