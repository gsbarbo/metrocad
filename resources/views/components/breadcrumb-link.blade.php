@props(['href'])

<li class="inline-flex items-center gap-x-1">
    <x-heroicon-s-chevron-right class="size-3.5 text-text-muted/50" />
    <a href="{{ $href }}" class="text-text-muted hover:text-text transition-colors">{{ $slot }}</a>
</li>
