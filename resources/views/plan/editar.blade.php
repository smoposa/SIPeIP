<x-plan-layout title="Editar Plan Estratégico Institucional">

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

<!-- Barra superior -->
<div class="bg-white border-b border-gray-300 mb-0">

    <div class="flex">

        <a href="{{ route('planes.detalle', $plan->id) }}"
            class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">

            <i class="bi bi-chevron-left"></i>

            Regresar

        </a>

    </div>

</div>

<!-- Contenido -->
<div class="bg-white p-6 shadow-sm">

    <!-- Encabezado -->
    <div class="mb-6">

        <h2 class="text-2xl font-semibold text-gray-800">
            Actualizar Plan Estratégico Institucional
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Actualice la información del Plan Estratégico Institucional registrado en el Sistema Integral de Planificación e Inversión Pública (SIPeIP).
        </p>

    </div>

    <!-- Scroll -->
    <div class="overflow-y-auto" style="height: calc(100vh - 300px);">

        <form method="POST"
            action="{{ route('planes.actualizar', $plan->id) }}">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Código -->
                <div>

                    <x-input-label
                        for="codigo"
                        value="Código del Plan" />

                    <x-text-input
                        id="codigo"
                        type="text"
                        class="mt-1 block w-full bg-gray-100"
                        value="{{ $plan->codigo }}"
                        readonly />

                </div>

                <div></div>

                <!-- Nombre -->
                <div class="md:col-span-2">

                    <x-input-label
                        for="nombre"
                        value="Nombre del Plan Estratégico Institucional" />

                    <x-text-input
                        id="nombre"
                        name="nombre"
                        type="text"
                        class="mt-1 block w-full"
                        :value="old('nombre', $plan->nombre)" />

                    <x-input-error
                        :messages="$errors->get('nombre')"
                        class="mt-2" />

                </div>

                <!-- Entidad -->
                <div class="md:col-span-2">

                    <x-input-label
                        for="entidad_id"
                        value="Entidad" />

                    <select
                        id="entidad_id"
                        name="entidad_id"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                        @foreach($entidades as $entidad)

                            <option
                                value="{{ $entidad->id }}"
                                {{ old('entidad_id', $plan->entidad_id) == $entidad->id ? 'selected' : '' }}>

                                {{ $entidad->nombre }}

                            </option>

                        @endforeach

                    </select>

                    <x-input-error
                        :messages="$errors->get('entidad_id')"
                        class="mt-2" />

                </div>
                                <!-- Período Inicio -->
                <div>

                    <x-input-label
                        for="periodo_inicio"
                        value="Período inicio" />

                    <select
                        id="periodo_inicio"
                        name="periodo_inicio"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                        @foreach($anios as $anio)

                            <option
                                value="{{ $anio }}"
                                {{ old('periodo_inicio', $plan->periodo_inicio) == $anio ? 'selected' : '' }}>

                                {{ $anio }}

                            </option>

                        @endforeach

                    </select>

                    <x-input-error
                        :messages="$errors->get('periodo_inicio')"
                        class="mt-2" />

                </div>

                <!-- Período Fin -->
                <div>

                    <x-input-label
                        for="periodo_fin"
                        value="Período fin" />

                    <select
                        id="periodo_fin"
                        name="periodo_fin"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                        @foreach($anios as $anio)

                            <option
                                value="{{ $anio }}"
                                {{ old('periodo_fin', $plan->periodo_fin) == $anio ? 'selected' : '' }}>

                                {{ $anio }}

                            </option>

                        @endforeach

                    </select>

                    <x-input-error
                        :messages="$errors->get('periodo_fin')"
                        class="mt-2" />

                </div>

                <!-- Fecha Inicio -->
                <div>

                    <x-input-label
                        for="fecha_inicio"
                        value="Fecha inicio" />

                    <x-text-input
                        id="fecha_inicio"
                        name="fecha_inicio"
                        type="date"
                        class="mt-1 block w-full"
                        :value="old('fecha_inicio', $plan->fecha_inicio)" />

                    <x-input-error
                        :messages="$errors->get('fecha_inicio')"
                        class="mt-2" />

                </div>

                <!-- Fecha Fin -->
                <div>

                    <x-input-label
                        for="fecha_fin"
                        value="Fecha fin" />

                    <x-text-input
                        id="fecha_fin"
                        name="fecha_fin"
                        type="date"
                        class="mt-1 block w-full"
                        :value="old('fecha_fin', $plan->fecha_fin)" />

                    <x-input-error
                        :messages="$errors->get('fecha_fin')"
                        class="mt-2" />

                </div>

                <!-- Estado -->
                <div>

                    <x-input-label
                        for="estado"
                        value="Estado" />

                    <select
                        id="estado"
                        name="estado"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                        <option value="Activo"
                            {{ old('estado', $plan->estado) == 'Activo' ? 'selected' : '' }}>
                            Activo
                        </option>

                        <option value="Finalizado"
                            {{ old('estado', $plan->estado) == 'Finalizado' ? 'selected' : '' }}>
                            Finalizado
                        </option>

                    </select>

                    <x-input-error
                        :messages="$errors->get('estado')"
                        class="mt-2" />

                </div>
                                <!-- Descripción -->
                <div class="md:col-span-2">

                    <x-input-label
                        for="descripcion"
                        value="Descripción del Plan Estratégico Institucional" />

                    <textarea
                        id="descripcion"
                        name="descripcion"
                        rows="5"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('descripcion', $plan->descripcion) }}</textarea>

                    <x-input-error
                        :messages="$errors->get('descripcion')"
                        class="mt-2" />

                </div>

            </div>

            <!-- Botones -->
            <div class="flex gap-3 mt-8">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">

                    Actualizar

                </button>

                <a href="{{ route('planes.listar') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">

                    Cancelar

                </a>

            </div>

        </form>

    </div>

</div>

</x-plan-layout>