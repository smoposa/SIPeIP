@if($planSeleccionado)

    <input type="hidden"
           name="plan_id"
           value="{{ $planSeleccionado->id }}">

@endif

<!-- Plan de Trabajo -->
<div class="mb-8">

    <!-- Encabezado -->
    <div class="bg-[#F3F2F1] border-b border-gray-200 px-4 py-2 mb-5">

        <h2 class="text-sm font-semibold text-gray-700">
            Plan de Trabajo sobre el cual estamos trabajando 
        </h2>

    </div>

    <!-- Contenido -->
    <div class="pl-6">

        <!-- Código -->
        <div class="flex items-center mb-5">

            <span class="w-52 text-sm font-semibold text-gray-700">
                Código
            </span>

            <span class="text-sm text-gray-800">
                {{ $planSeleccionado?->codigo ?? 'No seleccionado' }}
            </span>

        </div>

        <!-- Nombre -->
        <div class="flex items-center mb-5">

            <span class="w-52 text-sm font-semibold text-gray-700">
                Nombre
            </span>

            <span class="text-sm text-gray-800">
                {{ $planSeleccionado?->nombre ?? 'Seleccione un plan para continuar.' }}
            </span>

        </div>

        <!-- Entidad -->
        <div class="flex items-center mb-5">

            <span class="w-52 text-sm font-semibold text-gray-700">
                Entidad
            </span>

            <span class="text-sm text-gray-800">
                {{ $planSeleccionado?->entidad?->nombre ?? '---' }}
            </span>

        </div>

        <!-- Estado -->
        <div class="flex items-center">

            <span class="w-52 text-sm font-semibold text-gray-700">
                Estado
            </span>

            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                {{ ($planSeleccionado?->estado ?? '') == 'Activo'
                    ? 'bg-green-100 text-green-700'
                    : 'bg-yellow-100 text-yellow-700' }}">

                {{ $planSeleccionado?->estado ?? 'Pendiente' }}

            </span>

        </div>

    </div>

</div>