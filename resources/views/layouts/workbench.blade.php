<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <title>{{ get_setting('community.name') }} | Workbench</title>
    @include('inc.layouts.header')
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+CU:wght@100..400&display=swap" rel="stylesheet">

</head>

<body class="antialiased bg-[#060606] text-white" x-data="{ isSidebarExpanded: false }">

<div :class="{ 'overflow-hidden': isSidebarExpanded }" class="flex h-screen">
    @include('inc.workbench.sidebar')
    <div class="flex flex-col flex-1">
        @include('inc.workbench.workbench-nav')
        <main class="">
            <div class="">
                @yield('content')
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
