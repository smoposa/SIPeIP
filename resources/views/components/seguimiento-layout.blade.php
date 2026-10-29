@props(['title' => 'Seguimiento'])

<x-app-layout>

    <x-slot name="header">

        <!-- Migas de pan -->
        @isset($breadcrumbs)

            <div class="-mx-6 -mt-3 mb-1 bg-gray-100 px-6 py-1 text-xs text-gray-500">
                {{ $breadcrumbs }}
            </div>

        @endisset

        <!-- Título -->
        <h2 class="text-xl text-gray-800 leading-tight">

            <span class="font-semibold">
                Seguimiento |
            </span>

            <span class="font-normal">
                {{ $title }}
            </span>

        </h2>

    </x-slot>


    <div class="min-w-0 px-4 pt-1 pb-4">
        {{ $slot }}
    </div>

</x-app-layout>