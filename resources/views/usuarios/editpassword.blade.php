<x-usuarios-layout title="Restablecer Contraseña">

    <div class="bg-white border-b border-gray-300">

        <div class="flex gap-6">

            <a href="{{ route('usuarios.show', $usuario->id) }}"
               class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">

                <i class="bi bi-chevron-left"></i>
                Regresar

            </a>
        </div>

    </div>

    <div class="overflow-y-auto"
         style="height: calc(100vh - 180px);">

        <div class="p-4">

            <p class="mt-1 text-sm text-gray-500">
                Defina una nueva contraseña para el usuario.
            </p>

        </div>

        <div class="bg-white p-4">

            <form method="POST"
                  action="{{ route('usuarios.actualizarpassword', $usuario->id) }}">

                @csrf
                @method('PUT')

                <div class="space-y-6">


                
<div class="space-y-4 mb-8">

    <div class="flex items-center gap-20">

        <label class="w-4 text-sm font-medium text-gray-700">
            Usuario
        </label>

        <span class="text-sm text-gray-600">
            {{ $usuario->nombres }}
            {{ $usuario->apellidos }}
        </span>

    </div>

    <div class="flex items-center gap-20">

        <label class="w-4 text-sm font-medium text-gray-700">
            Correo
        </label>

        <span class="text-sm text-gray-600">
            {{ $usuario->email }}
        </span>

    </div>

</div>

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nueva contraseña
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="w-96 border-gray-300 rounded-md">

                    </div>

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Confirmar contraseña
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="w-96 border-gray-300 rounded-md">

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