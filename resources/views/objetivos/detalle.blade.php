<x-objetivos-layout title="Detalle del Objetivo Estratégico">

    <!-- Barra de navegación -->

    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="{{ route('objetivos.detalle', 1) }}"
                class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Información General
            </a>

            <a href="{{ route('metas.index', $objetivo->id) }}"
                class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Metas
            </a>

            <a href="#"
                class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Proyectos
            </a>

            <a href="#"
                class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Alineación
            </a>

            <a href="#"
                class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Historial
            </a>

        </div>

    </div>


    <!-- Encabezado -->

    <div class="flex items-start justify-between mb-8">

        <div>

            <div class="flex items-center gap-3 mb-2">

                <span
                    class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">

                    OEI-001

                </span>

                <span
                    class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                    Activo

                </span>

            </div>

            <h2 class="text-2xl font-semibold text-gray-800">

                Fortalecer la gestión institucional mediante la modernización de los procesos administrativos

            </h2>

            <p class="mt-2 text-gray-600">

                Información general del Objetivo Estratégico Institucional.

            </p>

        </div>


        <div class="flex gap-3">

            <a href="{{ route('objetivos.edit', $objetivo->id) }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">

                <i class="bi bi-pencil-square mr-2"></i>

                Editar

            </a>

            <a href="{{ route('objetivos.oei') }}"
                class="inline-flex items-center px-4 py-2 border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 rounded-lg">

                <i class="bi bi-arrow-left mr-2"></i>

                Volver

            </a>

        </div>

    </div>


    <!-- Resumen -->

    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">

        <div class="bg-white border rounded-lg p-5">

            <p class="text-sm text-gray-500">

                Código

            </p>

            <h4 class="mt-2 text-xl font-semibold text-gray-800">

                OEI-001

            </h4>

        </div>

        <div class="bg-white border rounded-lg p-5">

            <p class="text-sm text-gray-500">

                Responsable

            </p>

            <h4 class="mt-2 text-lg font-semibold text-gray-800">

                Dirección de Planificación

            </h4>

        </div>

        <div class="bg-white border rounded-lg p-5">

            <p class="text-sm text-gray-500">

                Vigencia

            </p>

            <h4 class="mt-2 text-lg font-semibold text-gray-800">

                2026 - 2029

            </h4>

        </div>

        <div class="bg-white border rounded-lg p-5">

            <p class="text-sm text-gray-500">

                Metas Registradas

            </p>

            <h4 class="mt-2 text-xl font-semibold text-blue-700">

                0

            </h4>

        </div>

    </div>


    <!-- Información General -->

    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">

        <div class="px-6 py-4 border-b bg-gray-50">

            <h3 class="text-lg font-semibold text-gray-800">

                Información General

            </h3>

        </div>

<table class="min-w-full">

    <tbody class="divide-y divide-gray-200">

        <tr>

            <td class="w-64 px-6 py-4 bg-gray-50 font-semibold text-gray-700">
                Código
            </td>

            <td class="px-6 py-4">
                {{ $objetivo->codigo }}
            </td>

        </tr>

        <tr>

            <td class="px-6 py-4 bg-gray-50 font-semibold text-gray-700">
                Nombre
            </td>

            <td class="px-6 py-4">
                {{ $objetivo->nombre }}
            </td>

        </tr>

        <tr>

            <td class="px-6 py-4 bg-gray-50 font-semibold text-gray-700">
                Descripción
            </td>

            <td class="px-6 py-4 leading-7 text-gray-700">
                {{ $objetivo->descripcion }}
            </td>

        </tr>

        <tr>

            <td class="px-6 py-4 bg-gray-50 font-semibold text-gray-700">
                Tipo de Objetivo
            </td>

            <td class="px-6 py-4">
                {{ $objetivo->tipo }}
            </td>

        </tr>

        <tr>

            <td class="px-6 py-4 bg-gray-50 font-semibold text-gray-700">
                Estado
            </td>

            <td class="px-6 py-4">

                @if($objetivo->estado == 'Activo')

                    <span class="inline-flex px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                        {{ $objetivo->estado }}

                    </span>

                @else

                    <span class="inline-flex px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">

                        {{ $objetivo->estado }}

                    </span>

                @endif

            </td>

        </tr>

        <tr>

            <td class="px-6 py-4 bg-gray-50 font-semibold text-gray-700">
                Fecha de Creación
            </td>

            <td class="px-6 py-4">
                {{ $objetivo->created_at->format('d/m/Y') }}
            </td>

        </tr>

        <tr>

            <td class="px-6 py-4 bg-gray-50 font-semibold text-gray-700">
                Última Actualización
            </td>

            <td class="px-6 py-4">
                {{ $objetivo->updated_at->format('d/m/Y') }}
            </td>

        </tr>

    </tbody>

</table>

    </div>
        <!-- Accesos rápidos -->

    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mt-8">

        <!-- Metas -->

        <div
            class="bg-white border border-gray-200 rounded-lg p-6 hover:border-blue-500 hover:shadow-md transition">

            <div class="flex items-center justify-between">

                <div>

                    <h4 class="text-lg font-semibold text-gray-800">

                        Metas

                    </h4>

                    <p class="text-sm text-gray-500 mt-1">

                        Administre las metas asociadas a este objetivo.

                    </p>

                </div>

                <i class="bi bi-bullseye text-3xl text-blue-600"></i>

            </div>

            <div class="mt-5">

                <a href="#"
                    class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">

                    Administrar Metas

                    <i class="bi bi-arrow-right-short text-lg ml-1"></i>

                </a>

            </div>

        </div>


        <!-- Proyectos -->

        <div
            class="bg-white border border-gray-200 rounded-lg p-6 hover:border-green-500 hover:shadow-md transition">

            <div class="flex items-center justify-between">

                <div>

                    <h4 class="text-lg font-semibold text-gray-800">

                        Proyectos

                    </h4>

                    <p class="text-sm text-gray-500 mt-1">

                        Consulte los proyectos relacionados.

                    </p>

                </div>

                <i class="bi bi-diagram-3-fill text-3xl text-green-600"></i>

            </div>

            <div class="mt-5">

                <a href="#"
                    class="inline-flex items-center text-sm font-medium text-green-600 hover:text-green-800">

                    Administrar Proyectos

                    <i class="bi bi-arrow-right-short text-lg ml-1"></i>

                </a>

            </div>

        </div>


        <!-- Alineación -->

        <div
            class="bg-white border border-gray-200 rounded-lg p-6 hover:border-amber-500 hover:shadow-md transition">

            <div class="flex items-center justify-between">

                <div>

                    <h4 class="text-lg font-semibold text-gray-800">

                        Alineación

                    </h4>

                    <p class="text-sm text-gray-500 mt-1">

                        Relación con ODS y Plan Nacional.

                    </p>

                </div>

                <i class="bi bi-link-45deg text-3xl text-amber-500"></i>

            </div>

            <div class="mt-5">

                <a href="#"
                    class="inline-flex items-center text-sm font-medium text-amber-600 hover:text-amber-700">

                    Ver Alineación

                    <i class="bi bi-arrow-right-short text-lg ml-1"></i>

                </a>

            </div>

        </div>


        <!-- Historial -->

        <div
            class="bg-white border border-gray-200 rounded-lg p-6 hover:border-gray-500 hover:shadow-md transition">

            <div class="flex items-center justify-between">

                <div>

                    <h4 class="text-lg font-semibold text-gray-800">

                        Historial

                    </h4>

                    <p class="text-sm text-gray-500 mt-1">

                        Consulte los cambios realizados.

                    </p>

                </div>

                <i class="bi bi-clock-history text-3xl text-gray-600"></i>

            </div>

            <div class="mt-5">

                <a href="#"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-black">

                    Ver Historial

                    <i class="bi bi-arrow-right-short text-lg ml-1"></i>

                </a>

            </div>

        </div>

    </div>


    <!-- Información adicional -->

    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-5">

        <div class="flex items-start">

            <i class="bi bi-info-circle-fill text-blue-600 text-xl mr-3"></i>

            <div>

                <h4 class="font-semibold text-blue-800">

                    Información

                </h4>

                <p class="mt-1 text-sm text-blue-700 leading-6">

                    Este objetivo constituye el elemento principal de planificación institucional.
                    Desde esta vista podrá administrar las metas, proyectos, alineaciones y demás
                    componentes relacionados conforme se implementen los siguientes módulos del
                    sistema SIPeIP.

                </p>

            </div>

        </div>

    </div>

</x-objetivos-layout>