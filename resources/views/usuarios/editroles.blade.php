<x-usuarios-layout title="Editar Rol">

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300">

        <div class="flex">

            <a href="{{ route('usuarios.show', $usuario->id) }}"
               class="px-5 py-3 text-sm font-medium text-blue-500 hover:text-blue-800">

                <i class="bi bi-chevron-left"></i>
                Regresar

            </a>

            <span class="px-5 py-3 text-sm font-medium text-black">
                Rol asignado
            </span>

        </div>

    </div>

    <div class="overflow-y-auto" style="height: calc(100vh - 180px);">

        <div class="p-6">

            <p class="mt-1 text-sm text-gray-500">
                Seleccione el nuevo rol que tendrá asignado el usuario.
            </p>

        </div>

        <div class="bg-white p-4">

            <form method="POST"
                  action="{{ route('usuarios.actualizarroles', $usuario->id) }}">

                @csrf
                @method('PUT')

<div class="space-y-6">

    <!-- Rol actual -->
    <div class="flex items-center gap-20">

        <label class="w-32 text-sm font-medium text-gray-700">
            Rol actual asignado
        </label>

        <span class="text-sm text-gray-900">
            {{ $usuario->rol?->nombre ?? 'No asignado' }}
        </span>

    </div>

    <!-- Nuevo rol -->
    <div class="flex items-center gap-20">

        <label class="w-32 text-sm font-medium text-gray-700">
            Nuevo rol a asignar
        </label>

        <select
            name="rol_id"
            class="w-64 border-gray-300 rounded-md">

            @foreach($roles as $rol)

                <option
                    value="{{ $rol->id }}"
                    {{ $usuario->rol_id == $rol->id ? 'selected' : '' }}>

                    {{ $rol->nombre }}

                </option>

            @endforeach

        </select>

    </div>

</div>

                <div class="flex gap-3 mt-20">

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">

                        Guardar

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