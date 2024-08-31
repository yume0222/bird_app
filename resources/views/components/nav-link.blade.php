@props(['active'])

<style>
    .nav-link-inactive {
        color: #9DC3C0;
        background: white;
        border: 1px solid #9DC3C0;
    }
</style>

@php
$classes = 'nav-link ' . ($active ?? false ? 'nav-link-active' : 'nav-link-inactive');
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>