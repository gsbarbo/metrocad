@extends('layouts.civilian')

@section('main')
    <x-breadcrumb pageTitle="Your Civilians" route="{{ route('portal.dashboard') }}">
        <x-breadcrumb-link route="{{ route('civilians.index') }}">Your Civilians</x-breadcrumb-link>
    </x-breadcrumb>

    <div class="flex justify-end items-center mb-3">
        <a class="" href="{{ route('civilians.create') }}">
            <button class="btn btn-md btn-with-icon btn-green btn-rounded">
                <svg class="size-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                New Civilian
            </button>
        </a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-10 mt-2">
        @forelse ($civilians as $civilian)
            <a class="@if ($civilian->is_active) !border-green-600 @endif @if ($civilian->user_department_id) !border-blue-600 @endif border-navbar border-4 p-2 rounded-lg text-center"
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
                    <p class="text-xs font-medium px-2.5 py-0.5 rounded-sm bg-green-900 text-green-300">
                        Current
                        Active Civilian</p>
                @endif

                @if ($civilian->user_department)
                    <p class="text-xs font-medium px-2.5 py-0.5 rounded-sm bg-blue-900 text-blue-300">
                        {{ $civilian->user_department->department->name }}
                    </p>
                @endif
            </a>
        @empty
            <p>You have no civilians.</p>
        @endforelse
    </div>
@endsection
