<x-seguimiento-layout title="Detalle presupuestario">

    <!-- Migas de pan -->
    <x-slot name="breadcrumbs">

        <nav aria-label="Migas de pan">

            <ol class="flex flex-wrap items-center gap-2 text-xs">

                <li>
                    <a href="{{ route('presupuestos.listar') }}"
                       class="text-gray-500 hover:text-blue-600">
                        Presupuestos
                    </a>
                </li>

                <li aria-hidden="true" class="text-gray-400">/</li>

                <li aria-current="page"
                    class="font-medium text-gray-700">
                    Detalle presupuestario
                </li>

            </ol>

        </nav>

    </x-slot>


    <!-- Notificaciones -->
    @include('presupuestos.partials.avisos')


    <!-- Barra de acciones -->
    @include('presupuestos.partials.barra-menu')


    <!-- Scroll vertical -->
    <div class="overflow-y-auto"
         style="height: calc(100vh - 180px);">

        <div class="min-w-0 bg-white p-6 shadow-sm">

            <!-- Cabecera -->
            @include('presupuestos.partials.encabezado-detalle')


            <!-- Información general -->
            @include('presupuestos.partials.informacion-general-detalle')


            <!-- Seguimiento financiero -->
            @include('presupuestos.partials.seguimiento-financiero-detalle')


            <!-- Estado -->
            @include('presupuestos.partials.estado-detalle')


            <!-- Observaciones -->
            @include('presupuestos.partials.observaciones-detalle')


            <!-- Auditoría -->
            @include('presupuestos.partials.auditoria-detalle')

        </div>

    </div>

</x-seguimiento-layout>