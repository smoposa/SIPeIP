<x-catalogos-layout title="Clasificación de la inversión">
    @if(puedeVer('clasificacion_inversion'))
        <div class="flex flex-wrap gap-3 py-3 mb-4 border-b border-gray-200">
            <a href="{{ route('catalogos.gestion.index', 'macrosectores') }}" class="text-sm font-semibold text-blue-600">Gestionar catálogo</a>
        </div>
    @endif


    <div class="space-y-5">

        @include('clasificacion-inversion.partials.alerta-exito')

        @include('clasificacion-inversion.partials.encabezado')

        @include('clasificacion-inversion.partials.resumen')

        @include('clasificacion-inversion.partials.barra-estructura')

        @include('clasificacion-inversion.partials.listado')

    </div>

</x-catalogos-layout>