<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <title>{{ get_setting('community.name') }} | Civilian</title>
    @include('inc.layouts.header')
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+CU:wght@100..400&display=swap" rel="stylesheet">
</head>

<body class="bg-background antialiased text-white" x-data="{ isSidebarExpanded: false }">

<div :class="{ 'overflow-hidden': isSidebarExpanded }" class="flex h-screen">
    @include('inc.civilian.sidebar')
    <div class="flex flex-col flex-1">
        @include('components.navbar')
        <main class="pb-16 overflow-y-auto">
            <div class="container mx-auto px-6 py-3">
                @yield('main')
            </div>
        </main>
    </div>
</div>

@if (session('alerts'))
    <div class="">
        <div class="absolute right-9 z-50 top-9">
            <x-alert/>
        </div>
    </div>
@endif

@livewireScripts
</body>

</html>
