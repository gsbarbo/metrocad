<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ get_setting('community_name') }} | MDT/CAD</title>
    @include('inc.layouts.header')
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+CU:wght@100..400&display=swap" rel="stylesheet">

    <style>
        @font-face {
            font-family: 'digital-clock-font';
            src: url('{{ asset('fonts/DIGITALDREAM.ttf') }}');
        }

        #running_clock_date,
        #running_clock_time {
            font-family: "digital-clock-font" !important;
        }
    </style>

</head>

<body class="font-mono antialiased bg-[#060606] uppercase text-white">

<div class="flex h-screen">
    @include('inc.mdt.sidebar')
    <div class="flex flex-col flex-1">
        @include('inc.mdt.mdt-nav')
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
