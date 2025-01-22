@props(['department'])
<div class="">
    <a class="h-16 flex items-center px-4 bg-navbar hover:text-gray-100 hover:bg-opacity-50 focus:outline-none focus:text-gray-100 focus:bg-opacity-50 overflow-hidden"
        href="#">
        <img alt="Community Logo" class="h-12 w-12" src="{{ $department->logo }}">
        <span :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'"
            class="ml-2 text-xl font-medium duration-300 ease-in-out">{{ $department->initials }}</span>
    </a>

    <nav class="p-4 space-y-2">
        <x-sidebar_link :active="request()->is('portal')" :href="route('portal.home')">
            <x-slot:icon>
                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d=" m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125
            1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504
            1.125-1.125V9.75M8.25 21h8.25" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

            </x-slot:icon>
            Portal
        </x-sidebar_link>

        <hr>

        <x-sidebar_link :active="request()->is('portal/department/' . $department->slug)" :href="route('portal.department.show', $department->slug)">
            <x-slot:icon>
                <img alt="" class="h-6 w-6 flex-shrink-0" src="{{ $department->logo }}">
            </x-slot:icon>
            Home
        </x-sidebar_link>

        <x-sidebar_link :active="request()->is('portal/department/' . $department->slug . '/roster')" :href="route('portal.department.roster', $department->slug)">
            <x-slot:icon>
                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </x-slot:icon>
            Roster
        </x-sidebar_link>

        <x-sidebar_link :active="request()->is('portal/department/' . $department->slug . '/resources')" :href="route('portal.department.roster', $department->slug)">
            <x-slot:icon>
                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>

            </x-slot:icon>
            Resources
        </x-sidebar_link>
        <x-sidebar_link :active="request()->is('portal/department/' . $department->slug . '/resources')" :href="route('portal.department.roster', $department->slug)">
            <x-slot:icon>
                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>

            </x-slot:icon>
            Subdivisions
        </x-sidebar_link>
        <hr>
        <x-sidebar_link :active="request()->is('portal/department/' . $department->slug . '/resources')" :href="route('portal.department.roster', $department->slug)">
            <x-slot:icon>
                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="m4.5 18.75 7.5-7.5 7.5 7.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="m4.5 12.75 7.5-7.5 7.5 7.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

            </x-slot:icon>
            Staff
        </x-sidebar_link>

        <x-sidebar_link :active="request()->is('portal/department/' . $department->slug . '/resources')" :href="route('portal.department.roster', $department->slug)">
            <x-slot:icon>
                <svg class="h-6 w-6 flex-shrink-0" class="feather feather-shield" fill="none" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                </svg>
            </x-slot:icon>
            Admin
        </x-sidebar_link>

    </nav>
</div>
