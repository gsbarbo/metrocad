<header class="h-14 bg-navigation border-b border-border flex items-center px-4 gap-4 shrink-0 z-10">

    {{-- Mobile menu toggle --}}
    <button @click="mobileSidebar = true" class="lg:hidden text-gray-400 hover:text-gray-200 p-1 -ml-1">
        <x-heroicon-o-bars-3 class="w-5 h-5 cursor-pointer" />
    </button>

    {{-- Logo (mobile only) --}}
    <div class="flex items-center gap-2.5 lg:hidden">
        <span class="text-white font-semibold text-sm">
            {{ setting('cad.name', 'Metro CAD') }}
        </span>
    </div>

    {{-- Spacer --}}
    <div class="flex-1"></div>

    {{-- User dropdown --}}
    <div class="relative" @click.outside="userMenu = false">
        <button @click="userMenu = !userMenu"
            class="flex items-center gap-2.5 text-sm text-gray-300 hover:text-white transition-colors group cursor-pointer">
            <div
                class="w-7 h-7 rounded-full bg-blue-600/30 border border-blue-500/40 flex items-center justify-center text-xs font-semibold text-blue-300">
                {{ strtoupper(substr(auth()->user()->discord_username, 0, 2)) }}
            </div>
            <span class="hidden sm:block">{{ auth()->user()->discord_username }}</span>
            <x-heroicon-o-chevron-down class="w-3.5 h-3.5 text-gray-500 transition-transform duration-150"
                ::class="userMenu ? 'rotate-180' : 'rotate-0'" />
        </button>

        {{-- Dropdown --}}
        <div x-show="userMenu" x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute right-0 mt-2 w-44 bg-gray-900 border border-gray-800 rounded-lg shadow-xl overflow-hidden z-50"
            x-cloak>
            <div class="px-3 py-2 border-b border-gray-800">
                <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
            </div>
            <a href="{{ route('portal.dashboard') }}"
                class="flex items-center gap-2.5 px-3 py-2 text-sm text-gray-300 hover:text-white hover:bg-gray-800 transition-colors">
                <x-heroicon-o-cog-6-tooth class="w-4 h-4 text-gray-500" />
                Settings
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-2.5 px-3 py-2 text-sm text-gray-300 hover:text-white hover:bg-gray-800 transition-colors cursor-pointer">
                    <x-heroicon-o-arrow-right-on-rectangle class="w-4 h-4 text-gray-500" />
                    Sign out
                </button>
            </form>
        </div>
    </div>

</header>
