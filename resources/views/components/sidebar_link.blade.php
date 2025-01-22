<a class="flex items-center h-10 px-3 text-white rounded-lg transition-colors hover:bg-navbar duration-150 ease-in-out focus:outline-none focus:shadow-outline @if ($active) bg-navbar @endif"
    href="{{ $href }}">
    {{ $icon }}
    <span :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'"
        class="text-nowrap overflow-hidden ml-2 duration-300 ease-in-out">
        {{ $slot }}
    </span>
</a>
