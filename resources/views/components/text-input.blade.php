@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge([
'class' => 'border-gray-300 bg-white text-gray-900 text-sm px-3 py-2 focus:border-blue-600 focus:ring-blue-600 rounded-md shadow-sm'
]) }}>