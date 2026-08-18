<x-roles-layout title="Asignación de Roles">

    <!-- Barra de navegación -->
    <div class="bg-white border-b border-gray-300 mb-4">

        <div class="flex">

            <!-- Roles -->
            <a href="{{ route('roles.index') }}"
               class="px-3 py-2 text-sm font-medium text-gray-800
                      border-b-2 border-transparent
                      hover:bg-gray-100 transition">

                <i class="bi bi-person-check text-blue-500 me-2"></i>
                Roles

            </a>

            <!-- Asignación de Roles - Activo -->
            <a href="{{ route('roles.asignacion') }}"
               class="px-3 py-2 text-sm font-medium text-gray-800
                      border-b-2 border-blue-500
                      hover:bg-gray-100 transition">

                <i class="bi bi-list-check text-blue-500 me-2"></i>
                Asignación de Roles

            </a>

            <!-- Actualizar -->
            <a href="{{ url()->current() }}"
                class="px-3 py-2 text-sm font-medium text-gray-700
                        border-b-2 border-transparent
                        hover:bg-gray-100 transition">

                <i class="bi bi-arrow-clockwise text-blue-500 me-2"></i>
                Actualizar

            </a>

        </div>

    </div>


    <!-- Scroll vertical -->
    <div class="overflow-y-auto" style="height: calc(100vh - 180px);">

        <!-- Encabezado -->
        <div class="p-2">

            <p class="mt-1 text-sm text-gray-500">
                Seleccione los roles que podrán ser asignados por los administradores institucionales.
            </p>

        </div>


        <!-- Contenido -->
        <div class="bg-white px-6 pb-6">

            <form method="POST"
                  action="{{ route('roles.actualizarasignacion') }}">

                @csrf
                @method('PUT')


                <!-- Títulos -->
                <div class="flex items-center py-3 border-b border-gray-200">

                    <div class="w-80 text-sm font-semibold text-gray-700">
                        Rol
                    </div>

                    <div class="text-sm font-semibold text-gray-700">
                        Permitido para instituciones
                    </div>

                </div>


                <!-- Lista de roles -->
                @forelse($roles as $rol)

                    @php
                        $rolActivo = $rol->estado === 'Activo';
                    @endphp

                    <div class="flex items-center py-2 border-b border-gray-100">

                        <!-- Rol -->
                        <div class="w-80 text-sm
                                    {{ $rolActivo ? 'text-gray-700' : 'text-gray-400' }}">

                            {{ $rol->nombre }}

                        </div>

                        <!-- Permitido para instituciones -->
                        <div class="flex items-center gap-3">

                            <input
                                type="checkbox"
                                name="roles[]"
                                value="{{ $rol->id }}"
                                {{ $rol->asignable_institucion && $rolActivo ? 'checked' : '' }}
                                {{ !$rolActivo ? 'disabled' : '' }}
                                class="w-5 h-5
                                    {{ !$rolActivo ? 'cursor-not-allowed opacity-50' : '' }}">

                            @if(!$rolActivo)

                            @if(!$rolActivo)

                                <span class="text-sm text-gray-400">
                                    <class="font-semibold"> Rol desactivado. 

                                    <a href="{{ route('roles.estado', ['id' => $rol->id, 'origen' => 'asignacion']) }}"
                                    class="text-blue-500 hover:text-blue-700 hover:underline">
                                        Clic para activarlo.
                                    </a>
                                </span>

                            @endif

                            @endif

                        </div>

                    </div>

                @empty

                    <div class="py-4 text-sm text-gray-500">

                        No existen roles registrados.

                    </div>

                @endforelse


                <!-- Acciones -->
                <div class="flex gap-3 mt-10">

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700
                            text-white px-5 py-2 rounded-md">

                        Guardar

                    </button>

                    <a href="{{ route('roles.index') }}"
                    class="bg-gray-200 hover:bg-gray-300
                            text-gray-700 px-5 py-2 rounded-md">

                        Cancelar

                    </a>

                </div>

            </form>

        </div>

    </div>

</x-roles-layout>