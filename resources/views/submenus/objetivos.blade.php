<div class="bg-white h-full">

    <!-- Título -->
    <div class="px-6 py-5 border-b border-gray-200">

        <h3 class="text-lg font-semibold text-gray-800">
            Objetivos Estratégicos
        </h3>

        <p class="text-sm text-gray-500 mt-1">
            Gestión de Objetivos
        </p>

    </div>

    <!-- Opciones -->
    <nav class="py-3">

        <a href="{{ route('objetivos.index') }}"
           class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">

            <i class="bi bi-house-door mr-3"></i>

            Información General

        </a>

        <a href="{{ route('objetivos.ods') }}"
           class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">

            <i class="bi bi-globe-americas mr-3"></i>

            ODS

        </a>

        <a href="{{ route('objetivos.pnd') }}"
           class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">

            <i class="bi bi-diagram-3 mr-3"></i>

            PND

        </a>

        <a href="{{ route('objetivos.oei') }}"
           class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">

            <i class="bi bi-bullseye mr-3"></i>

            Objetivos Institucionales

        </a>

    </nav>

</div>