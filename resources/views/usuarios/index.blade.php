<x-usuarios-layout title="Página de inicio">

    <div class="space-y-6">

        <!-- Encabezado -->
        <div>

            <!-- h2 class="text-2xl font-semibold text-gray-900">
                Información general
            </h2 -->
    <h3 class="text-lg font-semibold text-gray-800 mb-5">
        Resumen General
    </h3>
            

        </div>

        <!-- Scroll vertical -->
        <div class="overflow-y-auto" style="height: calc(100vh - 220px);">

            <div class="space-y-6">

                <!-- Resumen General -->
                <div class="bg-white border border-gray-300 rounded-lg p-4 mb-6">

                

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <!-- Registrados -->
                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-sm font-medium text-gray-800">
                                    Usuarios registrados
                                </p>

                                <p class="text-xs text-gray-500">
                                    Total de usuarios del sistema
                                </p>

                            </div>

                            <span class="text-2xl font-semibold text-gray-700">
                                {{ $totalUsuarios }}
                            </span>

                        </div>

                        <!-- Activos -->
                        <div class="flex items-center justify-between border-l border-gray-200 pl-6">

                            <div>

                                <p class="text-sm font-medium text-gray-800">
                                    Usuarios activos
                                </p>

                                <p class="text-xs text-gray-500">
                                    Habilitados para ingresar
                                </p>

                            </div>

                            <span class="text-2xl font-semibold text-green-600">
                                {{ $usuariosActivos }}
                            </span>

                        </div>

                        <!-- Inactivos -->
                        <div class="flex items-center justify-between border-l border-gray-200 pl-6">

                            <div>

                                <p class="text-sm font-medium text-gray-800">
                                    Usuarios inactivos
                                </p>

                                <p class="text-xs text-gray-500">
                                    Acceso deshabilitado
                                </p>

                            </div>

                            <span class="text-2xl font-semibold text-red-500">
                                {{ $usuariosInactivos }}
                            </span>

                        </div>

                    </div>

                </div>

                <!-- Distribución de usuarios -->
                <div class="mb-4">

                    <h3 class="text-lg font-semibold text-gray-800">
                        Distribución de usuarios por tipo de entidad
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Consulte los usuarios asignados a cada entidad.
                    </p>

                </div>

                <div class="space-y-3">

                    @foreach($usuariosPorTipo as $tipo => $entidades)

                        <details class="bg-gray-100 border border-gray-200 rounded-md">

                            <summary
                                class="flex justify-between items-center px-4 py-3 cursor-pointer list-none">

                                <span class="text-sm font-semibold text-gray-700">

                                    {{ $tipo }}

                                </span>

                                <span class="bg-gray-300 text-gray-700 px-2 py-0.5 rounded-full text-xs">

                                    {{ $entidades->sum(fn($entidad) => $entidad->usuarios->count()) }}

                                </span>

                            </summary>

                            <div class="space-y-2 p-2">

                                @foreach($entidades as $entidad)

                                    <details class="bg-white border border-gray-200 rounded-md">

                                        <summary
                                            class="flex justify-between items-center px-4 py-3 cursor-pointer list-none hover:bg-gray-50">

                                            <span class="text-sm text-gray-700">

                                                {{ $entidad->nombre }}

                                            </span>

                                            <span
                                                class="min-w-7 h-7 flex items-center justify-center rounded-full bg-gray-200 text-gray-700 text-xs font-semibold">

                                                {{ $entidad->usuarios->count() }}

                                            </span>

                                        </summary>

                                        <div class="border-t bg-gray-50">

                                            @forelse($entidad->usuarios as $usuario)

                                                <div class="flex justify-between items-center px-4 py-2 border-b last:border-b-0">

                                                    <div>

                                                        <p class="text-sm font-medium text-gray-700">

                                                            {{ $usuario->nombres }}
                                                            {{ $usuario->apellidos }}

                                                        </p>

                                                        <p class="text-xs text-gray-500 mt-0.5">

                                                            {{ $usuario->rol->nombre }}

                                                        </p>

                                                    </div>

                                                    <span
                                                        class="px-2 py-1 rounded-full text-xs
                                                        {{ $usuario->estado == 'Activo'
                                                            ? 'bg-green-100 text-green-700'
                                                            : 'bg-red-100 text-red-700' }}">

                                                        {{ $usuario->estado }}

                                                    </span>

                                                </div>

                                            @empty

                                                <div class="px-4 py-3 text-xs text-gray-500">

                                                    No existen usuarios registrados.

                                                </div>

                                            @endforelse

                                        </div>

                                    </details>

                                @endforeach

                            </div>

                        </details>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

</x-usuarios-layout>