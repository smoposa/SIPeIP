<x-usuarios-layout title="Usuarios registrados">

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

    <!-- Encabezado -->
    <div class="mb-6">

        <h2 class="text-2xl font-semibold text-gray-800">
            Usuarios registrados
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Visualice y administre los usuarios registrados en el Sistema Integral de Planificación e Inversión Pública (SIPeIP).
        </p>

    </div>

    <!-- Tabla -->
    <div class="overflow-y-auto" style="height: calc(100vh - 210px);">

        <div class="bg-white border border-gray-200 rounded-lg">

<table class="min-w-full">

    <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">

        <tr>

            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                Nro
            </th>

            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                Usuario
            </th>

            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                Cargo
            </th>

            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                Entidad
            </th>

            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                Estado
            </th>

        </tr>

    </thead>

    <tbody>

        @forelse($usuarios as $usuario)

            <tr class="border-b border-gray-100 hover:bg-gray-50">

                <!-- Nro -->
                <td class="px-4 py-3 text-sm text-gray-600">
                    {{ $loop->iteration }}
                </td>

                <!-- Usuario -->
                <td class="px-4 py-3">

<a href="{{ route('usuarios.show', $usuario->id) }}"
   class="text-blue-600 hover:text-blue-800 hover:underline text-sm font-medium">

    {{ $usuario->nombres }} {{ $usuario->apellidos }}

</a>

<p class="text-xs text-gray-500 mt-0.5">

    {{ $usuario->email }}

</p>

                </td>

                <!-- Cargo -->
                <td class="px-4 py-3 text-sm text-gray-600">

                    {{ $usuario->cargo }}

                </td>

                <!-- Entidad -->
                <td class="px-4 py-3 text-sm text-gray-600 max-w-sm">

                    <span class="block line-clamp-2"
                          title="{{ $usuario->entidad?->nombre }}">

                        {{ $usuario->entidad?->nombre ?? 'Sin entidad' }}

                    </span>

                </td>

                <!-- Estado -->
                <td class="px-4 py-3">

                    @if($usuario->estado == 'Activo')

                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                            Habilitado
                        </span>

                    @else

                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">
                            Deshabilitado
                        </span>

                    @endif

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="5"
                    class="px-4 py-6 text-center text-gray-500">

                    No existen usuarios registrados.

                </td>

            </tr>

        @endforelse

    </tbody>

</table>

        </div>

    </div>

</x-usuarios-layout>