<x-objetivos-layout title="Objetivos Estratégicos">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestión de Objetivos Estratégicos
        </h2>
    </x-slot>

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="{{ route('objetivos.index') }}"
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Información General
            </a>

            <a href="{{ route('objetivos.create') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Crear Objetivo
            </a>

            <a href="{{ route('objetivos.listar') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Consultar Objetivos
            </a>

        </div>

    </div>

    <!-- Encabezado -->
    <div class="mb-8">

        <h1 class="text-3xl font-bold text-gray-900">
            Objetivos Estratégicos
        </h1>

        <p class="mt-2 text-gray-600">
            Administración de los Objetivos de Desarrollo Sostenible (ODS),
            Objetivos del Plan Nacional de Desarrollo (PND) y Objetivos
            Estratégicos Institucionales (OEI).
        </p>

    </div>

    <!-- Tarjetas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- ODS -->
        <div class="bg-white border rounded-xl p-6 shadow-sm">

            <div class="flex justify-between items-center">

                <div>

                    <h3 class="text-xl font-semibold">
                        ODS
                    </h3>

                    <p class="text-gray-500 text-sm mt-1">
                        Objetivos de Desarrollo Sostenible.
                    </p>

                </div>

                <i class="bi bi-globe-americas text-4xl text-blue-600"></i>

            </div>

            <div class="mt-8">

                <div class="text-5xl font-bold">
                    17
                </div>

                <p class="text-gray-500 mt-1">
                    Objetivos mundiales
                </p>

            </div>

            <div class="mt-8">

                <a href="{{ route('objetivos.listar') }}"
                   class="text-blue-600 hover:underline">

                    Administrar ODS →

                </a>

            </div>

        </div>

        <!-- PND -->
        <div class="bg-white border rounded-xl p-6 shadow-sm">

            <div class="flex justify-between items-center">

                <div>

                    <h3 class="text-xl font-semibold">
                        PND
                    </h3>

                    <p class="text-gray-500 text-sm mt-1">
                        Objetivos del Plan Nacional de Desarrollo.
                    </p>

                </div>

                <i class="bi bi-diagram-3 text-4xl text-green-600"></i>

            </div>

            <div class="mt-8">

                <div class="text-5xl font-bold">
                    0
                </div>

                <p class="text-gray-500 mt-1">
                    Registrados
                </p>

            </div>

            <div class="mt-8 text-gray-400">

                Próximamente

            </div>

        </div>

        <!-- OEI -->
        <div class="bg-white border rounded-xl p-6 shadow-sm">

            <div class="flex justify-between items-center">

                <div>

                    <h3 class="text-xl font-semibold">
                        OEI
                    </h3>

                    <p class="text-gray-500 text-sm mt-1">
                        Objetivos Estratégicos Institucionales.
                    </p>

                </div>

                <i class="bi bi-building text-4xl text-cyan-600"></i>

            </div>

            <div class="mt-8">

                <div class="text-5xl font-bold">
                    0
                </div>

                <p class="text-gray-500 mt-1">
                    Registrados
                </p>

            </div>

            <div class="mt-8 text-gray-400">

                Próximamente

            </div>

        </div>

    </div>

</x-objetivos-layout>