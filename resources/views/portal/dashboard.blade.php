@extends('layouts.portal')

@section('main')
    <div class="max-w-7xl mx-auto">
        <div>
            <h2 class="text-2xl">Welcome back, {{ auth()->user()->name }}</h2>
            <hr class="my-2">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-2">
            <div class="space-y-3 md:col-span-2">
                <div class="flex justify-between">
                    <h1 class="text-xl font-thin">Community Announcements</h1>
                    <a class="text-blue-500 hover:underline" href="#">View All</a>
                </div>
                {{-- @forelse ($announcements as $announcement) --}}
                <div class="bg-navbar p-2 rounded-lg flex">
                    <img alt="" class="w-16 h-16" onerror="defaultImage('logo')"
                        src="{{ get_setting('community_logo') }}">
                    <div class="ml-4">
                        <h3 class="text-lg">Title</h3>
                        <p class="text-sm">{{ get_setting('community_intro') }}</p>
                        <div class="flex justify-between mt-2">
                            <p class="block text-xs">By: Name</p>
                            <p class="text-xs">Posted at:
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-navbar p-2 rounded-lg flex">
                    <img alt="" class="w-16 h-16" onerror="defaultImage('logo')"
                        src="{{ get_setting('community_logo') }}">
                    <div class="ml-4">
                        <h3 class="text-lg">Title</h3>
                        <p class="text-sm">{{ get_setting('community_intro') }}</p>
                        <div class="flex justify-between mt-2">
                            <p class="block text-xs">By: Name</p>
                            <p class="text-xs">Posted at:
                            </p>
                        </div>
                    </div>
                </div>
                {{-- @empty
                    <div class="md:col-span-2">
                        <p class="">There are no announcements.</p>
                    </div>
                @endforelse --}}
            </div>
            <div class="space-y-3">
                <h1 class="text-xl font-thin">Community Stats</h1>
                <div class="border-navbar border-4 p-2 rounded-lg">
                    <h3 class="text-2xl">5</h3>
                    <p class="text-xs">arrests</p>
                </div>

                <div class="border-navbar border-4 p-2 rounded-lg">
                    <h3 class="text-2xl">5/20</h3>
                    <p class="text-xs">Active/All Members (Active is 5 hours)</p>
                </div>
                <div class="border-navbar border-4 p-2 rounded-lg">
                    <h3 class="text-2xl">5/20</h3>
                    <p class="text-xs">Active/All Members (Active is 5 hours)</p>
                </div>
                <div class="border-navbar border-4 p-2 rounded-lg">
                    <h3 class="text-2xl">5/20</h3>
                    <p class="text-xs">Active/All Members (Active is 5 hours)</p>
                </div>
                <div class="border-navbar border-4 p-2 rounded-lg">
                    <h3 class="text-2xl">5/20</h3>
                    <p class="text-xs">Active/All Members (Active is 5 hours)</p>
                </div>

            </div>
        </div>

        <hr class="mt-4">
        <h1 class="text-xl font-thin">Quick Links</h1>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-10 mt-2">
            <a class="border-navbar hover:bg-navbar border-4 p-2 rounded-lg text-center" href="#">
                <svg class="h-12 w-12 md:h-16 md:w-16 mx-auto" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="text-lg">View Civilians</p>
            </a>
            <a class="border-navbar hover:bg-navbar border-4 p-2 rounded-lg text-center" href="#">
                <svg class="h-12 w-12 md:h-16 md:w-16 mx-auto" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="text-lg">View Civilians</p>
            </a>
            <a class="border-navbar hover:bg-navbar border-4 p-2 rounded-lg text-center" href="#">
                <svg class="h-12 w-12 md:h-16 md:w-16 mx-auto" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="text-lg">View Civilians</p>
            </a>
            <a class="border-navbar hover:bg-navbar border-4 p-2 rounded-lg text-center" href="#">
                <svg class="h-12 w-12 md:h-16 md:w-16 mx-auto" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="text-lg">View Civilians</p>
            </a>
            <a class="border-navbar hover:bg-navbar border-4 p-2 rounded-lg text-center" href="#">
                <svg class="h-12 w-12 md:h-16 md:w-16 mx-auto" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="text-lg">View Civilians</p>
            </a>

        </div>

    </div>
@endsection
