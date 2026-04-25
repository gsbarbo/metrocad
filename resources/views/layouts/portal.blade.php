<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="ie=edge" http-equiv="X-UA-Compatible">
    <title>{{ setting('community.name') }} || Portal</title>
    <link href="{{ setting('community.logo_url') }}" rel="icon" type="image/x-icon">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+CU:wght@100..400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-background antialiased text-text">

    <div class="flex h-screen overflow-hidden" x-data="{
        sidebarExpanded: false,
        mobileSidebar: false,
        userMenu: false
    }"
        @keydown.escape.window="mobileSidebar = false; userMenu = false">

        @include('inc.portal.sidebar')

        <div class="flex-1 flex flex-col min-w-0">
            @include('inc.portal.navbar')

            <main class="flex-1 overflow-y-auto p-6">
                @yield('main')
            </main>
        </div>
    </div>


    <livewire:toasts />

    @livewireScripts
</body>

</html>
