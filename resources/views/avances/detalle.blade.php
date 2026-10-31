<x-seguimiento-layout title="Detalle del avance">

    <!-- Migas de pan -->
    <x-slot name="breadcrumbs">

        <nav aria-label="Migas de pan">

            <ol class="flex flex-wrap items-center gap-2 text-xs">

                <li>
                    <a href="{{ route('avances.listar') }}"
                       class="text-gray-500 hover:text-blue-600">
                        Avances físicos
                    </a>
                </li>

                <li aria-hidden="true" class="text-gray-400">/</li>

                <li aria-current="page"
                    class="font-medium text-gray-700">
                    Detalle del avance
                </li>

            </ol>

        </nav>

    </x-slot>


    <!-- Notificaciones -->
    @include('avances.partials.avisos')


    <!-- Barra de acciones -->
    @include('avances.partials.barra-menu')


    <!-- Scroll vertical -->
    <div class="overflow-y-auto" style="height: calc(100vh - 180px);">

        <div class="min-w-0 bg-white p-6 shadow-sm">

            <!-- Cabecera -->
            @include('avances.partials.encabezado-detalle')


            <!-- Información general -->
            @include('avances.partials.informacion-general-detalle')


            <!-- Seguimiento físico -->
            @include('avances.partials.seguimiento-fisico-detalle')


            <!-- Resultados y observaciones -->
            @include('avances.partials.resultados-detalle')


            <!-- Estado y auditoría -->
            @include('avances.partials.estado-auditoria')

        </div>

    </div>

</x-seguimiento-layout>