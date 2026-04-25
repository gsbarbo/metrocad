@props(['route', 'icon'])

@php
    $active = request()->routeIs($route . '.*') || request()->routeIs($route);
@endphp

<a href="{{ route($route) }}" @class([
    'flex items-center gap-3 px-2 py-2 rounded-md text-sm transition-colors overflow-hidden',
    'bg-navigation-active text-text' => $active,
    'text-text-muted hover:text-text hover:bg-navigation-hover' => !$active,
])>
    <x-dynamic-component :component="$icon" class="w-8 h-8 shrink-0" />
    <span class="whitespace-nowrap font-medium transition-opacity duration-150"
        :class="sidebarExpanded ? 'opacity-100' : 'opacity-0'">
        {{ $slot }}
    </span>
</a>
