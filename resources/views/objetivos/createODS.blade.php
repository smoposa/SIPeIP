<x-objetivos-layout title="Registrar ODS">

    <!-- Barra de acciones -->

    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="{{ route('objetivos.index') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Información General
            </a>

            <a href="{{ route('objetivos.ods') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                ODS
            </a>

            <a href="{{ route('objetivos.createODS') }}"
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Registrar ODS
            </a>

        </div>

    </div>

    <!-- Encabezado -->

    <div class="mb-8">

        <h2 class="text-2xl font-semibold text-gray-800">
            Registrar Objetivo de Desarrollo Sostenible
        </h2>

        <p class="mt-2 text-gray-600">
            Ingrese la información correspondiente al Objetivo de Desarrollo Sostenible.
        </p>

    </div>

    <!-- Formulario -->

    <form action="{{ route('objetivos.store') }}" method="POST">

        @csrf

        <input type="hidden"
               name="tipo"
               value="ODS">

        <div class="bg-white border border-gray-200 rounded-lg p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Botones -->

            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-200">

                <a href="{{ route('objetivos.ods') }}"
                   class="px-5 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">

                    Cancelar

                </a>

                <button
                    type="submit"
                    class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">

                    <i class="bi bi-check-circle mr-2"></i>

                    Guardar ODS

                </button>

            </div>

        </div>

    </form>

</x-objetivos-layout>