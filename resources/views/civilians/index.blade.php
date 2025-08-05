@extends('layouts.civilian')

@section('main')
    <x-breadcrumb pageTitle="Your Civilians" route="{{ route('portal.dashboard') }}">
        <x-breadcrumb-link route="{{ route('civilians.index') }}">Your Civilians</x-breadcrumb-link>
    </x-breadcrumb>

    <div class="flex justify-end items-center mb-3">
        <a class="" href="{{ route('civilians.create') }}">
            <button class="btn-green-sm">+ New Civilian</button>
        </a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-10 mt-2">
        @forelse ($civilians as $civilian)
            <a class="@if ($civilian->is_active) border-green-600 @else border-navbar @endif border-4 p-2 rounded-lg text-center"
                href="{{ route('civilians.show', $civilian->id) }}">
                @if (is_null($civilian->picture))
                    <svg class="h-12 w-12 md:h-16 md:w-16 mx-auto" fill="none" stroke-width="1.5" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                @else
                    <img alt="picture" class="h-12 w-12 md:h-16 md:w-16 mx-auto rounded-full"
                        src="{{ $civilian->picture }}">
                @endif

                <p class="text-lg">{{ $civilian->name }}</p>
                @if ($civilian->is_active)
                    <span
                        class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">Current
                        Active Civilian</span>
                @endif
            </a>
        @empty
            <p>You have no civilians.</p>
        @endforelse
    </div>
@endsection
