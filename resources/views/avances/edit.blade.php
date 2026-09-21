<x-seguimiento-layout>
    <div class="mx-auto max-w-5xl">
        <div class="mb-5"><h2 class="text-2xl font-semibold text-gray-800">Editar avance</h2><p class="text-sm text-gray-500">Solo los registros en borrador pueden modificarse.</p></div>
        <form method="POST" action="{{ route('avances.update', $avance) }}" class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
            @csrf @method('PUT')
            @include('avances.partials.form')
            <div class="mt-6 flex justify-end gap-3"><a href="{{ route('avances.detalle', $avance) }}" class="rounded-md border px-4 py-2 text-sm">Cancelar</a><button class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white">Actualizar avance</button></div>
        </form>
    </div>
</x-seguimiento-layout>
