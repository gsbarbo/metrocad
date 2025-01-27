@extends('layouts.admin')

@section('main')
    <div x-data="{ noteModal: false, accommodationModal: false, daModal: false, communityRankModal: false, rolesModal: false }">
        <x-breadcrumb pageTitle="User - {{ $user->name }}" route="{{ route('admin.dashboard') }}">
            <x-breadcrumb-link route="{{ route('admin.user.index') }}">Users</x-breadcrumb-link>
            <x-breadcrumb-link route="{{ route('admin.user.show', $user->id) }}">{{ $user->name }}</x-breadcrumb-link>
        </x-breadcrumb>

        <div class="grid grid-cols-1 gap-3 pt-5 pb-5 md:grid-cols-4">

            @livewire('admin.user.user-sidebar', ['user' => $user])

            <div class="md:col-span-2 lg:col-span-3">
                <div class="grid grid-cols-1 gap-4 text-sm lg:grid-cols-2">

                    @livewire('admin.user.user-action-area', ['user' => $user])

                    <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-navbar shadow">
                        <div class="border-b border-gray-200 bg-navbar px-4 py-5 sm:px-6">
                            <h3 class="text-base font-semibold">User Information</h3>
                        </div>
                        <div class="px-4 py-5 sm:p-6 space-y-1">
                            <p class="flex justify-between">Discord ID <span>{{ $user->id }}</span></p>
                            <p class="flex justify-between">Discord Name <span>{{ $user->discord_name }}</span></p>
                            <p class="flex justify-between">Discord Username <span>{{ $user->discord_username }}</span></p>
                            <p class="flex justify-between">Steam HEX
                                <span>{{ $user->steam_hex ?? 'Steam not linked' }}</span>
                            </p>
                            <p class="flex justify-between">Steam ID
                                <span>{{ $user->steam_id ?? 'Steam not linked' }}</span>
                            </p>
                        </div>
                    </div>

                    @if ($user->status === 2)
                        @livewire('admin.user.update-user', ['user' => $user])

                        @livewire('admin.user.update-user-permissions', ['user' => $user])

                        <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-navbar shadow">
                            <div class="border-b border-gray-200 bg-navbar px-4 py-5 sm:px-6">
                                <h3 class="text-base font-semibold">Roles</h3>
                            </div>
                            <div class="px-4 py-5 sm:p-6">
                                <p>List of all roles and a check box</p>
                                <p>Discord roles shows what discord roles the member has in discord</p>
                            </div>
                        </div>

                        @livewire('admin.user.create-user-comment', ['user' => $user])

                        @can(['admin:user:suspend', 'admin:user:ban'])
                            @livewire('admin.user.user-danger-area', ['user' => $user])
                        @endcan
                        <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-navbar shadow">
                            <div class="border-b border-gray-200 bg-navbar px-4 py-5 sm:px-6">
                                <h3 class="text-base font-semibold">DA</h3>
                            </div>
                            <div class="px-4 py-5 sm:p-6">
                                <p>List DAs in last 30 days</p>
                                <p>To give a DA would have to go to Staff/Supervisor</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
