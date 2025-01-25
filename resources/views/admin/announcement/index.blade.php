@extends('layouts.admin')

@section('main')
    <div class="flex justify-between items-baseline">
        <h1 class="text-xl font-bold">Manage Announcements</h1>
        <a class="text-green-600 hover:underline" href="{{ route('admin.announcement.create') }}">
            New Announcement
        </a>
    </div>
    <hr class="my-2">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        @forelse ($announcements as $announcement)
            <div>
                <a class="bg-navbar hover:opacity-85 p-2 rounded-lg flex"
                    href="{{ route('admin.announcement.edit', $announcement->id) }}">
                    <img alt="" class="w-16 h-16"
                        src="{{ $announcement->department->logo ?? get_setting('community_logo') }}">
                    <div class="ml-4">
                        <h3 class="text-lg">{{ $announcement->title }}</h3>
                        <p>{{ $announcement->text }}</p>
                        <p class="block text-sm">By: {{ $announcement->user->preferred_name }}</p>
                        <p class="text-sm">Posted at:
                            {{ $announcement->created_at->format('m/d/y H:i') }}</p>
                        <p class="block text-sm">For: {{ $announcement->department->name ?? 'Community Wide' }}</p>
                    </div>
                </a>
            </div>
        @empty
            <div class="md:col-span-2">
                <p class="">There are no announcements.</p>
            </div>
        @endforelse
    </div>
@endsection
