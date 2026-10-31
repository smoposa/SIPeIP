<x-roles-layout title="Detalle del Rol">

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
    @include('roles.partials.barra-menu')


    <!-- Scroll vertical -->
    <div class="overflow-y-auto"
         style="height: calc(100vh - 180px);">

        <div class="min-w-0 bg-white p-6 shadow-sm">

            <!-- Cabecera e información general -->
            @include('roles.partials.informacion-general')


            <!-- Estado -->
            @include('roles.partials.estado')


            <!-- Auditoría -->
            @include('roles.partials.auditoria')

        </div>

    </div>


    <!-- Panel de información -->
    @include('roles.editar')


    <!-- Panel de estado -->
    @include('roles.editarestado')


    <!-- Funcionamiento de los paneles -->
    @include('roles.partials.script')

</x-roles-layout>