<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ get_setting('community_name') }} | Portal</title>
    @include('inc.layouts.header')
</head>

<body class="bg-background antialiased text-white" x-data="{ isSidebarExpanded: false }">

    <div :class="{ 'overflow-hidden': isSidebarExpanded }" class="flex h-screen">
        @include('inc.portal.sidebar')
        <div class="flex flex-col flex-1">
            @include('components.navbar')
            <main class="h-full pb-16 overflow-y-auto">
                <div class="container mx-auto px-6 py-3">
                    @yield('main')
                </div>
            </main>
        </div>
    </div>

    @if (session('alerts'))
        <div class="">
            <div class="absolute right-0 z-50 top-9">
                <x-alert />
            </div>
        </div>
    @endif

    @include('inc.layouts.scripts')
</body>

</html>
