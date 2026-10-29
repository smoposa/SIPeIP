<x-seguimiento-layout title="Editar presupuesto">

    <x-slot name="breadcrumbs">

        <nav aria-label="Migas de pan">

            <ol class="flex flex-wrap items-center gap-2 text-xs">

                <li>
                    <a href="{{ route('presupuestos.listar') }}"
                       class="text-gray-500 hover:text-blue-600">
                        Presupuestos
                    </a>
                </li>

                <li aria-hidden="true" class="text-gray-400">/</li>

                <li>
                    <a href="{{ route('presupuestos.detalle', $presupuesto) }}"
                       class="text-gray-500 hover:text-blue-600">
                        Detalle presupuestario
                    </a>
                </li>

                <li aria-hidden="true" class="text-gray-400">/</li>

                <li aria-current="page" class="font-medium text-gray-700">
                    Editar presupuesto
                </li>

            </ol>

        </nav>

    </x-slot>


    <div class="space-y-4">

        <p class="mt-1 text-sm text-gray-500">
            Actualice la información presupuestaria.
            Solo los registros en borrador pueden modificarse.
        </p>


        <form method="POST"
              action="{{ route('presupuestos.update', $presupuesto) }}"
              class="rounded-lg border border-gray-200 bg-white p-5">

            @csrf
            @method('PUT')

            @include('presupuestos.partials.form')


            <div class="mt-6 flex flex-wrap justify-end gap-3 border-t border-gray-100 pt-4">

                <a href="{{ route('presupuestos.detalle', $presupuesto) }}"
                   class="rounded-md border border-gray-300 px-4 py-2 text-sm
                          font-medium text-gray-700 transition hover:bg-gray-50">
                    Cancelar
                </a>

                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-md bg-blue-600
                               px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-700">

                    <i class="bi bi-check-lg" aria-hidden="true"></i>
                    Actualizar presupuesto

                </button>

            </div>

        </form>

    </div>

</x-seguimiento-layout>