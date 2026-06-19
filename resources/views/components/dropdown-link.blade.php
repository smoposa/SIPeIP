<a {{ $attributes->merge([
    'class' => 'block w-full px-4 py-2 text-start text-sm leading-5 text-black hover:bg-[#edebe9] focus:outline-none focus:bg-[#edebe9] transition duration-150 ease-in-out'
]) }}>
    {{ $slot }}
</a>