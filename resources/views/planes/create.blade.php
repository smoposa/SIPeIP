<x-planes-layout title="Crear Plan Institucional">

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="{{ route('planes.index') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Información General
            </a>

            <a href="{{ route('planes.create') }}"
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Crear Plan
            </a>

            <a href="{{ route('planes.listar') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Consultar Planes
            </a>

        </div>

    </div>

    <!-- Encabezado -->

    <div class="mb-8">

        <h2 class="text-3xl font-semibold text-gray-800">

            Crear Plan Institucional

        </h2>

        <p class="mt-2 text-gray-600">

            Complete la siguiente información para registrar un nuevo plan
            dentro del Sistema Integral de Planificación e Inversión Pública.

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

    <!-- Formulario -->

    <form action="{{ route('planes.store') }}" method="POST">

        @csrf

        @include('planes.partials.form')

    </form>

</x-planes-layout>