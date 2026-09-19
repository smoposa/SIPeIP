<x-proyectos-layout title="Crear Proyecto">

    @if ($errors->any())
        <div class="mb-4 rounded-md border border-red-300 bg-red-50 p-4">
            <h3 class="mb-2 text-sm font-semibold text-red-800">
                Se encontraron los siguientes errores:
            </h3>

            <ul class="list-inside list-disc text-sm text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-6 shadow-sm">

        <div class="mb-4">
            <h2 class="text-2xl font-semibold leading-tight text-gray-800">
                Registrar proyecto de inversión pública
            </h2>

            <a href="{{ route('proyectos.listar') }}"
                class="mt-1 inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">

                <i class="bi bi-arrow-left-short mr-1 text-lg"></i>
                Regresar
            </a>
        </div>

        <div class="overflow-y-auto pr-1"
            style="height: calc(100vh - 190px);">

            <form method="POST"
                action="{{ route('proyectos.store') }}">

                @csrf

                @include('proyectos.partials.contexto-programa')

                @include('proyectos.partials.informacion-general')

                @include('proyectos.partials.clasificacion-intervencion')

                @include('proyectos.partials.estado')

                @include('proyectos.partials.acciones')

            </form>

        </div>

    </div>

</x-proyectos-layout>