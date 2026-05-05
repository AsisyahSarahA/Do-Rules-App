@props([
    'hover' => true,
    'padding' => 'p-6'
])

@php
    $baseClasses = 'bg-white rounded-xl border border-slate-100 shadow-sm transition-all duration-300';
    $hoverClasses = $hover ? 'hover:-translate-y-1 hover:shadow-lg hover:border-teal-100' : '';
    $classes = $baseClasses . ' ' . $hoverClasses . ' ' . $padding;
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
