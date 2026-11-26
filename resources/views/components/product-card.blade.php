@props(['product'])

<article class="group flex flex-col overflow-hidden rounded-2xl border border-stone-200/80 bg-white p-3 shadow-[0_2px_10px_-3px_rgba(28,25,23,0.05)] transition-all duration-300 hover:-translate-y-1 hover:border-amber-500/40 hover:shadow-[0_14px_30px_-8px_rgba(28,25,23,0.12)]">
    <!-- Image Container -->
    <a
        href="{{ route('products.show', $product->slug) }}"
        class="relative block aspect-square overflow-hidden rounded-xl bg-stone-100"
        aria-label="Lihat detail {{ $product->name }}"
    >
        <img
            src="{{ $product->image_url }}"
            alt="{{ $product->name }}"
            loading="lazy"
            class="h-full w-full object-cover transition-transform duration-500 ease-out group-hover:scale-105"
        >

        <!-- Clean Translucent Badges -->
        <div class="pointer-events-none absolute inset-x-2.5 top-2.5 flex items-start justify-between gap-2">
            <span class="rounded-full bg-white/95 px-3 py-1 text-[11px] font-semibold text-stone-800 shadow-xs backdrop-blur-md">
                {{ $product->category?->name ?? 'Kopi Nusantara' }}
            </span>

            @if ($product->is_featured)
                <span class="rounded-full bg-amber-500 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide text-white shadow-xs">
                    Unggulan
                </span>
            @endif
        </div>
    </a>

    <!-- Card Content -->
    <div class="flex flex-1 flex-col px-1.5 pb-1.5 pt-4">
        <!-- Clean Spec Pills -->
        <div class="flex flex-wrap items-center gap-1.5">
            <span class="rounded-md bg-stone-100 px-2 py-0.5 text-[11px] font-semibold text-stone-600">
                {{ $product->weight_gram }}g/ml
            </span>
            @if ($product->roast_level)
                <span class="rounded-md bg-amber-50 px-2 py-0.5 text-[11px] font-semibold text-amber-800">
                    {{ $product->roast_level }}
                </span>
            @endif
        </div>

        <h3 class="mt-2.5 line-clamp-1 text-base font-bold text-stone-900 transition-colors group-hover:text-amber-700">
            <a href="{{ route('products.show', $product->slug) }}">
                {{ $product->name }}
            </a>
        </h3>

        @if ($product->origin)
            <p class="mt-0.5 truncate text-xs font-medium text-stone-500">
                {{ $product->origin }}
            </p>
        @endif

        <p class="mt-2 line-clamp-2 flex-1 text-xs leading-relaxed text-stone-600 sm:text-sm">
            {{ $product->description }}
        </p>

        <!-- Price & CTA Footer -->
        <div class="mt-4 flex items-center justify-between gap-2 border-t border-stone-100 pt-3.5">
            <div>
                <div class="flex items-center gap-1.5">
                    <span class="h-1.5 w-1.5 rounded-full {{ $product->stock > 0 ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                    <span class="text-[11px] font-medium text-stone-500">
                        {{ $product->stock > 0 ? 'Stok ' . $product->stock : 'Stok Habis' }}
                    </span>
                </div>
                <p class="text-base font-extrabold text-stone-900 tabular-nums sm:text-lg">
                    {{ $product->formatted_price }}
                </p>
            </div>

            <a
                href="{{ route('products.show', $product->slug) }}"
                class="inline-flex min-h-[38px] items-center gap-1.5 rounded-xl bg-stone-900 px-3.5 py-2 text-xs font-semibold text-white transition-colors duration-200 hover:bg-amber-700"
            >
                <span>Detail</span>
                <svg aria-hidden="true" class="h-3.5 w-3.5 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
    </div>
</article>
