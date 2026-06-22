<x-usuarios-layout title="Editar Entidad">

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300">

        <div class="flex">

            <a href="{{ route('usuarios.show', $usuario->id) }}"
               class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">

                <i class="bi bi-chevron-left"></i>
                Regresar
            </a>

        </div>

    </div>

    <div class="overflow-y-auto" style="height: calc(100vh - 180px);">

        <div class="p-6">

            <p class="mt-1 text-sm text-gray-500">
                Seleccione una nueva entidad para el usuario.
            </p>

        </div>

        <div class="bg-white p-4">

            <form method="POST"
                  action="{{ route('usuarios.actualizarentidad', $usuario->id) }}">

                @csrf
                @method('PUT')

                <div class="space-y-6">

                    <!-- Entidad actual -->
                    <div class="flex items-center gap-20">

                        <label class="w-32 text-sm font-medium text-gray-700">
                            Entidad actual
                        </label>

                        <span class="text-sm text-gray-900">
                            {{ $usuario->entidad?->nombre ?? 'No asignada' }}
                        </span>

                    </div>

                    <!-- Nueva entidad -->
                    <div class="flex items-center gap-20">

                        <label class="w-32 text-sm font-medium text-gray-700">
                            Cambiar entidad
                        </label>

                        <select
                            name="entidad_id"
                            class="w-96 border-gray-300 rounded-md">

                            @foreach($entidades as $entidad)

                                <option
                                    value="{{ $entidad->id }}"
                                    {{ $usuario->entidad_id == $entidad->id ? 'selected' : '' }}>

                                    {{ $entidad->nombre }}

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