<x-app-layout>
    <div class="px-4 py-5 sm:px-6">
        <div class="rounded-lg border border-gray-200 bg-white p-5 sm:p-6">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-[#024687]">SIPeIP · Inicio</p>
                    <h1 class="mt-1 text-2xl font-semibold text-gray-800">Bienvenido, {{ trim(($usuario->nombres ?? '').' '.($usuario->apellidos ?? '')) ?: $usuario->name }}</h1>
                    <p class="mt-2 text-sm text-gray-500">{{ $usuario->rol?->nombre ?? 'Sin rol asignado' }} @if($usuario->entidad) · {{ $usuario->entidad->nombre }} @endif</p>
                </div>
                @if(puedeVer('reportes'))
                    <a href="{{ route('reportes.index') }}" class="inline-flex items-center gap-2 rounded-md bg-[#024687] px-4 py-2 text-sm font-medium text-white hover:bg-blue-800">
                        <i class="bi bi-bar-chart-line"></i> Ver reportes
                    </a>
                @endif
            </div>
        </div>

        @if(!$usuario->entidad_id)
            <div class="mt-5 rounded-lg border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800">
                Tu usuario no tiene una entidad asignada. Los indicadores institucionales estarán disponibles cuando se asigne una.
            </div>
        @endif

        @if(count($tarjetas))
            <section class="mt-6" aria-labelledby="titulo-resumen">
                <div class="mb-3">
                    <h2 id="titulo-resumen" class="text-lg font-semibold text-gray-800">Resumen institucional</h2>
                    <p class="text-sm text-gray-500">Registros de tu entidad a los que tienes acceso.</p>
                </div>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                    @foreach($tarjetas as $tarjeta)
                        <a href="{{ route($tarjeta['ruta']) }}" class="group rounded-lg border border-gray-200 bg-white p-5 transition hover:border-[#024687] hover:shadow-sm">
                            <div class="flex items-center justify-between">
                                <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#C9D5E2] text-[#024687]"><i class="bi {{ $tarjeta['icono'] }} text-lg"></i></span>
                                <i class="bi bi-arrow-up-right text-gray-400 group-hover:text-[#024687]"></i>
                            </div>
                            <p class="mt-4 text-3xl font-semibold text-gray-800">{{ number_format($tarjeta['total']) }}</p>
                            <p class="mt-1 text-sm text-gray-600">{{ $tarjeta['nombre'] }}</p>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        @if(count($catalogos))
            <section class="mt-6" aria-labelledby="titulo-catalogos">
                <h2 id="titulo-catalogos" class="mb-3 text-lg font-semibold text-gray-800">Catálogos nacionales</h2>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                    @foreach($catalogos as $catalogo)
                        <a href="{{ route($catalogo['ruta']) }}" class="rounded-lg border border-gray-200 bg-white p-4 hover:border-[#024687] hover:shadow-sm">
                            <i class="bi {{ $catalogo['icono'] }} text-[#024687]"></i>
                            <span class="ml-2 text-sm text-gray-600">{{ $catalogo['nombre'] }}</span>
                            <p class="mt-2 text-2xl font-semibold text-gray-800">{{ number_format($catalogo['total']) }}</p>
                            <p class="text-xs text-gray-500">Total nacional</p>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        <div class="mt-6 grid grid-cols-1 gap-5 {{ count($recientes) ? 'xl:grid-cols-3' : '' }}">
            <section class="rounded-lg border border-gray-200 bg-white p-5 {{ count($recientes) ? 'xl:col-span-2' : '' }}" aria-labelledby="titulo-accesos">
                <h2 id="titulo-accesos" class="text-lg font-semibold text-gray-800">Accesos a tus módulos</h2>
                <p class="mt-1 text-sm text-gray-500">Opciones disponibles para tu perfil.</p>
                <div class="mt-4 grid grid-cols-1 gap-2 sm:grid-cols-2">
                    @forelse($accesos as $acceso)
                        <a href="{{ route($acceso['ruta']) }}" class="flex items-center gap-3 rounded-md border border-gray-200 p-3 text-sm text-gray-700 hover:border-[#024687] hover:bg-blue-50">
                            <i class="bi {{ $acceso['icono'] }} text-[#024687]"></i>
                            <span>{{ $acceso['nombre'] }}</span>
                            <i class="bi bi-chevron-right ml-auto text-xs text-gray-400"></i>
                        </a>
                    @empty
                        <p class="text-sm text-gray-500">No hay módulos adicionales habilitados para este perfil.</p>
                    @endforelse
                </div>
            </section>

            @if(count($recientes))
                <section class="rounded-lg border border-gray-200 bg-white p-5" aria-labelledby="titulo-recientes">
                    <h2 id="titulo-recientes" class="text-lg font-semibold text-gray-800">Últimos {{ $tipoRecientes }}</h2>
                    <p class="mt-1 text-sm text-gray-500">Registros recientes de tu entidad.</p>
                    <div class="mt-3 divide-y divide-gray-100">
                        @foreach($recientes as $registro)
                            <a href="{{ route($tipoRecientes === 'proyectos' ? 'proyectos.detalle' : 'planes.detalle', $registro->id) }}" class="block py-3 hover:text-[#024687]">
                                <p class="text-sm font-medium">{{ $registro->codigo }} · {{ $registro->nombre }}</p>
                                <p class="mt-1 text-xs text-gray-500">{{ $registro->estado_proceso }}</p>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </div>
</x-app-layout>
