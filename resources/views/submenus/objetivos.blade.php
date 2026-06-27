<div class="bg-white h-full">

    <!-- Título -->
    <div class="px-6 py-5 border-b border-gray-200">

        <h3 class="text-lg font-semibold text-gray-800">
            Objetivos
        </h3>

        <p class="text-sm text-gray-500 mt-1">
            Gestión de Objetivos Estratégicos
        </p>

    </div>

    <!-- Opciones -->
    <nav class="py-3">

        <a href="{{ route('objetivos.index') }}"
           class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">

            <i class="bi bi-house-door mr-3"></i>

            Información General

        </a>

        <a href="{{ route('objetivos.create') }}"
           class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">

            <i class="bi bi-plus-circle mr-3"></i>

            Crear Objetivo

        </a>

        <a href="{{ route('objetivos.listar') }}"
           class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">

            <i class="bi bi-search mr-3"></i>

            Consultar Objetivos

        </a>

    </nav>

</div>