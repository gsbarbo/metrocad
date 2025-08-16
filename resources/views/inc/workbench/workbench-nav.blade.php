<header class="z-10 py-4 shadow-md bg-navbar">
    <div class="container flex items-center justify-between h-full px-6 mx-auto">

        <div class="flex">
            <button @click="isSidebarExpanded = !isSidebarExpanded" aria-label="Menu"
                    class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple">
                <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path clip-rule="evenodd"
                          d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                          fill-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <ul class="flex justify-between items-center flex-shrink-0 space-x-6">
            @auth
                <li class="relative hidden md:block" x-data="{ open: false }">
                    <button @click="open = !open" @keydown.escape="open = false" aria-haspopup="true"
                            aria-label="Notifications"
                            class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-purple">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
                            </path>
                        </svg>
                        <!-- Notification badge -->
                        <span aria-hidden="true"
                              class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-gray-800 rounded-full"></span>
                    </button>
                    <div @click.away="open = false" @keydown.escape="open = false" x-show="open">
                        <ul aria-label="submenu"
                            class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-300 bg-gray-700 border border-gray-700 rounded-md shadow-md"
                            x-transition:leave-end="opacity-0" x-transition:leave-start="opacity-100"
                            x-transition:leave="transition ease-in duration-150">
                            <li class="flex">
                                <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-800 hover:text-gray-200"
                                   href="#">
                                    <span>New Applications</span>
                                    <span
                                        class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                                        13
                                    </span>
                                </a>
                            </li>
                            <li class="flex">
                                <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-800 hover:text-gray-200"
                                   href="#">
                                    <span>New Applications</span>
                                    <span
                                        class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                                        13
                                    </span>
                                </a>
                            </li>
                            <li class="flex">
                                <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-800 hover:text-gray-200"
                                   href="#">
                                    <span>New Applications</span>
                                    <span
                                        class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                                        13
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @keydown.escape="open = false" aria-haspopup="true"
                            aria-label="Profile"
                            class="relative align-middle rounded-md">
                        <x-discord-link></x-discord-link>
                    </button>
                    <div @click.away="open = false" @keydown.escape="open = false" x-show="open">
                        <ul aria-label="submenu"
                            class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-300 bg-[#1e476d] border border-[#1e476d] rounded-md shadow-md"
                            x-transition:leave-end="opacity-0" x-transition:leave-start="opacity-100"
                            x-transition:leave="transition ease-in duration-150">
                            <li class="flex">
                                <a class="flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                   href="{{ route('portal.user.settings') }}">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke-width="1.5" stroke="currentColor"
                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z"
                                            stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    </svg>

                                    <span>Settings</span>
                                </a>
                            </li>
                            <li class="flex">
                                <form action="{{ route('auth.logout') }}" class="block w-full text-red-400"
                                      method="POST">
                                    @csrf
                                    <a class="flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                       href="#"
                                       onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                        <svg aria-hidden="true" class="w-4 h-4 mr-3" fill="none" stroke-linecap="round"
                                             stroke-linejoin="round" stroke-width="2" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path
                                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                            </path>
                                        </svg>
                                        <span>Log out</span>
                                    </a>
                                </form>
                            </li>
                            <li class="flex border-t">
                                <p class="w-full px-2 py-1 text-xs font-semibold transition-colors duration-150 rounded-md">
                                    v{{ config('metrocad.version') }}
                                </p>
                            </li>
                        </ul>
                    </div>
                </li>
            @endauth
        </ul>
    </div>
</header>
