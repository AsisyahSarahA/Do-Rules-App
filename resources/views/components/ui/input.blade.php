@props([
    'disabled' => false,
    'label' => null,
    'id' => null,
    'icon' => null,
])

@php
    $id = $id ?? $attributes->get('name');
    $hasError = $errors->has($attributes->get('name'));
@endphp

<div class="w-full">
    @if ($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-slate-700 mb-1">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        @if ($icon)
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                {{ $icon }}
            </div>
        @endif

        <input {{ $disabled ? 'disabled' : '' }} 
               id="{{ $id }}"
               {!! $attributes->merge([
                   'class' => 'block w-full rounded-md shadow-sm transition-colors duration-200 focus:ring-teal-500 focus:border-teal-500 sm:text-sm ' . 
                              ($icon ? 'pl-10 ' : '') .
                              ($hasError ? 'border-rose-300 text-rose-900 placeholder-rose-300 focus:ring-rose-500 focus:border-rose-500' : 'border-slate-300')
               ]) !!}>
    </div>

    @if ($hasError)
        <p class="mt-2 text-sm text-rose-600" id="{{ $id }}-error">
            {{ $errors->first($attributes->get('name')) }}
        </p>
    @endif
</div>
