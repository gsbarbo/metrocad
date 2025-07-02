<div class="">
    <a class="h-16 flex items-center px-4 bg-navbar hover:text-gray-100 hover:bg-opacity-50 focus:outline-none focus:text-gray-100 focus:bg-opacity-50 overflow-hidden"
        href="#">
        <img alt="Community Logo" class="h-12 w-12" src="{{ get_setting('community_logo') }}">
        <span :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'"
            class="ml-2 text-xl font-medium duration-300 ease-in-out">{{ get_setting('community_name') }}</span>
    </a>
    <nav class="p-4 space-y-2">
        <x-sidebar_link :active="request()->is('portal')" :href="route('portal.dashboard')">
            <x-slot:icon>
                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </x-slot:icon>
            Portal
        </x-sidebar_link>
        <hr>
        <x-sidebar_link :active="request()->is('civilians') || request()->is('civilians/*')" :href="route('civilians.index')">
            <x-slot:icon>
                <svg class="size-6 flex-shrink-0" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>

            </x-slot:icon>
            Civilians
        </x-sidebar_link>

        <x-sidebar_link :active="request()->is('')" :href="route('portal.dashboard')">
            <x-slot:icon>
                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>

            </x-slot:icon>
            Courthouse
        </x-sidebar_link>
    </nav>
</div>
