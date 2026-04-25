@extends('layouts.portal')

@section('main')
    <div class="max-w-6xl mx-auto container">
        <div class="bg-navigation px-4 py-3 rounded-xl">
            <h2 class="text-lg font-medium">Welcome to {{ setting('community.name') }}!</h2>
            <p class="text-muted text-sm font-light">{!! setting('community.intro') !!}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-4">
            <div class="order-2 md:order-1">
                <div class="flex space-x-3 items-center mb-2">
                    <x-heroicon-o-megaphone class="size-6 text-accent" />
                    <h3 class="text-md font-medium">Announcements</h3>
                </div>
                <div class="space-y-2">
                    <div class="text-muted text-sm font-light bg-navigation px-4 py-3 rounded-xl">
                        This will be an announcements section...
                    </div>
                    <div class="text-muted text-sm font-light bg-navigation px-4 py-3 rounded-xl">
                        This will be an announcements section...
                    </div>
                    <div class="text-muted text-sm font-light bg-navigation px-4 py-3 rounded-xl">
                        This will be an announcements section...
                    </div>
                </div>
            </div>

            <div class="order-1 md:order-2 col-span-1 md:col-span-1">
                <div class="flex space-x-3 items-center mb-2">
                    <x-heroicon-o-link class="size-6 text-accent" />
                    <h3 class="text-md font-medium">Quick Links</h3>
                </div>
                <div class="grid grid-cols-4 md:grid-cols-3 gap-2">
                    <a href="#">
                        <div
                            class="bg-navigation px-4 py-3 rounded-xl text-center hover:bg-navigation-hover transition-colors">
                            <x-heroicon-o-user class="size-6 text-accent mx-auto" />
                            <span class="block text-sm font-medium mt-2">Civilian</span>
                        </div>
                    </a>
                    <a href="#">
                        <div
                            class="bg-navigation px-4 py-3 rounded-xl text-center hover:bg-navigation-hover transition-colors">
                            <x-heroicon-o-user class="size-6 text-accent mx-auto" />
                            <span class="block text-sm font-medium mt-2">Civilian</span>
                        </div>
                    </a>
                    <a href="#">
                        <div
                            class="bg-navigation px-4 py-3 rounded-xl text-center hover:bg-navigation-hover transition-colors">
                            <x-heroicon-o-user class="size-6 text-accent mx-auto" />
                            <span class="block text-sm font-medium mt-2">Civilian</span>
                        </div>
                    </a>
                    <a href="#">
                        <div
                            class="bg-navigation px-4 py-3 rounded-xl text-center hover:bg-navigation-hover transition-colors">
                            <x-heroicon-o-user class="size-6 text-accent mx-auto" />
                            <span class="block text-sm font-medium mt-2">Civilian</span>
                        </div>
                    </a>
                    <a href="#">
                        <div
                            class="bg-navigation px-4 py-3 rounded-xl text-center hover:bg-navigation-hover transition-colors">
                            <x-heroicon-o-user class="size-6 text-accent mx-auto" />
                            <span class="block text-sm font-medium mt-2">Civilian</span>
                        </div>
                    </a>
                    <a href="#">
                        <div
                            class="bg-navigation px-4 py-3 rounded-xl text-center hover:bg-navigation-hover transition-colors">
                            <x-heroicon-o-user class="size-6 text-accent mx-auto" />
                            <span class="block text-sm font-medium mt-2">Civilian</span>
                        </div>
                    </a>
                    <a href="#">
                        <div
                            class="bg-navigation px-4 py-3 rounded-xl text-center hover:bg-navigation-hover transition-colors">
                            <x-heroicon-o-user class="size-6 text-accent mx-auto" />
                            <span class="block text-sm font-medium mt-2">Civilian</span>
                        </div>
                    </a>

                </div>
            </div>

            <div class="order-3 md:order-3">
                <div class="flex space-x-3 items-center mb-2">
                    <x-heroicon-o-clipboard class="size-6 text-accent" />
                    <h3 class="text-md font-medium">Current Stats</h3>
                </div>
                <div class="space-y-2">
                    <div class="bg-green-300/25 px-4 py-3 rounded-xl">
                        <p class="text-green-500">Online Units: <span class="font-bold">42</span></p>
                    </div>
                    <div class="bg-yellow-300/25 px-4 py-3 rounded-xl">
                        <p class="text-yellow-500">Active 911 Calls: <span class="font-bold">42</span></p>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
