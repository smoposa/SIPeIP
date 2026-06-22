<x-usuarios-layout title="Crear Usuario">

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

        <a href="{{ route('usuarios.index') }}"
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
            Registro de usuario
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Ingrese la información requerida para registrar un nuevo usuario en el sistema.
        </p>

    </div>

    <!-- Scroll -->
    <div class="overflow-y-auto" style="height: calc(100vh - 300px);">

        <form method="POST"
              action="{{ route('usuarios.store') }}">

            @csrf

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
                        value="{{ old('identificacion') }}"
                        class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-1">

                </div>

                <!-- Nombres -->
                <div class="flex items-center">

                    <label class="w-48 text-sm font-medium text-gray-700">
                        Nombres <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="nombres"
                        maxlength="150"
                        required
                        value="{{ old('nombres') }}"
                        class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-1">

                </div>

                <!-- Apellidos -->
                <div class="flex items-center">

                    <label class="w-48 text-sm font-medium text-gray-700">
                        Apellidos <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="apellidos"
                        maxlength="150"
                        required
                        value="{{ old('apellidos') }}"
                        class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-1">

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
                        value="{{ old('email') }}"
                        class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-1">

                </div>

                <!-- Cargo -->
                <div class="flex items-center">

                    <label class="w-48 text-sm font-medium text-gray-700">
                        Cargo
                    </label>

                    <input
                        type="text"
                        name="cargo"
                        maxlength="255"
                        value="{{ old('cargo') }}"
                        class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-1">

                </div>

                <!-- Rol -->
                <div class="flex items-center">

                    <label class="w-48 text-sm font-medium text-gray-700">
                        Rol <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="rol_id"
                        required
                        class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-1">

                        <option value="">
                            Seleccione
                        </option>

                        @foreach($roles as $rol)

                            <option value="{{ $rol->id }}"
                                {{ old('rol_id') == $rol->id ? 'selected' : '' }}>

                                {{ $rol->nombre }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Entidad -->
                <div class="flex items-center">

                    <label class="w-48 text-sm font-medium text-gray-700">
                        Entidad <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="entidad_id"
                        required
                        class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-1">

                        <option value="">
                            Seleccione
                        </option>

                        @foreach($entidades as $entidad)

                            <option value="{{ $entidad->id }}"
                                {{ old('entidad_id') == $entidad->id ? 'selected' : '' }}>

                                {{ $entidad->nombre }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

            <!-- Información de contraseña -->
            <div class="mt-8 p-4 bg-blue-50 border border-blue-200 rounded-md">

                <p class="text-sm text-blue-800">

                    <i class="bi bi-info-circle"></i>

                    El usuario será creado con la contraseña temporal:
                    <strong>12345678</strong>

                </p>

            </div>

            <!-- Botones -->
            <div class="flex gap-3 mt-10">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">

                    Guardar

                </button>

                <a href="{{ route('usuarios.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">

                    Cancelar

                </a>

            </div>

        </form>

    </div>

</div>

</x-usuarios-layout>