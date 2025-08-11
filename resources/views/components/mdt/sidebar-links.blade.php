<div class="bg-[#0C1011]">
    <nav class="p-4 space-y-2">
        <x-mdt.sidebar-link :href="route('portal.dashboard')" :no-hover="true" class="bg-blue-600">
            <x-slot:icon>
                <img src="{{auth()->user()->active_unit->civilian->picture}}" alt="" class="size-12 rounded-lg">
            </x-slot:icon>
            <p class="font-bold">{{auth()->user()->active_unit->user_department->badge_number}}</p>
            <p class="text-xs">{{auth()->user()->active_unit->civilian->name}}</p>
        </x-mdt.sidebar-link>

        <x-mdt.sidebar-link :active="request()->is('mdt/dashboard') || request()->is('mdt/dashboard/*')"
                            :href="route('mdt.dashboard')">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" class="size-6">
                    <rect width="256" height="256" fill="none"/>
                    <rect x="48" y="48" width="64" height="64" rx="8" fill="none" stroke="currentColor"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/>
                    <rect x="144" y="48" width="64" height="64" rx="8" fill="none" stroke="currentColor"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/>
                    <rect x="48" y="144" width="64" height="64" rx="8" fill="none" stroke="currentColor"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/>
                    <rect x="144" y="144" width="64" height="64" rx="8" fill="none" stroke="currentColor"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/>
                </svg>
            </x-slot:icon>
            Dashboard
        </x-mdt.sidebar-link>

        <x-mdt.sidebar-link :active="request()->is('mdt/cad-screen') || request()->is('mdt/cad-screen/*')"
                            :href="route('mdt.cadScreen')">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" class="size-6">
                    <rect width="256" height="256" fill="none"/>
                    <rect x="32" y="48" width="192" height="144" rx="16" transform="translate(256 240) rotate(180)"
                          fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="16"/>
                    <line x1="160" y1="224" x2="96" y2="224" fill="none" stroke="currentColor" stroke-linecap="round"
                          stroke-linejoin="round" stroke-width="16"/>
                    <line x1="32" y1="152" x2="224" y2="152" fill="none" stroke="currentColor" stroke-linecap="round"
                          stroke-linejoin="round" stroke-width="16"/>
                    <line x1="128" y1="192" x2="128" y2="224" fill="none" stroke="currentColor" stroke-linecap="round"
                          stroke-linejoin="round" stroke-width="16"/>
                </svg>
            </x-slot:icon>
            CAD Screen
        </x-mdt.sidebar-link>

        <x-mdt.sidebar-link :active="request()->is('mdt/calls') || request()->is('mdt/calls/*')"
                            :href="route('mdt.cadScreen')">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/>
                </svg>

            </x-slot:icon>
            Calls
        </x-mdt.sidebar-link>

        <x-mdt.sidebar-link :active="request()->is('mdt/civilian-search') || request()->is('mdt/civilian-search/*')"
                            :href="route('mdt.civilianSearch')">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                </svg>
            </x-slot:icon>
            Name Search
        </x-mdt.sidebar-link>

        <x-mdt.sidebar-link :active="request()->is('mdt/vehicle-search') || request()->is('mdt/vehicle-search/*')"
                            :href="route('mdt.vehicleSearch')">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" class="size-6">
                    <rect width="256" height="256" fill="none"/>
                    <circle cx="64" cy="176" r="24" fill="none" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="16"/>
                    <circle cx="192" cy="176" r="24" fill="none" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="16"/>
                    <line x1="88" y1="176" x2="168" y2="176" fill="none" stroke="currentColor" stroke-linecap="round"
                          stroke-linejoin="round" stroke-width="16"/>
                    <path
                        d="M216,176h24a8,8,0,0,0,8-8V128a8,8,0,0,0-8-8H208L162.34,74.34A8,8,0,0,0,156.69,72H44.28a8,8,0,0,0-6.65,3.56L8,120v48a8,8,0,0,0,8,8H40"
                        fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="16"/>
                    <line x1="208" y1="120" x2="8" y2="120" fill="none" stroke="currentColor" stroke-linecap="round"
                          stroke-linejoin="round" stroke-width="16"/>
                </svg>

            </x-slot:icon>
            Plate Search
        </x-mdt.sidebar-link>

        <x-mdt.sidebar-link :active="request()->is('mdt/firearm-search') || request()->is('mdt/firearm-search/*')"
                            :href="route('mdt.firearmSearch')">
            <x-slot:icon>
                <svg fill="#ffffff" height="193px" width="193px" version="1.1" id="Capa_1" class="size-6"
                     xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 393.237 393.237" xml:space="preserve" transform="rotate(0)matrix(1, 0, 0, 1, 0, 0)"
                     stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <g>
                            <path
                                d="M393.237,83.229h-15.93v-7.348h-20.82v7.348H67.482v-7.73h-11v7.898c-5.924,0.44-11.58,1.814-16.822,3.986 c-4.264-3.196-9.503-4.981-14.88-4.981C11.116,82.403,0,93.519,0,107.183c0,6.878,2.842,13.349,7.742,17.982 c-0.561,2.437-0.968,4.94-1.198,7.502l-1.98,22.004l5.168,0.738c9.833,1.405,18.449,6.614,24.262,14.667 c5.813,8.054,8.044,17.873,6.281,27.647L24.39,285.776c-1.432,7.937,0.713,16.037,5.885,22.225s12.763,9.737,20.827,9.737h44.101 c8.908,0,16.598-6.348,18.286-15.095l12.076-62.576c3.024-15.669,16.801-27.042,32.759-27.042h31.837 c18.364,0,34.525-11.731,40.215-29.192l3.996-12.265c2.516-7.721,9.616-12.927,17.717-13.033l51.725-0.01v-7.96h89.403 L393.237,83.229z M382.198,118.134h-59.707c-10.902,0-20.442,5.913-25.602,14.696H17.593c1.878-17.289,13.552-31.181,29.245-36.384 v24.519h11V94.327c0.924-0.058,6.91-0.098,6.91-0.098v26.735h11V94.229h6.91v26.735h11V94.229h6.911v26.735h11V94.229h6.91v26.735 h11V94.229h252.635L382.198,118.134z M11,107.183c0-7.599,6.182-13.78,13.78-13.78c1.183,0,2.335,0.164,3.448,0.448 c-6.687,4.95-12.191,11.415-16.008,18.948C11.441,111.056,11,109.155,11,107.183z M167.61,201.903h-3.946 c-11.186,0-20.286-7.966-20.286-17.758c0-12.966,11.01-23.696,25.21-25.297C161.739,171.861,161.348,188.833,167.61,201.903z M219.917,180.426c-4.209,12.92-16.167,21.6-29.756,21.6h-9.652c-8.887-11.556-8.249-32.062,1.41-43.404l29.865-0.036l0,0.063 c3.651,0.024,8.47,0.633,10.694,3.399c2.085,2.593,1.31,6.381,1.301,6.418l0.033,0.007L219.917,180.426z M172.259,147.634 c-21.99,0-39.881,16.379-39.881,36.511c0,8.277,3.828,15.688,9.937,20.888c-13.894,5.399-24.593,17.624-27.551,32.95 l-12.076,62.576c-0.691,3.58-3.838,6.179-7.485,6.179H51.102c-4.796,0-9.311-2.111-12.387-5.791s-4.352-8.498-3.5-13.218 L51.1,199.677c2.298-12.742-0.609-25.54-8.187-36.038c-6.546-9.068-15.818-15.37-26.483-18.098l0.154-1.711h276.506 c-0.163,1.212-0.262,2.443-0.274,3.696L172.259,147.634z M382.217,139.566h-76.46c3.053-6.169,9.397-10.432,16.734-10.432h59.726 V139.566z"></path>
                            <path
                                d="M98.387,151.813H86.405c-13.214,0-24.607,10.505-27.09,24.978l-16.184,94.315c-1.306,7.609,0.76,15.527,5.525,21.18 c4.183,4.962,9.874,7.694,16.025,7.694h19.833c7.502,0,13.974-5.845,15.387-13.897l18.782-107.025 c1.257-7.16-0.669-14.622-5.151-19.959C109.586,154.4,104.208,151.813,98.387,151.813z M107.849,177.156L89.067,284.18 c-0.488,2.781-2.403,4.799-4.553,4.799H64.681c-2.853,0-5.558-1.344-7.615-3.784c-2.702-3.205-3.858-7.776-3.094-12.229 l16.184-94.315c1.574-9.177,8.408-15.838,16.249-15.838h11.982c2.515,0,4.901,1.193,6.721,3.359 C107.525,169.051,108.55,173.157,107.849,177.156z"></path>
                        </g>
                    </g></svg>
            </x-slot:icon>
            Weapon Search
        </x-mdt.sidebar-link>

        <x-mdt.sidebar-link :active="request()->is('portal')" :href="route('portal.dashboard')">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v3.75m0-10.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.25-8.25-3.286Zm0 13.036h.008v.008H12v-.008Z"/>
                </svg>

            </x-slot:icon>
            BOLO
        </x-mdt.sidebar-link>

        <x-mdt.sidebar-link :active="request()->is('portal')" :href="route('portal.dashboard')">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H6.911a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661Z"/>
                </svg>

            </x-slot:icon>
            Reports
        </x-mdt.sidebar-link>

        <x-mdt.sidebar-link :active="request()->is('portal')" :href="route('portal.dashboard')">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                </svg>

            </x-slot:icon>
            Message Center
        </x-mdt.sidebar-link>

    </nav>
</div>
