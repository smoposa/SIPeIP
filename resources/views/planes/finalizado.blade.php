<x-planes-layout title="Planificación Finalizada">
    
    {{-- ================= CONTENIDO ================= --}}
    <div class="bg-white p-6 shadow-sm">

        @include('planes.partials.barra-finalizacion')
        
        <!-- Scroll -->
        <div class="overflow-y-auto" style="height: calc(100vh - 220px);">

            @include('planes.partials.mensaje-finalizacion')

            {{-- ================= RESUMEN ================= --}}

            <div class="space-y-6 mt-8">

                @include('planes.partials.resumen-planificacion')

                @include('planes.partials.acciones-finalizacion')

            </div>

        </div>
    </div>

</x-planes-layout>