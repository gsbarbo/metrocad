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
        <x-sidebar_link :active="request()->is('supervisor')" :href="route('admin.dashboard')">
            <x-slot:icon>
                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="m4.5 18.75 7.5-7.5 7.5 7.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="m4.5 12.75 7.5-7.5 7.5 7.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

            </x-slot:icon>
            Supervisor
        </x-sidebar_link>
        <x-sidebar_link :active="request()->is('admin')" :href="route('admin.dashboard')">
            <x-slot:icon>
                <svg class="h-6 w-6 flex-shrink-0" class="feather feather-shield" fill="none" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                </svg>
            </x-slot:icon>
            Admin
        </x-sidebar_link>
        <hr>
        <x-sidebar_header>
            Management
        </x-sidebar_header>
        @can('admin:announcement:access')
            <x-sidebar_link :active="request()->is('admin/announcement/*') || request()->is('admin/announcement')" :href="route('admin.announcement.index')">
                <x-slot:icon>
                    <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke-width="1.5" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </x-slot:icon>
                Announcements
            </x-sidebar_link>
        @endcan
        @can('admin:user:access')
            <x-sidebar_link :active="request()->is('admin/user') || request()->is('admin/user/*')" :href="route('admin.user.index')">
                <x-slot:icon>
                    <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke-width="1.5" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </x-slot:icon>
                Users
            </x-sidebar_link>
        @endcan
        @can('admin:cad_settings:access')
            <x-sidebar_link :active="request()->is('admin/settings') || request()->is('admin/settings/*')" :href="route('admin.settings.general')">
                <x-slot:icon>
                    <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke-width="1.5" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </x-slot:icon>
                CAD Settings
            </x-sidebar_link>
        @endcan
    </nav>
</div>
