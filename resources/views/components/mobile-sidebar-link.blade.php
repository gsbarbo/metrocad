@props(['route', 'icon'])

@php
    $active = request()->routeIs($route);
@endphp

<a href="{{ route($route) }}" @class([
    'flex items-center gap-3 px-3 py-2 rounded-md text-sm transition-colors',
    'bg-navigation-active text-text' => $active,
    'text-text-muted hover:text-text hover:bg-navigation-hover' => !$active,
])>
    <x-dynamic-component :component="$icon" class="w-5 h-5 shrink-0" />
    <span class="font-medium">{{ $slot }}</span>
</a>
