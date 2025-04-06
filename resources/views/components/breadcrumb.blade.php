<header class="">
    <nav aria-label="Breadcrumb" class="flex items-center mb-2">
        <ol class="inline-flex items-center space-x-1 md:space-x-3 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-white"
                    href="{{ $route }}">
                    <svg aria-hidden="true" class="w-3 h-3 me-2.5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                </a>
            </li>
            {{ $slot }}
        </ol>
    </nav>
    <h2 class="text-xl font-thin leading-none tracking-tight md:text-2xl text-white">
        {{ $pageTitle }}
    </h2>
</header>
