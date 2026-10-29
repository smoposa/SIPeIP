<!-- Cabecera del usuario -->
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