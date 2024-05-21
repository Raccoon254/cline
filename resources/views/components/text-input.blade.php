@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'border-gray-300 bg-opacity-0 bg-warning text-black  focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm',
]) !!}>
