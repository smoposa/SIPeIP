<x-programas-layout title="Detalle del programa">

    <!-- Notificaciones -->
    @include('programas.partials.avisos')


    <!-- Barra de acciones -->
    @include('programas.partials.barra-menu')


    <!-- Scroll vertical -->
    <div class="overflow-y-auto"
         style="height: calc(100vh - 180px);">

        <div class="min-w-0 bg-white p-6 shadow-sm">

            <!-- Cabecera -->
            @include('programas.partials.encabezado-detalle')


            <!-- Información general -->
            @include('programas.partials.informacion-general-detalle')


            <!-- Alineación con objetivos institucionales -->
            @include('programas.partials.alineacion-oei')


            <!-- Estado y auditoría -->
            @include('programas.partials.estado-auditoria')

        </div>

    </div>

</x-programas-layout>