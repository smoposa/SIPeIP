@if($planSeleccionado && $objetivoSeleccionado)

<!-- Contexto de la planificación -->
<div class="mb-8">

    <!-- Encabezado -->
    <div class="bg-[#F3F2F1] border-b border-gray-200 px-4 py-2 mb-5">

        <h2 class="text-sm font-semibold text-gray-700">
            Contexto de la planificación
        </h2>

    </div>

    <!-- Contenido -->
    <div class="grid grid-cols-2 gap-10 px-8">

        <!-- Plan -->
        <div>

            <h3 class="text-xs uppercase tracking-wide font-semibold text-gray-500 mb-2">
                Plan Estratégico
            </h3>

            <p class="text-sm font-semibold text-[#024687]">
                {{ $planSeleccionado->codigo }}
            </p>

            <p class="text-sm text-gray-700 mt-1">
                {{ $planSeleccionado->nombre }}
            </p>

        </div>

        <!-- Objetivo -->
        <div>

            <h3 class="text-xs uppercase tracking-wide font-semibold text-gray-500 mb-2">
                Objetivo Estratégico
            </h3>

            <p class="text-sm font-semibold text-[#16A34A]">
                {{ $objetivoSeleccionado->codigo }}
            </p>

            <p class="text-sm text-gray-700 mt-1">
                {{ $objetivoSeleccionado->nombre }}
            </p>

        </div>

    </div>

</div>

@endif