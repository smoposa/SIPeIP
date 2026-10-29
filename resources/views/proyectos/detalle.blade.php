<x-proyectos-layout title="Detalle del Proyecto">

    <!-- Notificaciones -->
    @include('proyectos.partials.avisos')


    <!-- Barra de acciones -->
    @include('proyectos.partials.barra-menu')


    <!-- Scroll vertical -->
    <div class="overflow-y-auto"
         style="height: calc(100vh - 180px);">

        <div class="min-w-0 bg-white p-6 shadow-sm">

            <!-- Cabecera -->
            @include('proyectos.partials.encabezado-detalle')


            <!-- Información general -->
            @include('proyectos.partials.informacion-general-detalle')


            <!-- Clasificación -->
            @include('proyectos.partials.clasificacion-detalle')


            <!-- Alineación estratégica -->
            @include('proyectos.partials.alineacion-detalle')


            <!-- Estados -->
            @include('proyectos.partials.estado-detalle')


            <!-- Auditoría -->
            @include('proyectos.partials.auditoria-detalle')

        </div>

    </div>

</x-proyectos-layout>