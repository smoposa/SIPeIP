<x-roles-layout title="Editar Estado del Rol">

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300">

        <div class="flex">

            <a href="{{ request('origen') === 'asignacion'
                        ? route('roles.asignacion')
                        : route('roles.detalle', $rol->id) }}"
            class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">

                <i class="bi bi-chevron-left"></i>

                Regresar

            </a>

        </div>

    </div>

    <!-- Scroll vertical -->
    <div class="overflow-y-auto" style="height: calc(100vh - 180px);">

        <!-- Encabezado -->
        <div class="p-6">

            <h2 class="text-2xl font-semibold text-gray-800">
                Editar estado del rol
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Active o desactive este rol dentro del sistema.
            </p>

        </div>


        <!-- Contenido -->
        <div class="bg-white px-6 pb-6">

            <form method="POST"
                action="{{ route('roles.actualizarestado', $rol->id) }}">

                @csrf
                @method('PUT')

                @if(request('origen') === 'asignacion')
                    <input type="hidden" name="origen" value="asignacion">
                @endif


                <!-- Rol -->
                <div class="mb-6">
                    <p class="mt-1 text-base font-semibold text-gray-800">
                        {{ $rol->nombre }}
                    </p>
                </div>


                <!-- Estado -->
                <div class="flex items-center gap-10">

                    <label for="estado"
                        class="text-sm font-medium text-gray-700">
                        Estado del rol
                    </label>

                    <div class="flex items-center gap-3">

                        <input
                            type="checkbox"
                            id="estado"
                            name="estado"
                            value="1"
                            {{ $rol->estado === 'Activo' ? 'checked' : '' }}
                            class="w-5 h-5">

                        <span class="text-sm font-medium
                            {{ $rol->estado === 'Activo'
                                ? 'text-green-600'
                                : 'text-red-500' }}">

                            {{ $rol->estado === 'Activo'
                                ? 'Activo'
                                : 'Inactivo' }}

                        </span>

                    </div>

                </div>


                <!-- Acciones -->
                <div class="flex gap-3 mt-16">

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700
                            text-white px-5 py-2 rounded-md">

                        Guardar

                    </button>

                    <a href="{{ request('origen') === 'asignacion'
                                ? route('roles.asignacion')
                                : route('roles.detalle', $rol->id) }}"
                    class="bg-gray-200 hover:bg-gray-300
                            text-gray-700 px-5 py-2 rounded-md">

                        Cancelar

                    </a>

                </div>

            </form>

        </div>

    </div>

</x-roles-layout>