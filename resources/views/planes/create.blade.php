<x-planes-layout title="Crear Plan Institucional">

    @if(session('success'))
        <div id="alertSuccess"
             class="fixed top-5 right-5 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>

        <script>
            setTimeout(() => {
                const alerta = document.getElementById('alertSuccess');
                if (alerta) {
                    alerta.remove();
                }
            }, 3000);
        </script>
    @endif

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-0">

        <div class="flex">
            <a href="{{ route('planes.listar') }}"
            class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">
                <i class="bi bi-chevron-left"></i>
                Regresar
            </a>
        </div>

    </div>

    <!-- Marco general del contenido -->
    <div class="bg-white p-6 shadow-sm">

    <!-- Encabezado -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">
            Registrar un nuevo plan institucional
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Registre un plan en el Sistema.
        </p>
    </div>

    <!-- Mensajes de validación -->
    @if ($errors->any())

        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">
            <ul class="list-disc list-inside text-sm text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif

    <!-- Scroll del contenido  -->
    <div class="overflow-y-auto" style="height: calc(100vh - 280px);">

        <!-- Formulario -->
        <form action="{{ route('planes.store') }}" method="POST">
            @csrf

            @include('planes.partials.form')

        </form>

    </div>

</x-planes-layout>