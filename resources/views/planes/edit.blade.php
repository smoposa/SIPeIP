<x-planes-layout title="Editar Plan Institucional">

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="{{ route('planes.index') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Información General
            </a>

            <a href="{{ route('planes.create') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Crear Plan
            </a>

            <a href="{{ route('planes.listar') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Consultar Planes
            </a>

            <a href="{{ route('planes.edit', $plan->id) }}"
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Editar Plan
            </a>

        </div>

    </div>

    <!-- Encabezado -->

    <div class="mb-8">

        <h2 class="text-3xl font-semibold text-gray-800">

            Editar Plan Institucional

        </h2>

        <p class="mt-2 text-gray-600">

            Modifique la información del plan institucional y guarde los cambios.

        </p>

    </div>

    @if ($errors->any())

        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">

            <ul class="list-disc list-inside text-sm text-red-700">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ route('planes.update', $plan->id) }}" method="POST">

        @csrf

        @method('PUT')

        @include('planes.partials.form')
    </form>

</x-planes-layout>