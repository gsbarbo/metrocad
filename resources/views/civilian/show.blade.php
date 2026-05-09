@extends('layouts.civilian')

@section('main')
    <x-page-header title="{{ $civilian->name }}" home="{{ route('civilian.index') }}">
        <x-slot:breadcrumbs>
            <x-breadcrumb-link :href="route('civilian.index')">Your Civilians</x-breadcrumb-link>
            <x-breadcrumb-link :href="route('civilian.show', $civilian->id)">{{ $civilian->name }}</x-breadcrumb-link>
        </x-slot:breadcrumbs>

        <x-slot:actions>
            <a href="{{ route('civilian.edit', $civilian->id) }}" class="btn btn-blue btn-md btn-pill">
                Edit
            </a>
            <a href="{{ route('civilian.edit', $civilian->id) }}" class="btn btn-red btn-md btn-pill">
                Mark Deceased
            </a>
        </x-slot:actions>
    </x-page-header>

    <div class="flex justify-between">
        <div class="flex items-center">
            <div class="h-16 w-16 md:h-24 p-3 md:w-24 mx-auto rounded-full bg-accent">
                @if (is_null($civilian->picture_url))
                    <svg class="" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                @else
                    <img alt="picture" class="" src="{{ $civilian->picture_url }}">
                @endif
            </div>
            <div class="ml-3">
                <p class="text-2xl font-bold">{{ $civilian->name }}</p>
                <p class="text-text-muted text-xs">{{ $civilian->full_address }}</p>
                <p class="text-text-muted text-xs">{{ $civilian->ssn }}</p>
            </div>
        </div>
    </div>

    <div class="mt-6">

        <div x-data="{ tab: 'information' }">
            <div class="flex space-x-1">
                <button @click="tab = 'information'"
                    :class="tab === 'information' ? 'border-primary text-white bg-accent/75' :
                        'border-transparent text-gray-300 bg-accent/50'"
                    class="flex items-center gap-1.5 px-3 py-2 text-sm border-b-2 -mb-px rounded-tl-lg rounded-tr-lg cursor-pointer">
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none" style="opacity:0.8">
                        <circle cx="8" cy="5" r="2.5" stroke="currentColor" stroke-width="1.4" />
                        <path d="M3 13c0-2.76 2.24-5 5-5s5 2.24 5 5" stroke="currentColor" stroke-width="1.4"
                            stroke-linecap="round" />
                    </svg>
                    Information
                </button>

                <button @click="tab = 'licenses'"
                    :class="tab === 'licenses' ? 'border-primary text-white bg-accent/75' :
                        'border-transparent text-gray-300 bg-accent/50'"
                    class="flex items-center gap-1.5 px-3 py-2 text-sm border-b-2 -mb-px rounded-tl-lg rounded-tr-lg cursor-pointer">
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none" style="opacity:0.8">
                        <circle cx="8" cy="5" r="2.5" stroke="currentColor" stroke-width="1.4" />
                        <path d="M3 13c0-2.76 2.24-5 5-5s5 2.24 5 5" stroke="currentColor" stroke-width="1.4"
                            stroke-linecap="round" />
                    </svg>
                    Licenses
                </button>

                <button @click="tab = 'banking'"
                    :class="tab === 'banking' ? 'border-primary text-white bg-accent/75' :
                        'border-transparent text-gray-300 bg-accent/50'"
                    class="flex items-center gap-1.5 px-3 py-2 text-sm border-b-2 -mb-px rounded-tl-lg rounded-tr-lg cursor-pointer">
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none" style="opacity:0.8">
                        <circle cx="8" cy="5" r="2.5" stroke="currentColor" stroke-width="1.4" />
                        <path d="M3 13c0-2.76 2.24-5 5-5s5 2.24 5 5" stroke="currentColor" stroke-width="1.4"
                            stroke-linecap="round" />
                    </svg>
                    Banking
                </button>

                <button @click="tab = 'businesses'"
                    :class="tab === 'businesses' ? 'border-primary text-white bg-accent/75' :
                        'border-transparent text-gray-300 bg-accent/50'"
                    class="flex items-center gap-1.5 px-3 py-2 text-sm border-b-2 -mb-px rounded-tl-lg rounded-tr-lg cursor-pointer">
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none" style="opacity:0.8">
                        <circle cx="8" cy="5" r="2.5" stroke="currentColor" stroke-width="1.4" />
                        <path d="M3 13c0-2.76 2.24-5 5-5s5 2.24 5 5" stroke="currentColor" stroke-width="1.4"
                            stroke-linecap="round" />
                    </svg>
                    Businesses
                </button>
            </div>

            <div x-show="tab === 'information'">
                <div class="md:grid md:grid-cols-3 gap-5 mt-5 mb-3 space-y-5 md:space-y-0">

                    <div class="bg-navigation border-2 border-accent p-2 rounded-lg">
                        <p class="text-lg text-accent mb-2">Personal Details</p>

                        <div class="flex flex-col gap-1 text-sm leading-none">
                            <div>
                                <span class="font-semibold">Gender: </span>
                                <span class="">{{ $civilian->gender->label() }}</span>
                            </div>
                            <div>
                                <span class="font-semibold">Height: </span>
                                <span class="">{{ $civilian->height }}</span>
                            </div>
                            <div>
                                <span class="font-semibold">Weight: </span>
                                <span class="">{{ $civilian->weight }}</span>
                            </div>
                            <div>
                                <span class="font-semibold">Eye color: </span>
                                <span class="">{{ $civilian->eye_color->label() }}</span>
                            </div>
                            <div>
                                <span class="font-semibold">Hair color: </span>
                                <span class="">{{ $civilian->hair_color->label() }}</span>
                            </div>
                            <div>
                                <span class="font-semibold">Blood type: </span>
                                <span class="">{{ $civilian->blood_type?->label() ?? 'Unknown' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-navigation border-2 border-accent p-2 rounded-lg">
                        <livewire:civilian.licenses :civilian="$civilian" wire:key="licenses-{{ $civilian->id }}" />
                    </div>
                    <div class="bg-navigation border-2 border-accent p-2 rounded-lg">
                        <p class="text-lg text-accent mb-2">Quick Actions</p>

                        <div class="flex flex-col gap-1">
                            <a href="#">
                                <button class="btn-red btn btn-sm w-full rounded-sm">
                                    Call 911
                                </button>
                            </a>
                            <a href="#">
                                <button class="btn-green btn btn-sm w-full rounded-sm">
                                    Banking
                                </button>
                            </a>
                        </div>
                    </div>

                    <div class="bg-navigation border-2 border-accent p-2 rounded-lg col-span-3">
                        <livewire:civilian.registeredvehicles :civilian="$civilian"
                            wire:key="registered-vehicles-{{ $civilian->id }}" />
                    </div>

                    <div class="bg-navigation border-2 border-accent p-2 rounded-lg col-span-3">
                        <livewire:civilian.medicalhistory :civilian="$civilian"
                            wire:key="medical-history-{{ $civilian->id }}" />
                    </div>
                </div>



            </div>

            <div x-show="tab === 'businesses'"
                style="color: var(--color-text-secondary); font-size: 14px; padding: 2rem 0; text-align: center;">No
                businesses registered.</div>
            <div x-show="tab === 'properties'"
                style="color: var(--color-text-secondary); font-size: 14px; padding: 2rem 0; text-align: center;">No
                properties registered.</div>
            <div x-show="tab === 'banking'"
                style="color: var(--color-text-secondary); font-size: 14px; padding: 2rem 0; text-align: center;">No
                banking information available.</div>

        </div>

    </div>
@endsection
