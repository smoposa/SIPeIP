<x-usuarios-layout title="Detalle de Usuario">

    <!-- Notificaciones -->
    @include('usuarios.partials.avisos')


    <!-- Barra de acciones -->
    @include('usuarios.partials.barra-menu')


    <!-- Scroll vertical -->
    <div class="overflow-y-auto"
         style="height: calc(100vh - 180px);">

        <div class="min-w-0 bg-white p-6 shadow-sm">

            <!-- Cabecera -->
            @include('usuarios.partials.encabezado-detalle')


            <!-- Información básica -->
            @include('usuarios.partials.informacion-general-detalle')


            <!-- Estado -->
            @include('usuarios.partials.estado-detalle')


            <!-- Asignaciones -->
            @include('usuarios.partials.asignaciones-detalle')

        </div>

    </div>


    <!-- Panel de información -->
    @include('usuarios.editar')


    <!-- Panel de estado -->
    @include('usuarios.estado')


    <!-- Panel de rol -->
    @include('usuarios.editroles')


    <!-- Panel de entidad -->
    @include('usuarios.editentidad')


    <!-- Panel de contraseña -->
    @include('usuarios.editpassword')


    <!-- Funcionamiento de los paneles -->
    @include('usuarios.partials.script')

</x-usuarios-layout>