<x-seguimiento-layout title="Registrar avance">

    <x-slot name="breadcrumbs">

        <nav aria-label="Migas de pan">

            <ol class="flex flex-wrap items-center gap-2 text-xs">

                <li>
                    <a href="{{ route('avances.listar') }}"
                       class="text-gray-500 hover:text-blue-600">
                        Avances físicos
                    </a>
                </li>

                <li aria-hidden="true" class="text-gray-400">/</li>

                <li aria-current="page" class="font-medium text-gray-700">
                    Registrar avance
                </li>

            </ol>

        </nav>

    </x-slot>


    <div class="space-y-4">

        <p class="mt-1 text-sm text-gray-500">
            Registre el avance físico de un proyecto para el indicador
            y período correspondientes.
        </p>


        <form method="POST"
              action="{{ route('avances.store') }}"
              class="rounded-lg border border-gray-200 bg-white p-5">

            @csrf

            @include('avances.partials.form')


            <div class="mt-6 flex flex-wrap justify-end gap-3 border-t border-gray-100 pt-4">

                <a href="{{ route('avances.listar') }}"
                   class="rounded-md border border-gray-300 px-4 py-2 text-sm
                          font-medium text-gray-700 transition hover:bg-gray-50">
                    Cancelar
                </a>

                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-md bg-blue-600
                               px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-700">

                    <i class="bi bi-check-lg" aria-hidden="true"></i>
                    Guardar avance

                </button>

            </div>

        </form>

    </div>

</x-seguimiento-layout>