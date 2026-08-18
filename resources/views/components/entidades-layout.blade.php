<x-app-layout>
    
    <!-- Header -->
    <x-slot name="header">
        <h2 class="text-xl text-gray-800 leading-tight">
            <span class="font-semibold">
                Entidades |
            </span>

            <span class="font-normal">
                {{ $title }}
            </span>
        </h2>
    </x-slot>

    <!-- Contenido -->
    <div class="flex-1 px-4 pt-1 pb-4">
        {{ $slot }}
    </div>

</x-app-layout>