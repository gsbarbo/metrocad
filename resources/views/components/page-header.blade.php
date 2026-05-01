@props(['title', 'home' => '/'])

<header class="mb-6">
    @isset($breadcrumbs)
        <nav aria-label="Breadcrumb" class="mb-2">
            <ol class="inline-flex items-center gap-x-1 text-sm">
                <li class="inline-flex items-center">
                    <a href="{{ $home }}" class="inline-flex items-center text-text-muted hover:text-text transition-colors">
                        <x-heroicon-s-home class="size-3.5" />
                    </a>
                </li>
                {{ $breadcrumbs }}
            </ol>
        </nav>
    @endisset

    <div class="flex items-center justify-between gap-4">
        <h1 class="text-2xl font-semibold text-text tracking-tight">{{ $title }}</h1>

        @isset($actions)
            <div class="flex items-center gap-2">
                {{ $actions }}
            </div>
        @endisset
    </div>
</header>
