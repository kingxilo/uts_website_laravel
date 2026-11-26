@props([
    'variant' => 'light',
    'size' => 'md',
    'showCompany' => true,
])

@php
    $imgSize = match ($size) {
        'sm' => 'h-9 w-9',
        'lg' => 'h-12 w-12',
        default => 'h-10 w-10',
    };
    $titleColor = $variant === 'dark' ? 'text-white' : 'text-stone-900';
    $subColor = $variant === 'dark' ? 'text-amber-400' : 'text-amber-700';
    $metaColor = $variant === 'dark' ? 'text-stone-400' : 'text-stone-500';
@endphp

<div {{ $attributes->merge(['class' => 'inline-flex items-center gap-3']) }}>
    <img
        src="{{ asset('images/logo-surya.svg') }}"
        alt="Logo Susilo Apriyansah - Surya Nusantara Kopi"
        class="{{ $imgSize }} shrink-0 rounded-full shadow-xs ring-1 ring-black/5"
    >
    <div class="leading-tight">
        <span class="block text-[11px] font-bold uppercase tracking-wider {{ $subColor }}">
            Susilo Apriyansah
        </span>
        <span class="block text-base font-extrabold tracking-tight {{ $titleColor }} sm:text-lg">
            Surya Nusantara Kopi
        </span>
        @if ($showCompany)
            <span class="block text-[11px] font-medium {{ $metaColor }}">
                PT Surya Rasa Nusantara
            </span>
        @endif
        <span class="sr-only">Susilo Apriyansah - Surya Nusantara Kopi</span>
    </div>
</div>
