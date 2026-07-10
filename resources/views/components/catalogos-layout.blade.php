<x-app-layout>

    <!-- Header -->
    <x-slot name="header">

        <h2 class="text-xl text-gray-800 leading-tight">

            <span class="font-semibold">
                Catálogos |
            </span>

            <span class="font-normal">
                {{ $title }}
            </span>

        </h2>

    </x-slot>

    <div class="px-4 pt-1 pb-4">

        {{ $slot }}

    </div>

</x-app-layout>