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

        <x-sidebar_link :active="request()->is('civilian/civilians') || request()->is('civilian/civilians/*')" :href="route('portal.dashboard')">
            <x-slot:icon>
                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>

            </x-slot:icon>
            Civilian
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

        <x-sidebar_link :active="request()->is('')" :href="route('portal.dashboard')">
            <x-slot:icon>
                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>

            </x-slot:icon>
            CAD/MDT
        </x-sidebar_link>

        <x-sidebar_link :active="request()->is('')" :href="route('portal.dashboard')">
            <x-slot:icon>
                <svg class="h-6 w-6 flex-shrink-0" fill="#ffffff" id="Layer_1" stroke="#ffffff" version="1.1"
                    viewBox="0 0 508.053 508.053" width="200px" xml:space="preserve"
                    xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <g>
                            <g>
                                <path
                                    d="M475.897,76.703l-62.1-64.6c-4.5-4.6-11.5-5.7-17.1-2.5c-54.4,30.8-123.5-1.5-135.1-7.4c-3.7-2.4-8.5-2.9-12.7-1.2 c-0.9,0.3-1.7,0.8-2.5,1.3c-12,6.1-80.8,38-135,7.4c-5.6-3.2-12.6-2.1-17.1,2.5l-62.2,64.5c-3.3,3.5-4.7,8.4-3.6,13.1 c0.3,1.2,28.4,120.5,10.3,181.6c-0.1,0.3-0.2,0.6-0.2,0.9c-1.5,6.2-31.6,153.7,210.8,235c3.1,1,6.2,1,9.1,0 c242.5-81.3,212.4-228.8,211-235c-0.1-0.3-0.2-0.6-0.2-0.9c-18.1-61.1,10-180.4,10.3-181.6 C480.597,85.103,479.297,80.103,475.897,76.703z M441.997,278.803c1.3,7.2,20.5,128.6-188,200.2 c-208.8-71.8-189.7-191.5-188-200.2c17.3-59.6-2.2-159.6-8.3-188l49.6-51.6c58.7,26.5,125,0.7,146.7-9.3 c21.7,10,88,35.8,146.7,9.3l49.6,51.6C444.097,119.203,424.697,219.203,441.997,278.803z">
                                </path>
                            </g>
                        </g>
                        <g>
                            <g>
                                <path
                                    d="M390.197,187.003l-93.6-0.3l-29.2-88.9c-4.3-12.9-22.6-12.9-26.8,0l-29.2,88.9l-93.6,0.3c-13.6,0-19.3,17.5-8.3,25.5 l75.6,55.3l-28.7,89.1c-4.2,13,10.6,23.7,21.7,15.8l75.9-54.8l75.9,54.8c11,8,25.9-2.8,21.7-15.8l-28.7-89.1l75.6-55.3 C409.497,204.503,403.797,187.103,390.197,187.003z M297.997,251.003c-4.9,3.6-7,9.9-5.1,15.7l18.6,57.9l-49.2-35.6 c-4.9-3.6-11.6-3.6-16.5,0l-49.3,35.6l18.6-57.9c1.9-5.8-0.2-12.1-5.1-15.7l-49.1-35.9l60.8-0.2c6.1,0,11.5-3.9,13.4-9.7l19-57.8 l19,57.8c1.9,5.8,7.3,9.7,13.4,9.7l60.8,0.2L297.997,251.003z">
                                </path>
                            </g>
                        </g>
                    </g>
                </svg>

            </x-slot:icon>
            Workbench
        </x-sidebar_link>

        <hr>

        {{-- @foreach ($departments as $department)
            <x-sidebar_link :active="request()->is('portal/department/' . $department->slug) ||
                request()->is('portal/department/' . $department->slug . '/*')" :href="route('portal.department.show', $department->slug)">
                <x-slot:icon>
                    <img alt="{{ $department->initials }} Logo" class="h-6 w-6 flex-shrink-0"
                        src="{{ $department->logo }}">
                </x-slot:icon>
                {{ $department->initials }}
            </x-sidebar_link>
        @endforeach --}}

        <hr>

        @can('admin:menu:access')
            <x-sidebar_link :active="request()->is('admin/*') || request()->is('admin')" :href="route('portal.dashboard')">
                <x-slot:icon>
                    <svg class="h-6 w-6 flex-shrink-0" class="feather feather-shield" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </x-slot:icon>
                Admin
            </x-sidebar_link>
        @endcan
    </nav>
</div>
