@extends('layouts.admin')

@section('main')
    <x-breadcrumb pageTitle="Announcements" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.announcement.index') }}">Announcements</x-breadcrumb-link>
    </x-breadcrumb>
    <div class="flex justify-between items-center mb-3">
        <div>
            {{-- <p class="label-dark">Filter by Department</p>
            <select class="form-text-input-dark" id="" name="">
                <option value="">Choose one</option>
                <option value="">Department</option>
                <option value="">Department</option>
                <option value="">Department</option>
            </select> --}}
        </div>
        <a class="" href="{{ route('admin.announcement.create') }}">
            <button class="bg-green-600 px-3 rounded-lg py-2 hover:bg-green-800">+ New Announcement</button>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        @forelse ($announcements as $announcement)
            <div>
                <a class="bg-navbar hover:opacity-85 p-2 rounded-lg flex"
                   href="{{ route('admin.announcement.edit', $announcement->id) }}">
                    <img alt="" class="w-16 h-16"
                         src="{{ $announcement->department->logo ?? get_setting('community.logo') }}">
                    <div class="ml-4">
                        <h3 class="text-lg">{{ $announcement->title }}</h3>
                        <p>{{ str()->limit($announcement->text, 150, '... Read More') }}</p>
                        <div class="flex justify-around">
                            <p class="block text-xs">By: {{ $announcement->user->name }}</p>
                            <p class="text-xs">Posted at:
                                {{ $announcement->created_at->format('m/d/y H:i') }}</p>
                            <p class="block text-xs">For: {{ $announcement->department->name ?? 'Community Wide' }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="md:col-span-2">
                <p class="">There are currently no announcements.</p>
            </div>
        @endforelse
    </div>
@endsection
