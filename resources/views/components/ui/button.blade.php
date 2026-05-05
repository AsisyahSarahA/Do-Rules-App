@props([
    'variant' => 'primary',
    'size' => 'md',
    'icon' => null,
    'iconPosition' => 'left'
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-medium transition-all duration-200 ease-in-out rounded-lg hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:translate-y-0';

    $variants = [
        'primary' => 'bg-teal-700 text-white hover:bg-teal-800 focus:ring-teal-700 shadow-md hover:shadow-lg',
        'secondary' => 'bg-slate-100 text-slate-700 hover:bg-slate-200 focus:ring-slate-500',
        'outline' => 'border-2 border-teal-700 text-teal-700 hover:bg-teal-50 focus:ring-teal-700',
        'white' => 'bg-white text-teal-900 hover:bg-slate-50 focus:ring-white shadow-md hover:shadow-lg',
        'outline-white' => 'border-2 border-white text-white hover:bg-white/10 focus:ring-white',
    ];

    $sizes = [
        'sm' => 'px-3 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-base',
        'lg' => 'px-6 py-3 text-lg',
    ];

    $classes = $baseClasses . ' ' . $variants[$variant] . ' ' . $sizes[$size];
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>
    @if ($icon && $iconPosition === 'left')
        <span class="mr-2 -ml-1">
            {{ $icon }}
        </span>
    @endif

    {{ $slot }}

    @if ($icon && $iconPosition === 'right')
        <span class="ml-2 -mr-1">
            {{ $icon }}
        </span>
    @endif
</button>
