<x-usuarios-layout title="Editar Usuario">

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

            <a href="{{ route('usuarios.show', $usuario->id) }}"
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
                Actualizar información del usuario
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                A continuación puede actualizar los datos generales del usuario.
            </p>
        </div>

        <!-- Scroll -->
        <div class="overflow-y-auto" style="height: calc(100vh - 300px);">

            <form method="POST"
                  action="{{ route('usuarios.update', $usuario->id) }}">

                @csrf
                @method('PUT')

                <div class="space-y-4">

                    <!-- Identificación -->
                    <div class="flex items-center">

                        <label class="w-48 text-sm font-medium text-gray-700">
                            Identificación <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="identificacion"
                            maxlength="20"
                            required
                            value="{{ old('identificacion', $usuario->identificacion) }}"
                            class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-2">

                    </div>

                    <!-- Nombres -->
                    <div class="flex items-center">

                        <label class="w-48 text-sm font-medium text-gray-700">
                            Nombres <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="nombres"
                            maxlength="100"
                            required
                            value="{{ old('nombres', $usuario->nombres) }}"
                            class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-2">

                    </div>

                    <!-- Apellidos -->
                    <div class="flex items-center">

                        <label class="w-48 text-sm font-medium text-gray-700">
                            Apellidos <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="apellidos"
                            maxlength="100"
                            required
                            value="{{ old('apellidos', $usuario->apellidos) }}"
                            class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-2">

                    </div>

                    <!-- Correo -->
                    <div class="flex items-center">

                        <label class="w-48 text-sm font-medium text-gray-700">
                            Correo Institucional <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="email"
                            name="email"
                            required
                            value="{{ old('email', $usuario->email) }}"
                            class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-2">

                    </div>

                    <!-- Cargo -->
                    <div class="flex items-center">

                        <label class="w-48 text-sm font-medium text-gray-700">
                            Cargo
                        </label>

                        <input
                            type="text"
                            name="cargo"
                            maxlength="150"
                            value="{{ old('cargo', $usuario->cargo) }}"
                            class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-2">

                    </div>

                </div>

                <!-- Botones -->
                <div class="flex justify-end gap-3 mt-10 pr-8">

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">

                        Actualizar

                    </button>

                    <a href="{{ route('usuarios.show', $usuario->id) }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">

                        Cancelar

                    </a>

                </div>

            </form>

        </div>

    </div>

</x-usuarios-layout>