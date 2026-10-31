<x-entidades-layout title="Detalle de Entidad">

    <!-- Notificación de éxito -->
    @if(session('success'))

        <div id="alertSuccess"
             role="status"
             class="fixed top-5 right-5 bg-green-600 text-white
                    px-6 py-3 rounded-lg shadow-lg z-50">

            {{ session('success') }}

        </div>

        <script>
            setTimeout(() => {
                document.getElementById('alertSuccess')?.remove();
            }, 3000);
        </script>

    @endif


    <!-- Barra de acciones -->
    @include('entidades.partials.barra-menu')


    <!-- Scroll vertical -->
    <div class="overflow-y-auto"
         style="height: calc(100vh - 180px);">

        <div class="min-w-0 bg-white p-6 shadow-sm">

            <!-- Cabecera e información básica -->
            @include('entidades.partials.informacion-general')


            <!-- Estado -->
            @include('entidades.partials.estado')


            <!-- Auditoría -->
            @include('entidades.partials.auditoria')

        </div>

    </div>


    <!-- Panel lateral de información -->
    @include('entidades.partials.panel-editar')


    <!-- Panel lateral de estado -->
    @include('entidades.partials.panel-estado')


    <!-- Funcionamiento de los paneles -->
    @include('entidades.partials.script')

</x-entidades-layout>