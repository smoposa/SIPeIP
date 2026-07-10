<x-objetivos-layout title="Detalle del Indicador">

    <!-- Barra principal -->

    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="#"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Información General
            </a>

            <a href="#"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                ODS
            </a>

            <a href="#"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                PND
            </a>

            <a href="#"
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Objetivos Institucionales
            </a>

        </div>

    </div>

<!-- Cabecera -->
<div class="flex items-center gap-4 mb-0 pb-6">

    <div class="w-16 h-16 rounded-full bg-[#16A34A]
                flex items-center justify-center
                text-white text-3xl">

        <i class="bi bi-graph-up-arrow"></i>

    </div>

    <div>

        <h2 class="text-xl font-semibold text-gray-800">
            {{ $indicador->nombre }}
        </h2>

        <p class="text-gray-500">
            {{ $indicador->codigo }} • {{ $indicador->tipo }}
        </p>

    </div>

</div>

<!-- Información General -->
<div class="bg-gray-100 border-b border-gray-200">

    <div class="flex justify-between items-center px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Información general
        </h4>

        <a href="{{ route('indicadores.edit', $indicador->id) }}"
        class="text-sm text-blue-600 hover:text-blue-800">

            Editar

        </a>

    </div>

</div>

<!-- Datos -->
<div class="px-4 py-3">

    <div class="space-y-4 mb-6">

        <!-- Código -->
        <div class="flex">

            <span class="w-44 text-sm font-semibold text-gray-700">
                Código
            </span>

            <span class="text-sm text-gray-600">
                {{ $indicador->codigo }}
            </span>

        </div>

        <!-- Meta -->
        <div class="flex">

            <span class="w-44 text-sm font-semibold text-gray-700">
                Meta
            </span>

            <span class="text-sm text-gray-600">
                {{ $indicador->meta->codigo }} - {{ $indicador->meta->nombre }}
            </span>

        </div>

        <!-- Objetivo -->
        <div class="flex">

            <span class="w-44 text-sm font-semibold text-gray-700">
                Objetivo Estratégico
            </span>

            <span class="text-sm text-gray-600">
                {{ $indicador->meta->objetivo->codigo }} -
                {{ $indicador->meta->objetivo->nombre }}
            </span>

        </div>

        <!-- Plan -->
        <div class="flex">

            <span class="w-44 text-sm font-semibold text-gray-700">
                Plan
            </span>

            <span class="text-sm text-gray-600">
                {{ $indicador->meta->objetivo->plan->codigo }} -
                {{ $indicador->meta->objetivo->plan->nombre }}
            </span>

        </div>

        <!-- Nombre -->
        <div class="flex">

            <span class="w-44 text-sm font-semibold text-gray-700">
                Nombre
            </span>

            <span class="text-sm font-medium text-[#16A34A]">
                {{ $indicador->nombre }}
            </span>

        </div>

        <!-- Tipo -->
        <div class="flex">

            <span class="w-44 text-sm font-semibold text-gray-700">
                Tipo
            </span>

            <span class="text-sm text-gray-600">
                {{ $indicador->tipo }}
            </span>

        </div>

        <!-- Fórmula -->
        <div class="flex items-start">

            <span class="w-44 flex-shrink-0 text-sm font-semibold text-gray-700">
                Fórmula
            </span>

            <span class="text-sm text-gray-600 leading-relaxed">
                {{ $indicador->formula }}
            </span>

        </div>

        <!-- Unidad -->
        <div class="flex">

            <span class="w-44 text-sm font-semibold text-gray-700">
                Unidad de medida
            </span>

            <span class="text-sm text-gray-600">
                {{ $indicador->unidad_medida }}
            </span>

        </div>

        <!-- Frecuencia -->
        <div class="flex">

            <span class="w-44 text-sm font-semibold text-gray-700">
                Frecuencia de medición
            </span>

            <span class="text-sm text-gray-600">
                {{ $indicador->frecuencia }}
            </span>

        </div>

        <!-- Responsable -->
        <div class="flex">

            <span class="w-44 text-sm font-semibold text-gray-700">
                Responsable
            </span>

            <span class="text-sm text-gray-600">

                {{ $indicador->responsable->nombres }}
                {{ $indicador->responsable->apellidos }}

                @if($indicador->responsable->cargo)
                    - {{ $indicador->responsable->cargo }}
                @endif

            </span>

        </div>

        <!-- Registrado por -->
        <div class="flex">

            <span class="w-44 text-sm font-semibold text-gray-700">
                Registrado por
            </span>

            <span class="text-sm text-gray-600">

                {{ $indicador->usuario->nombres }}
                {{ $indicador->usuario->apellidos }}

            </span>

        </div>

    </div>

</div>

<!-- Estado -->
<div class="bg-gray-100 border-b border-gray-200">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Estado del indicador
        </h4>

    </div>

</div>

<div class="px-4 py-2">

    <div class="flex items-center mb-4">

        <div class="flex items-center">

            <span class="w-40 text-sm font-semibold text-gray-700">
                Estado
            </span>

            @if($indicador->estado == 'Activo')

                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                    Habilitado
                </span>

            @else

                <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">
                    Deshabilitado
                </span>

            @endif

            <a href="#"
            class="ml-10 text-sm text-blue-600 hover:text-blue-800 hover:underline">

                Editar

            </a>

        </div>

    </div>

</div>

<!-- Auditoría -->
<div class="bg-gray-100 border-b border-gray-200">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Auditoría
        </h4>

    </div>

</div>

<div class="px-4 py-2">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>

            <p class="text-sm font-semibold text-gray-700">
                Fecha de creación
            </p>

            <p class="mt-1 text-sm text-gray-600">
                {{ $indicador->created_at?->format('d/m/Y H:i') ?? 'No registra' }}
            </p>

        </div>

        <div>

            <p class="text-sm font-semibold text-gray-700">
                Última actualización
            </p>

            <p class="mt-1 text-sm text-gray-600">
                {{ $indicador->updated_at?->format('d/m/Y H:i') ?? 'No registra' }}
            </p>

        </div>

    </div>

</div>
</x-objetivos-layout>