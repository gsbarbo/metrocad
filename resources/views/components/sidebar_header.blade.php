<p :class="isSidebarExpanded ? 'block' : 'border-b-4'"
    class="text-lg px-3 text-white rounded-lg font-light transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">
    <span :class="isSidebarExpanded ? 'block' : 'hidden'" class="duration-300 ease-in-out border-b-2">
        {{ $slot }}
    </span>
</p>
