<aside
    class="hidden lg:flex flex-col bg-navigation border-r border-border shrink-0 overflow-hidden z-20 transition-[width] duration-200 ease-in-out"
    :class="sidebarExpanded ? 'w-72' : 'w-14'" @mouseenter="sidebarExpanded = true" @mouseleave="sidebarExpanded = false">
    {{-- Logo --}}
    <div class="h-14 flex items-center px-3.5 border-b border-gray-800 shrink-0 overflow-hidden">
        <div class="w-7 h-7 rounded-md flex items-center justify-center shrink-0">
            <img src="{{ asset(setting('community.logo_url')) }}" class="text-white" />
        </div>
        <span class="ml-3 text-white font-semibold text-sm whitespace-nowrap transition-opacity duration-150"
            :class="sidebarExpanded ? 'opacity-100' : 'opacity-0'">
            {{ setting('community.name') }}
        </span>
    </div>

    {{-- Nav links --}}
    <nav class="flex-1 py-3 px-2 space-y-0.5 overflow-hidden">
        @foreach (\App\Helpers\Menu\CivilianMenuHelper::links() as $link)
            {{-- @if (!$link['permission'] || auth()->user()->can($link['permission'])) --}}
            <x-sidebar-link :route="$link['route']" :icon="$link['icon']">
                {{ $link['label'] }}
            </x-sidebar-link>
            {{-- @endif --}}
        @endforeach
    </nav>

    {{-- Bottom --}}
    <div class="py-3 px-2 border-t border-border overflow-hidden">
        @foreach (\App\Helpers\Menu\CivilianMenuHelper::bottomLinks() as $link)
            <x-sidebar-link :route="$link['route']" :icon="$link['icon']">
                {{ $link['label'] }}
            </x-sidebar-link>
        @endforeach
    </div>
</aside>

{{-- Overlay --}}
<div x-show="mobileSidebar" x-transition:enter="transition-opacity duration-200" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    class="fixed inset-0 bg-black/60 z-30 lg:hidden" @click="mobileSidebar = false" x-cloak></div>

<aside x-show="mobileSidebar" x-transition:enter="transition-transform duration-200"
    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
    x-transition:leave="transition-transform duration-200" x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    class="fixed top-0 left-0 h-full w-64 bg-navigation border-r border-border z-40 flex flex-col lg:hidden" x-cloak>
    <div class="h-14 flex items-center px-4 border-b border-border justify-between">
        <div class="flex items-center gap-3">
            <div class="w-7 h-7 rounded-md flex items-center justify-center shrink-0">
                <img src="{{ asset(setting('community.logo_url')) }}" class="text-white" />
            </div>
            <span class="text-white font-semibold text-sm">
                {{ setting('community.name') }}
            </span>
        </div>
        <button @click="mobileSidebar = false" class="text-gray-400 hover:text-gray-200 p-1">
            <x-heroicon-o-x-mark class="w-5 h-5 cursor-pointer" />
        </button>
    </div>

    <nav class="flex-1 py-3 px-2 space-y-0.5 overflow-y-auto">
        @foreach (\App\Helpers\Menu\CivilianMenuHelper::links() as $link)
            <x-mobile-sidebar-link :route="$link['route']" :icon="$link['icon']">
                {{ $link['label'] }}
            </x-mobile-sidebar-link>
        @endforeach
    </nav>

    <div class="py-3 px-2 border-t border-border">
        @foreach (\App\Helpers\Menu\CivilianMenuHelper::bottomLinks() as $link)
            <x-mobile-sidebar-link :route="$link['route']" :icon="$link['icon']">
                {{ $link['label'] }}
            </x-mobile-sidebar-link>
        @endforeach
    </div>
</aside>
