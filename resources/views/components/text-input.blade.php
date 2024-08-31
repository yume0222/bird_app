@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-900 focus:ring-indigo-900 rounded-md shadow-sm']) !!}>
