@extends('layouts.civilian')

@section('main')
    <x-breadcrumb pageTitle="{{ $civilian->name }}" route="{{ route('portal.dashboard') }}">
        <x-breadcrumb-link route="{{ route('civilians.index') }}">Your Civilians</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('civilians.show', $civilian->id) }}">{{ $civilian->name }}</x-breadcrumb-link>
    </x-breadcrumb>
    <div>
        @if ($civilian->is_active)
            <span
                class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">Current
                Active Civilian</span>
        @else
            <span
                class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-gray-300">Activate
                Civilian</span>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
        <div class="divide-y space-y-2">
            @if (is_null($civilian->picture))
                <svg class="h-48 w-48 mx-auto" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            @else
                <img alt="picture" class="h-48 w-48 mx-auto" src="{{ $civilian->picture }}">
            @endif

            <p class="">SNN: {{ $civilian->s_n_n }}</p>
            <p class="">DOB: {{ $civilian->date_of_birth->format(get_setting('date_format', 'm/d/Y')) }}</p>
            <p class="">Race: {{ $civilian->race }}</p>
            <p class="">Gender: {{ $civilian->gender }}</p>

            <p class="">Age: {{ $civilian->age }}</p>
            <p class="">Height: {{ $civilian->height }}</p>
            <p class="">Weight: {{ $civilian->weight }}</p>
            <p class="">Address: {{ $civilian->address }}</p>
            <p class="">Occupation: {{ $civilian->occupation }}</p>
        </div>
        <div class="md:col-span-3 divide-y space-y-2">

            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-2">
                <a class="border-indigo-800 hover:bg-sidebar border-4 p-2 rounded-lg text-center"
                    href="{{ route('civilians.index') }}">
                    <p class="text-xl font-bold">{{ get_setting('dmv_initials') }}</p>
                    <p class="text-sm">{{ get_setting('dmv_name') }}</p>
                </a>
                <a class="border-indigo-800 hover:bg-sidebar border-4 p-2 rounded-lg text-center" href="#">
                    <p class="text-xl font-bold">{{ get_setting('atf_initials') }}</p>
                    <p class="text-sm">{{ get_setting('atf_name') }}</p>
                </a>
                <a class="border-indigo-800 hover:bg-sidebar border-4 p-2 rounded-lg text-center" href="#">
                    <p class="text-xl font-bold">BBB</p>
                    <p class="text-sm">Better Business Bureau</p>
                </a>
                <a class="border-indigo-800 hover:bg-sidebar border-4 p-2 rounded-lg text-center" href="#">
                    <p class="text-xl font-bold">DOW</p>
                    <p class="text-sm">Department of Wildlife</p>
                </a>
                <a class="border-indigo-800 hover:bg-sidebar border-4 p-2 rounded-lg text-center" href="#">
                    <p class="text-xl font-bold">MB</p>
                    <p class="text-sm">Maze Bank</p>
                </a>
                <a class="border-indigo-800 hover:bg-sidebar border-4 p-2 rounded-lg text-center" href="#">
                    <p class="text-xl font-bold">LMP</p>
                    <p class="text-sm">Lifeinvader Marketplace</p>
                </a>
                <a class="border-indigo-800 hover:bg-sidebar border-4 p-2 rounded-lg text-center" href="#">
                    <p class="text-xl font-bold">PHMC</p>
                    <p class="text-sm">Pillbox Hill Medical Center</p>
                </a>
                <a class="border-indigo-800 hover:bg-sidebar border-4 p-2 rounded-lg text-center" href="#">
                    <p class="text-xl font-bold">SACS</p>
                    <p class="text-sm">Sate of {{ get_setting('state') }} Court System</p>
                </a>
            </div>

            {{-- <div class="" x-data="{ open: true }">
                <div @click="open = !open" class="flex justify-between items-center">
                    <h2 class="text-2xl font-semibold cursor-pointer select-none">{{ __('civilian/global.licenses') }}
                    </h2>
                    <div>
                        <svg class="size-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                            x-show="!open" xmlns="http://www.w3.org/2000/svg">
                            <path d="m19.5 8.25-7.5 7.5-7.5-7.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <svg class="size-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                            x-show="open" xmlns="http://www.w3.org/2000/svg">
                            <path d="m4.5 15.75 7.5-7.5 7.5 7.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-2" x-show="open">
                    @forelse ($civilian->licenses as $license)
                        <div>
                            @switch($license->license_type_id)
                                @case(1)
                                    <div>
                                        <x-civilian.dl-card :civilian="$civilian" :license="$license"></x-civilian.dl-card>
                                    </div>
                                @break

                                @case(2)
                                    <div>
                                        <x-civilian.id-card :civilian="$civilian" :license="$license"></x-civilian.id-card>
                                    </div>
                                @break

                                @default
                                    <x-civilian.license-card :civilian="$civilian" :license="$license"></x-civilian.license-card>
                            @endswitch
                        </div>
                        @empty
                            <p>{{ $civilian->name }} doesn't have any licenses yet.</p>
                        @endforelse
                    </div>
                    <p class="text-center mt-3">License can be updated by going to the {{ get_setting('dmv_name') }}.</p>
                </div> --}}
            {{--
            <div class="" x-data="{ open: false }">
                <div @click="open = !open" class="flex justify-between items-center">
                    <h2 class="text-2xl font-semibold cursor-pointer select-none">{{ __('civilian/global.vehicles') }}</h2>
                    <div>
                        <svg class="size-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                            x-show="!open" xmlns="http://www.w3.org/2000/svg">
                            <path d="m19.5 8.25-7.5 7.5-7.5-7.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <svg class="size-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                            x-show="open" xmlns="http://www.w3.org/2000/svg">
                            <path d="m4.5 15.75 7.5-7.5 7.5 7.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-2" x-show="open">
                    <a class="" href="#">
                        <div class="bg-gray-200 rounded-lg p-2 text-black text-sm">
                            <div class="">
                                <p class="text-lg text-center">{{ strtoupper(get_setting('state')) }}</p>
                            </div>
                            <div class="mt-1">
                                <p class="text-3xl text-center">123ABC</p>
                            </div>
                            <div class="mt-1 flex ">
                                <p class=""><span class="text-blue-500 text-xs">MK</span>
                                    FORD
                                </p>
                                <p class=""><span class="text-blue-500 text-xs">MD</span>
                                    EDGE
                                </p>
                                <p class="ml-3"><span class="text-blue-500 text-xs">YR</span>
                                    2018
                                </p>
                                <p class="ml-3"><span class="text-blue-500 text-xs">CL</span>
                                    RED
                                </p>
                                <p class="ml-3">

                                    <span class="text-blue-500 text-xs">RO</span> NAME, NAME

                                    <span class="text-blue-500 text-xs">BS</span> BUSINESS

                                </p>
                            </div>
                            <div class="border-t-2 border-black flex justify-between">

                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="" x-data="{ open: false }">
                <div @click="open = !open" class="flex justify-between items-center">
                    <h2 class="text-2xl font-semibold cursor-pointer select-none">{{ __('civilian/global.weapons') }}</h2>
                    <div>
                        <svg class="size-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                            x-show="!open" xmlns="http://www.w3.org/2000/svg">
                            <path d="m19.5 8.25-7.5 7.5-7.5-7.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <svg class="size-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                            x-show="open" xmlns="http://www.w3.org/2000/svg">
                            <path d="m4.5 15.75 7.5-7.5 7.5 7.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-2" x-show="open">
                    <a class="" href="#">
                        <div class="bg-gray-200 rounded-lg p-2 text-black text-sm">
                            <div class="">
                                <p class="text-lg text-center">Serial Number</p>
                            </div>
                            <div class="mt-1 flex items-center justify-around">
                                <img class="h-24 mr-3"
                                    src="https://communitycadv2.test/storage/images/weapon_types/rifle.png">
                                <p class="text-3xl text-center">d14e40cae28eb2e4</p>
                            </div>
                            <div class="mt-1 flex ">
                                <p class=""><span class="text-blue-500 text-xs">MK</span>
                                    Shotgun
                                </p>
                                <p class=""><span class="text-blue-500 text-xs">MD</span>
                                    12 GA
                                </p>

                                <p class="ml-3">
                                    <span class="text-blue-500 text-xs">RO</span> NAME, NAME
                                </p>
                            </div>
                            <div class="border-t-2 border-black flex justify-between">

                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="" x-data="{ open: false }">
                <div @click="open = !open" class="flex justify-between items-center">
                    <h2 class="text-2xl font-semibold cursor-pointer select-none">{{ __('civilian/global.medical') }}</h2>
                    <div>
                        <svg class="size-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                            x-show="!open" xmlns="http://www.w3.org/2000/svg">
                            <path d="m19.5 8.25-7.5 7.5-7.5-7.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <svg class="size-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                            x-show="open" xmlns="http://www.w3.org/2000/svg">
                            <path d="m4.5 15.75 7.5-7.5 7.5 7.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-2" x-show="open">
                    <a class="" href="#">
                        <div class="bg-gray-200 rounded-lg p-2 text-black text-sm">
                            <div class="mt-1">
                                <img class="h-8 mr-3"
                                    src="https://docs.altv.mp/gta/images/weapon/models/weapon_combatshotgun_thumbnail.png">
                                <p class="text-5xl text-center">d14e40cae28eb2e4</p>
                            </div>
                            <div class="mt-1 flex ">
                                <p class=""><span class="text-blue-500 text-xs">MK</span>
                                    Shotgun
                                </p>
                                <p class=""><span class="text-blue-500 text-xs">MD</span>
                                    12 GA
                                </p>

                                <p class="ml-3">
                                    <span class="text-blue-500 text-xs">RO</span> NAME, NAME
                                </p>
                            </div>
                            <div class="border-t-2 border-black flex justify-between">

                            </div>
                        </div>
                    </a>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
