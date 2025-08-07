@extends('layouts.portal')

@section('main')
    <div class="max-w-7xl mx-auto">
        <div>
            <h2 class="text-2xl">Welcome back, {{ auth()->user()->name }}</h2>
            <hr class="my-2">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mt-2">
            <div class="space-y-3">
                Settings
            </div>
            <div class="space-y-3">
                <h1 class="text-2xl font-thin">Connected Accounts</h1>

                <h1 class="text-lg">Discord <span class="text-green-600 text-sm">Connected</span></h1>
                <div class="text-sm ml-4">
                    <p>Name: {{ auth()->user()->discord_name }}</p>
                    <p>Username: {{ auth()->user()->discord_username }}</p>
                    <p>Id: {{ auth()->user()->id }}</p>
                    <p class="flex mb-3">Picture: <img alt="Profile Picture" class="h-10 w-10 ml-4 rounded-full"
                                                       src="{{ auth()->user()->avatar }}"></p>

                    <a href="{{route('portal.user.settings.discordSync')}}" class="">
                        <button class="btn-md btn-green btn-rounded">Sync Discord Roles</button>
                    </a>

                    <hr class="my-4">
                    To update Discord information please log out and log back in.
                </div>
                <h1 class="text-lg">Steam @if (auth()->user()->steam_name)
                        <span class="text-green-600 text-sm">Connected</span>
                    @elseif (!config('services.steam.client_secret'))
                        <span class="text-red-600 text-sm">Not Configured</span>
                    @else
                        <span class="text-red-600 text-sm">Not Connected</span>
                    @endif
                </h1>

                @if (get_setting('force_steam_link') && !auth()->user()->steam_id)
                    <div class="flex items-center p-4 mb-4 rounded-lg bg-gray-800 text-red-400" id="alert-2"
                         role="alert" x-data="{ show: true }" x-show="show">
                        <svg aria-hidden="true" class="flex-shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            Steam must be linked
                        </div>
                    </div>
                @endif

                @if (config('services.steam.client_secret'))
                    <div class="text-sm ml-4">
                        <p>Name: {{ auth()->user()->steam_name }}</p>
                        <p>Hex: {{ auth()->user()->steam_hex }}</p>
                        <p>Id: {{ auth()->user()->steam_id }}</p>

                        <hr class="my-4">

                        <a class="inline-block" href="{{ route('portal.link.steam') }}">
                            <button class="btn-alternative flex items-center">
                                <svg class="size-6 mr-2" viewBox="0 0 50 50" x="0px" xmlns="http://www.w3.org/2000/svg"
                                     y="0px">
                                    <path
                                        d="M 12 3 C 7.04 3 3 7.04 3 12 L 3 25.380859 L 16.419922 32.089844 C 16.919922 32.319844 17.140156 32.919922 16.910156 33.419922 C 16.740156 33.789922 16.38 34 16 34 C 15.86 34 15.720078 33.970156 15.580078 33.910156 L 3 27.619141 L 3 38 C 3 42.96 7.04 47 12 47 L 38 47 C 42.96 47 47 42.96 47 38 L 47 12 C 47 7.04 42.96 3 38 3 L 12 3 z M 12 5 L 38 5 C 41.86 5 45 8.14 45 12 L 45 38 C 45 41.86 41.86 45 38 45 L 12 45 C 8.14 45 5 41.86 5 38 L 5 30.859375 L 9.0195312 32.869141 C 9.0095313 33.079141 9 33.29 9 33.5 C 9 37.64 12.36 41 16.5 41 C 20.64 41 24 37.64 24 33.5 C 24 32.65 23.860078 31.819297 23.580078 31.029297 L 28.330078 27.449219 C 29.340078 27.819219 30.4 28 31.5 28 C 36.74 28 41 23.74 41 18.5 C 41 13.26 36.74 9 31.5 9 C 26.26 9 22 13.26 22 18.5 C 22 19.62 22.190312 20.71 22.570312 21.75 L 19.119141 26.470703 C 18.289141 26.160703 17.4 26 16.5 26 C 14.76 26 13.160625 26.589844 11.890625 27.589844 L 5 24.150391 L 5 12 C 5 8.14 8.14 5 12 5 z M 31.5 11 C 35.64 11 39 14.36 39 18.5 C 39 22.64 35.64 26 31.5 26 C 30.47 26 29.490078 25.800391 28.580078 25.400391 C 28.250078 25.250391 27.870078 25.299766 27.580078 25.509766 L 21.759766 29.900391 C 21.379766 30.190391 21.260937 30.700859 21.460938 31.130859 C 21.820938 31.870859 22 32.67 22 33.5 C 22 36.53 19.53 39 16.5 39 C 13.6 39 11.199531 36.729141 11.019531 33.869141 L 14.689453 35.699219 L 14.720703 35.710938 L 14.740234 35.720703 C 15.140234 35.910703 15.56 36 16 36 C 17.17 36 18.240703 35.319766 18.720703 34.259766 C 19.410703 32.769766 18.769062 30.999063 17.289062 30.289062 L 13.960938 28.630859 C 14.720937 28.230859 15.58 28 16.5 28 C 17.38 28 18.22 28.199609 19 28.599609 C 19.44 28.829609 19.979531 28.700781 20.269531 28.300781 L 23.369141 24.060547 L 24.509766 22.480469 C 24.719766 22.200469 24.769141 21.820234 24.619141 21.490234 C 24.209141 20.550234 24 19.54 24 18.5 C 24 14.36 27.36 11 31.5 11 z M 31.5 13 C 28.474279 13 26 15.474279 26 18.5 C 26 21.525721 28.474279 24 31.5 24 C 34.525721 24 37 21.525721 37 18.5 C 37 15.474279 34.525721 13 31.5 13 z M 31.5 15 C 33.444841 15 35 16.555159 35 18.5 C 35 20.444841 33.444841 22 31.5 22 C 29.555159 22 28 20.444841 28 18.5 C 28 16.555159 29.555159 15 31.5 15 z">
                                    </path>
                                </svg>
                                @if (auth()->user()->steam_name)
                                    <span class="text-sm">Update Steam</span>
                                @else
                                    <span class="text-sm">Link Steam</span>
                                @endif
                            </button>
                        </a>
                        @if (!get_setting('force_steam_link') && auth()->user()->steam_id)
                            <a class="inline-block" href="{{ route('portal.link.steam.unlink') }}">
                                <button class="btn-red flex items-center">
                                    <svg class="size-6 mr-2" viewBox="0 0 50 50" x="0px"
                                         xmlns="http://www.w3.org/2000/svg"
                                         y="0px">
                                        <path
                                            d="M 12 3 C 7.04 3 3 7.04 3 12 L 3 25.380859 L 16.419922 32.089844 C 16.919922 32.319844 17.140156 32.919922 16.910156 33.419922 C 16.740156 33.789922 16.38 34 16 34 C 15.86 34 15.720078 33.970156 15.580078 33.910156 L 3 27.619141 L 3 38 C 3 42.96 7.04 47 12 47 L 38 47 C 42.96 47 47 42.96 47 38 L 47 12 C 47 7.04 42.96 3 38 3 L 12 3 z M 12 5 L 38 5 C 41.86 5 45 8.14 45 12 L 45 38 C 45 41.86 41.86 45 38 45 L 12 45 C 8.14 45 5 41.86 5 38 L 5 30.859375 L 9.0195312 32.869141 C 9.0095313 33.079141 9 33.29 9 33.5 C 9 37.64 12.36 41 16.5 41 C 20.64 41 24 37.64 24 33.5 C 24 32.65 23.860078 31.819297 23.580078 31.029297 L 28.330078 27.449219 C 29.340078 27.819219 30.4 28 31.5 28 C 36.74 28 41 23.74 41 18.5 C 41 13.26 36.74 9 31.5 9 C 26.26 9 22 13.26 22 18.5 C 22 19.62 22.190312 20.71 22.570312 21.75 L 19.119141 26.470703 C 18.289141 26.160703 17.4 26 16.5 26 C 14.76 26 13.160625 26.589844 11.890625 27.589844 L 5 24.150391 L 5 12 C 5 8.14 8.14 5 12 5 z M 31.5 11 C 35.64 11 39 14.36 39 18.5 C 39 22.64 35.64 26 31.5 26 C 30.47 26 29.490078 25.800391 28.580078 25.400391 C 28.250078 25.250391 27.870078 25.299766 27.580078 25.509766 L 21.759766 29.900391 C 21.379766 30.190391 21.260937 30.700859 21.460938 31.130859 C 21.820938 31.870859 22 32.67 22 33.5 C 22 36.53 19.53 39 16.5 39 C 13.6 39 11.199531 36.729141 11.019531 33.869141 L 14.689453 35.699219 L 14.720703 35.710938 L 14.740234 35.720703 C 15.140234 35.910703 15.56 36 16 36 C 17.17 36 18.240703 35.319766 18.720703 34.259766 C 19.410703 32.769766 18.769062 30.999063 17.289062 30.289062 L 13.960938 28.630859 C 14.720937 28.230859 15.58 28 16.5 28 C 17.38 28 18.22 28.199609 19 28.599609 C 19.44 28.829609 19.979531 28.700781 20.269531 28.300781 L 23.369141 24.060547 L 24.509766 22.480469 C 24.719766 22.200469 24.769141 21.820234 24.619141 21.490234 C 24.209141 20.550234 24 19.54 24 18.5 C 24 14.36 27.36 11 31.5 11 z M 31.5 13 C 28.474279 13 26 15.474279 26 18.5 C 26 21.525721 28.474279 24 31.5 24 C 34.525721 24 37 21.525721 37 18.5 C 37 15.474279 34.525721 13 31.5 13 z M 31.5 15 C 33.444841 15 35 16.555159 35 18.5 C 35 20.444841 33.444841 22 31.5 22 C 29.555159 22 28 20.444841 28 18.5 C 28 16.555159 29.555159 15 31.5 15 z">
                                        </path>
                                    </svg>
                                    Unlink Steam
                                </button>
                            </a>
                        @endif
                    </div>
                @else
                    <p class="text-sm">This community does not have Steam connection configured.</p>
                @endif
            </div>

            <div class="space-y-3">
                Your Info
            </div>

            <div class="space-y-3">
                Your Stats
            </div>
        </div>

    </div>
@endsection
