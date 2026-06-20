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
    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="{{ route('roles.index') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Información general
            </a>

            <a href="{{ route('roles.create') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Crear rol
            </a>

            <a href="{{ route('roles.listar') }}"
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Consultar roles
            </a>

        </div>

    </div>

    <!-- Encabezado -->
    <div class="mb-6">

        <h2 class="text-2xl font-semibold text-gray-800">
            Editar rol
        </h2>

        <p class="mt-1 text-gray-500">
            Actualice la información del rol institucional registrado en el Sistema Integral de Planificación e Inversión Pública (SIPeIP).
        </p>

    </div>

    <!-- Formulario -->
    <div class="bg-white border border-gray-200 rounded-lg p-6">

        <form method="POST" action="{{ route('roles.update', $rol->id) }}">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div class="mb-5">

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nombre del Rol <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    name="nombre"
                    maxlength="100"
                    required
                    value="{{ old('nombre', $rol->nombre) }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">

                <p class="mt-1 text-xs text-gray-500">
                    Máximo 100 caracteres.
                </p>

            </div>

            <!-- Descripción -->
            <div class="mb-6">

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Descripción
                </label>

                <textarea
                    name="descripcion"
                    rows="4"
                    maxlength="255"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">{{ old('descripcion', $rol->descripcion) }}</textarea>

                <p class="mt-1 text-xs text-gray-500">
                    Máximo 255 caracteres.
                </p>

            </div>

            <!-- Estado -->
            <div class="mb-6">

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Estado <span class="text-red-500">*</span>
                </label>

                <select
                    name="estado"
                    required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">

                    <option value="Activo"
                        {{ old('estado', $rol->estado) == 'Activo' ? 'selected' : '' }}>
                        Activo
                    </option>

                    <option value="Inactivo"
                        {{ old('estado', $rol->estado) == 'Inactivo' ? 'selected' : '' }}>
                        Inactivo
                    </option>

                </select>

                <p class="mt-1 text-xs text-gray-500">
                    Seleccione el estado actual del rol.
                </p>

            </div>

            <!-- Botones -->
            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">
                    Actualizar
                </button>

                <a href="{{ route('roles.listar') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">
                    Cancelar
                </a>

            </div>

        </form>

    </div>

</x-roles-layout>