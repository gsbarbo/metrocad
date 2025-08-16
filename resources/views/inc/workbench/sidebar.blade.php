<div class="bg-sidebar">
    <!-- Desktop sidebar -->
    <div class="z-10 flex-shrink-0 hidden md:block overflow-y-auto scrollbar-hide"
         x-data="{ isSidebarExpanded: false }">
        <aside :class="isSidebarExpanded ? 'w-64' : 'w-20'" @mouseout="isSidebarExpanded = false"
               @mouseover="isSidebarExpanded = true"
               class="flex flex-col text-gray-300 bg-sidebar transition-all duration-300 ease-in-out h-screen">
            <x-workbench.sidebar-links></x-workbench.sidebar-links>
        </aside>
    </div>

    <!-- Mobile sidebar -->
    <!-- Backdrop -->
    <div
        class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 md:bg-opacity-0 sm:items-center sm:justify-center"
        x-show="isSidebarExpanded" x-transition:enter-end="opacity-100" x-transition:enter-start="opacity-0"
        x-transition:enter="transition ease-in-out duration-150" x-transition:leave-end="opacity-0"
        x-transition:leave-start="opacity-100" x-transition:leave="transition ease-in-out duration-150">
    </div>
    <aside @click.away="isSidebarExpanded = false"
           class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-sidebar md:hidden scrollbar-hide"
           x-show="isSidebarExpanded" x-transition:enter-end="opacity-100"
           x-transition:enter-start="opacity-0 transform -translate-x-20"
           x-transition:enter="transition ease-in-out duration-150"
           x-transition:leave-end="opacity-0 transform -translate-x-20" x-transition:leave-start="opacity-100"
           x-transition:leave="transition ease-in-out duration-150">
        <x-workbench.sidebar-links/>
    </aside>
</div>
