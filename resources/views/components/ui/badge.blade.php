@props([
    'variant' => 'info',
])

@php
    $baseClasses = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium';

    $variants = [
        'info' => 'bg-teal-100 text-teal-800',
        'success' => 'bg-emerald-100 text-emerald-800',
        'warning' => 'bg-amber-100 text-amber-800',
        'danger' => 'bg-rose-100 text-rose-800',
        'neutral' => 'bg-slate-100 text-slate-800',
    ];

    $classes = $baseClasses . ' ' . $variants[$variant];
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
