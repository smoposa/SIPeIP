<x-usuarios-layout title="Detalle de Usuario">

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
            
            <a href="{{ route('usuarios.listar') }}"
                class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">
                <i class="bi bi-chevron-left"></i>
                Regresar
            </a>
            
            <a href="{{ route('usuarios.edit', $usuario->id) }}"
                class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                <i class="bi bi-pencil text-blue-500 me-2"></i>
                Editar información
            </a>

            <a href="{{ route('usuarios.estado', $usuario->id) }}"
                class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                <i class="bi bi-check2-circle text-blue-500 me-2"></i>
                Estado
            </a>

            <a href="{{ route('usuarios.editroles', $usuario->id) }}"
                class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                <i class="bi bi-briefcase text-blue-500 me-1"></i>
                Rol
            </a>

            <a href="{{ route('usuarios.editpassword', $usuario->id) }}"
                class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                <i class="bi bi-key text-blue-500 inline-block rotate-45 me-1"></i>
                Restablecer contraseña
            </a>

            <a href="{{ url()->current() }}"
                class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                <i class="bi bi-arrow-clockwise text-blue-500 me-1"></i>
                Actualizar
            </a>

        </div>
    </div>

    <!-- Scroll vertical -->
    <div class="overflow-y-auto" style="height: calc(100vh - 180px);">

        <!-- Información básica-->
        <div class="bg-white p-6 shadow-sm">

            <!-- Cabecera del usuario + Logo -->
            <div class="flex items-center gap-4 mb-0 pb-6">

                <div class="w-16 h-16 rounded-full bg-[#2563EB]
                            flex items-center justify-center
                            text-white text-4xl">

                    <i class="bi bi-person text-white text-4xl"></i>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ $usuario->nombres }} {{ $usuario->apellidos }}
                    </h2>

                    <p class="text-gray-500">
                        {{ $usuario->cargo ?: 'Sin cargo asignado' }}
                    </p>
                </div>

            </div>

            <!-- Encabezado de Información básica -->
            <div class="bg-gray-100 border-b border-gray-200">

                <div class="flex justify-between items-center px-4 py-2">
                    <h4 class="text-sm font-semibold text-gray-800">
                        Información básica
                    </h4>

                    <a href="{{ route('usuarios.edit', $usuario->id) }}"
                       class="text-sm text-blue-600 hover:text-blue-800">

                        
                        Editar
                    </a>
                </div>

            </div>

            <!-- Contenido informacion-->
            <div class="px-4 py-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-4 mb-6">

                    <!-- Columna izquierda -->
                    <div class="space-y-4">

                        <div class="flex">
                            <span class="w-40 text-sm font-semibold text-gray-700">
                                Identificación
                            </span>

                            <span class="text-sm text-gray-600">
                                {{ $usuario->identificacion }}
                            </span>
                        </div>

                        <div class="flex">
                            <span class="w-40 text-sm font-semibold text-gray-700">
                                Nombres
                            </span>

                            <span class="text-sm text-gray-600">
                                {{ $usuario->nombres }}
                            </span>
                        </div>

                        <div class="flex">
                            <span class="w-40 text-sm font-semibold text-gray-700">
                                Apellidos
                            </span>

                            <span class="text-sm text-gray-600">
                                {{ $usuario->apellidos }}
                            </span>
                        </div>

                        <div class="flex">
                            <span class="w-40 text-sm font-semibold text-gray-700">
                                Correo
                            </span>

                            <span class="text-sm text-gray-600">
                                {{ $usuario->email }}
                            </span>
                        </div>

                    </div>

                    <!-- Columna derecha -->
                    <div class="space-y-4">

                        <div class="flex">
                            <span class="w-40 text-sm font-semibold text-gray-700">
                                Entidad
                            </span>

                            <span class="text-sm text-gray-600">
                                {{ $usuario->entidad?->nombre ?: 'No asignada' }}
                            </span>
                        </div>

                        <div class="flex">
                            <span class="w-40 text-sm font-semibold text-gray-700">
                                Cargo
                            </span>

                            <span class="text-sm text-gray-600">
                                {{ $usuario->cargo ?: 'No registra' }}
                            </span>
                        </div>

                        <div class="flex">
                            <span class="w-40 text-sm font-semibold text-gray-700">
                                Rol
                            </span>

                            <span class="text-sm text-gray-600">
                                {{ $usuario->rol?->nombre ?: 'No asignado' }}
                            </span>
                        </div>

                    </div>

                </div>
            </div>
                
            <!-- Encabezado de Estado -->
            <div class="bg-gray-100 border-b border-gray-200">
                <div class="px-4 py-2">

                    <h4 class="text-sm font-semibold text-gray-800">
                        Estado
                    </h4>

                </div>
            </div>

            <div class="px-4 py-2">
                <div class="flex items-center mb-8">

                    <span class="w-40 text-sm font-semibold text-gray-700">
                        Estado del usuario
                    </span>

                    @if($usuario->estado == 'Activo')

                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                            Habilitado
                        </span>

                    @else

                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">
                            Deshabilitado
                        </span>

                    @endif

                    <a href="{{ route('usuarios.estado', $usuario->id) }}"
                       class="ml-10 text-sm text-blue-600 hover:text-blue-800 hover:underline">

                        Editar

                    </a>

                </div>
            </div>

            <!-- Encabezado de Asignaciones -->
            <div class="bg-gray-100 border-b border-gray-200">
                <div class="px-4 py-2">
                    <h4 class="text-sm font-semibold text-gray-800">
                        Asignaciones
                    </h4>
                </div>
            </div>

            <div class="px-4 py-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

                    <!-- Card Roles -->
                    <div class="border border-gray-200 rounded-lg p-6 bg-white">
                        <div class="grid grid-cols-[60px_1fr_auto] items-center gap-4">

                            <!-- Columna 1 -->
                            <div>
                                <i class="bi bi-key-fill text-4xl text-yellow-500"></i>
                            </div>

                            <!-- Columna 2 -->
                            <div>
                                <h5 class="text-sm font-semibold text-gray-700 mb-2">
                                    Roles asignados
                                </h5>
                                <p class="text-sm text-gray-800">
                                    {{ $usuario->rol->nombre }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    Creado el {{ $usuario->rol->created_at->format('d/m/Y') }}
                                </p>
                            </div>

                            <!-- Columna 3 -->
                            <div>
                                <a href="{{ route('usuarios.editroles', $usuario->id) }}"
                                class="text-sm text-blue-600 hover:text-blue-800">
                                    Editar
                                </a>
                            </div>

                        </div>
                    </div>

                    <!-- Card Entidad -->
                    <div class="border border-gray-200 rounded-lg p-6 bg-white">
                        <div class="grid grid-cols-[60px_1fr_auto] items-center gap-4">
                            <!-- Columna 1 -->
                            <div>
                                <i class="bi bi-building text-4xl text-cyan-500"></i>
                            </div>

                            <!-- Columna 2 -->
                            <div>

                                <h5 class="text-sm font-semibold text-gray-700 mb-2">
                                    Entidad asignada
                                </h5>

                                <p class="text-sm text-gray-800">
                                    {{ $usuario->entidad?->nombre ?? 'No asignada' }}
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    Entidad institucional del usuario
                                </p>

                            </div>

                            <!-- Columna 3 -->
                            <div>
                                <a href="{{ route('usuarios.editentidad', $usuario->id) }}"
                                class="text-sm text-blue-600 hover:text-blue-800">
                                    Editar
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

</x-usuarios-layout>