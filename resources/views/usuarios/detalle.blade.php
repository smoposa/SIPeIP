<x-usuarios-layout title="Detalle de Usuario">

    <!-- Notificaciones -->
    @include('usuarios.partials.avisos')


    <!-- Barra de acciones -->
    @include('usuarios.partials.barra-menu')


    <!-- Scroll vertical -->
    <div class="overflow-y-auto"
         style="height: calc(100vh - 180px);">

        <div class="bg-white p-6 shadow-sm">

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

</x-usuarios-layout>