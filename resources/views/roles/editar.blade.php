<x-roles-layout title="Editar Rol">

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

        <div class="flex gap-6">
            <a href="{{ route('roles.detalle', $rol->id) }}"
                class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">
                <i class="bi bi-chevron-left"></i>
                Regresar
            </a>
        </div>

    </div>

    <!-- Información -->
    <div class="bg-white p-6 shadow-sm">

        <!-- Encabezado -->
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">
                Actualizar información del rol
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                A continuación puede actualizar la información general del rol.
            </p>
        </div>

        <!-- Scroll -->
        <div class="overflow-y-auto" style="height: calc(100vh - 300px);">

            <form method="POST" action="{{ route('roles.update', $rol->id) }}">

                @csrf
                @method('PUT')

                <div class="space-y-4">

                    <!-- Nombre -->
                    <div class="flex items-center">

                        <label class="w-48 text-sm font-medium text-gray-700">
                            Nombre del Rol <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="nombre"
                            maxlength="100"
                            required
                            value="{{ old('nombre', $rol->nombre) }}"
                            class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-1">

                    </div>

                    <!-- Descripción -->
                    <div class="flex items-start">

                        <label class="w-48 text-sm font-medium text-gray-700 pt-2">
                            Descripción
                        </label>

                        <textarea
                            name="descripcion"
                            rows="4"
                            maxlength="255"
                            class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-1">{{ old('descripcion', $rol->descripcion) }}</textarea>

                    </div>

                </div>

                <!-- Botones -->
                <div class="flex gap-3 mt-10">

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">

                        Actualizar

                    </button>

                    <a href="{{ route('roles.detalle', $rol->id) }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">

                        Cancelar

                    </a>

                </div>

            </form>

        </div>

    </div>

</x-roles-layout>