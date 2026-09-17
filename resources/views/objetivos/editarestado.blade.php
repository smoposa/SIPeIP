<x-objetivos-layout title="Editar Estado del Objetivo">

    <div class="bg-white border-b border-gray-300 mb-0">

        <div class="flex">

            <a href="{{ route('objetivos.detalle', $objetivo->id) }}"
               class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800">

                <i class="bi bi-chevron-left"></i>
                Regresar

            </a>

        </div>

    </div>

    <div class="bg-white p-6 shadow-sm">

        <div class="mb-6">

            <h2 class="text-2xl font-semibold text-gray-800">
                Editar estado del objetivo
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                {{ $objetivo->codigo }} - {{ $objetivo->nombre }}
            </p>

        </div>

        @if($errors->any())

            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">

                <ul class="list-disc list-inside text-sm text-red-700">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif

        <form method="POST"
              action="{{ route('objetivos.actualizarestado', $objetivo->id) }}">

            @csrf
            @method('PUT')

            <input
                type="hidden"
                name="estado"
                value="0">

            <div class="flex items-center">

                <span class="w-48 text-sm font-semibold text-gray-700">
                    Estado
                </span>

                <label class="inline-flex items-center">

                    <input
                        type="checkbox"
                        name="estado"
                        value="1"
                        {{ $objetivo->estado === 'Activo' ? 'checked' : '' }}
                        class="w-5 h-5 text-blue-600 border-gray-300 rounded">

                    <span class="ml-3 text-sm text-gray-700">
                        Objetivo activo
                    </span>

                </label>

            </div>

            <div class="flex justify-end gap-3 mt-8">

                <a href="{{ route('objetivos.detalle', $objetivo->id) }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">

                    Cancelar

                </a>

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">

                    Guardar estado

                </button>

            </div>

        </form>

    </div>

</x-objetivos-layout>