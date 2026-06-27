<x-plan-layout title="Detalle del Plan">

@if(session('success'))
    <div id="alertSuccess"
        class="fixed top-5 right-5 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">

        {{ session('success') }}

    </div>

    <script>

        setTimeout(() => {

            const alerta = document.getElementById('alertSuccess');

            if (alerta) {

                alerta.remove();

            }

        },3000);

    </script>

@endif

<!-- Barra de acciones -->
<div class="bg-white border-b border-gray-300 mb-0">

    <div class="flex">

        <a href="{{ route('planes.listar') }}"
            class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">

            <i class="bi bi-chevron-left"></i>

            Regresar

        </a>

        <a href="{{ route('planes.editar',$plan->id) }}"
            class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">

            <i class="bi bi-pencil text-blue-500 me-2"></i>

            Editar información

        </a>

        <a href="#"
            class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">

            <i class="bi bi-check2-circle text-blue-500 me-2"></i>

            Estado

        </a>

        <a href="{{ url()->current() }}"
            class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">

            <i class="bi bi-arrow-clockwise text-blue-500 me-2"></i>

            Actualizar

        </a>

    </div>

</div>

<div class="overflow-y-auto"
    style="height: calc(100vh - 180px);">

<div class="bg-white p-6 shadow-sm">

<!-- Cabecera -->

<div class="flex items-center gap-4 mb-0 pb-6">

    <div class="w-20 h-20 rounded-full bg-[#024687]
        flex items-center justify-center
        text-white text-4xl">

        <i class="bi bi-diagram-3"></i>

    </div>

    <div>

        <h2 class="text-2xl font-semibold text-gray-800">

            {{ $plan->nombre }}

        </h2>

        <p class="text-gray-500">

            {{ $plan->codigo }}

        </p>

        <p class="text-gray-500">

            {{ $plan->entidad->nombre }}

        </p>

    </div>

</div>

<!-- Información General -->

<div class="bg-gray-100 border-b border-gray-200 mb-4">

    <div class="flex justify-between items-center px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">

            Información general

        </h4>

        <a href="{{ route('planes.editar',$plan->id) }}"
            class="text-sm text-blue-600 hover:text-blue-800">

            Editar

        </a>

    </div>

</div>

<div class="px-4 py-2">

<div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-4 mb-6">

<div class="flex">

<span class="w-40 text-sm font-semibold text-gray-700">

Código

</span>

<span class="text-sm text-gray-600">

{{ $plan->codigo }}

</span>

</div>

<div class="flex">

<span class="w-40 text-sm font-semibold text-gray-700">

Entidad

</span>

<span class="text-sm text-gray-600">

{{ $plan->entidad->nombre }}

</span>

</div>

<div class="flex">

<span class="w-40 text-sm font-semibold text-gray-700">

Tipo de plan

</span>

<span class="text-sm text-gray-600">

{{ $plan->tipo_plan }}

</span>

</div>

<div class="flex">

<span class="w-40 text-sm font-semibold text-gray-700">

Período

</span>

<span class="text-sm text-gray-600">

{{ $plan->periodo_inicio }} - {{ $plan->periodo_fin }}

</span>

</div>

<div class="flex">

<span class="w-40 text-sm font-semibold text-gray-700">

Fecha inicio

</span>

<span class="text-sm text-gray-600">

{{ $plan->fecha_inicio }}

</span>

</div>

<div class="flex">

<span class="w-40 text-sm font-semibold text-gray-700">

Fecha fin

</span>

<span class="text-sm text-gray-600">

{{ $plan->fecha_fin }}

</span>

</div>

<div class="md:col-span-2 flex">

<span class="w-40 text-sm font-semibold text-gray-700">

Descripción

</span>

<span class="text-sm text-gray-600">

{{ $plan->descripcion }}

</span>

</div>

</div>

</div>
<!-- Estado -->

<div class="bg-gray-100 border-b border-gray-200 mb-4">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">

            Estado

        </h4>

    </div>

</div>

<div class="px-4 py-4 mb-6">

    <div class="flex items-center">

        <span class="w-40 text-sm font-semibold text-gray-700">

            Estado del plan

        </span>

        @if($plan->estado == 'Activo')

            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">

                Activo

            </span>

        @elseif($plan->estado == 'Finalizado')

            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">

                Finalizado

            </span>

        @else

            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">

                {{ $plan->estado }}

            </span>

        @endif

    </div>

</div>

<!-- Módulos relacionados -->

<div class="bg-gray-100 border-b border-gray-200 mb-5">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">

            Componentes del Plan Estratégico Institucional

        </h4>

    </div>

</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- Objetivos -->

    <div class="bg-white border border-gray-200 rounded-lg p-5 shadow-sm">

        <div class="flex justify-between items-center">

            <div>

                <h3 class="text-lg font-semibold text-gray-800">

                    Objetivos Estratégicos

                </h3>

                <p class="text-sm text-gray-500 mt-1">

                    Objetivos registrados en este plan.

                </p>

            </div>

            <i class="bi bi-bullseye text-4xl text-blue-500"></i>

        </div>

        <div class="mt-5">

            <p class="text-4xl font-semibold text-gray-700">

                0

            </p>

        </div>

        <div class="mt-5">

            <a href="#"
                class="text-blue-600 hover:text-blue-800 text-sm">

                Administrar objetivos →

            </a>

        </div>

    </div>

    <!-- Metas -->

    <div class="bg-white border border-gray-200 rounded-lg p-5 shadow-sm">

        <div class="flex justify-between items-center">

            <div>

                <h3 class="text-lg font-semibold text-gray-800">

                    Metas

                </h3>

                <p class="text-sm text-gray-500 mt-1">

                    Metas definidas para el plan.

                </p>

            </div>

            <i class="bi bi-flag-fill text-4xl text-green-500"></i>

        </div>

        <div class="mt-5">

            <p class="text-4xl font-semibold text-gray-700">

                0

            </p>

        </div>

        <div class="mt-5">

            <a href="#"
                class="text-blue-600 hover:text-blue-800 text-sm">

                Administrar metas →

            </a>

        </div>

    </div>
        <!-- Indicadores -->

    <div class="bg-white border border-gray-200 rounded-lg p-5 shadow-sm">

        <div class="flex justify-between items-center">

            <div>

                <h3 class="text-lg font-semibold text-gray-800">

                    Indicadores

                </h3>

                <p class="text-sm text-gray-500 mt-1">

                    Indicadores de seguimiento del plan.

                </p>

            </div>

            <i class="bi bi-graph-up-arrow text-4xl text-cyan-500"></i>

        </div>

        <div class="mt-5">

            <p class="text-4xl font-semibold text-gray-700">

                0

            </p>

        </div>

        <div class="mt-5">

            <a href="#"
                class="text-blue-600 hover:text-blue-800 text-sm">

                Administrar indicadores →

            </a>

        </div>

    </div>

    <!-- Proyectos -->

    <div class="bg-white border border-gray-200 rounded-lg p-5 shadow-sm">

        <div class="flex justify-between items-center">

            <div>

                <h3 class="text-lg font-semibold text-gray-800">

                    Proyectos

                </h3>

                <p class="text-sm text-gray-500 mt-1">

                    Proyectos asociados al plan.

                </p>

            </div>

            <i class="bi bi-kanban-fill text-4xl text-orange-500"></i>

        </div>

        <div class="mt-5">

            <p class="text-4xl font-semibold text-gray-700">

                0

            </p>

        </div>

        <div class="mt-5">

            <a href="#"
                class="text-blue-600 hover:text-blue-800 text-sm">

                Administrar proyectos →

            </a>

        </div>

    </div>

</div>

</div>

</div>

</x-plan-layout>